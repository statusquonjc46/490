#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function qa($ver,$ser,$num,$location) 
{
	if($ser==0)
	{
		if($location==0)
		{
			if($num==1){
				$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "deployment");
                        	$query = ("update webServer set working='1' where version='$ver'");
                        	$update = mysqli_query($sqlcon, $query);
			}
			
		}
		elseif($location==1)
		{
			if($num==1){
				$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "deployment");
                        	$query = ("update databaseServer set working='1' where version='$ver'");
                        	$update = mysqli_query($sqlcon, $query);
			}
		}
	}
	elseif($ser==1)
	{
		if($location==0){
			shell_exec("/home/test1/git/490/deployment/pull-front-QA.sh '".$ver."'");
			
        	}
        	elseif($location==1){
			shell_exec("/home/test1/git/490/deployment/pull-back-QA.sh '".$ver."'");
			
        	}
	}
}

function allVersion($location)
{
	if($location==0){

		$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "deployment");
		$query = ("select version from webServer");
		$result = mysqli_query($sqlcon, $query);
		while($row = mysqli_fetch_assoc($result))
        	{
        	        $rArray[] = $row;
        	}

		return $rArray;
	}
	elseif($location==1){
		$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "deployment");
                $query = ("select version from databaseServer");
                $result = mysqli_query($sqlcon, $query);
                while($row = mysqli_fetch_assoc($result))
                {
                        $rArray[] = $row;
                }

                return $rArray;
	}
}

function devPush($ver,$location)
{
	$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "deployment");
	if($location==0){
		$verExist = ("select version from webServer where version = '$ver'");
                $exist = mysqli_query($sqlcon, $verExist);
		$check = mysqli_num_rows($exist);
		if($check!=0){
			$aExists = "Version already exists";
			return $aExists;
		}
		else{
			shell_exec("/home/test1/git/490/deployment/pull-front.sh '".$ver."'");
			$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "deployment");
                	$query = ("insert into webServer(version) values('$ver')");
			$insert = mysqli_query($sqlcon, $query);
			return 1;
		}
	}
	elseif($location==1){
		$verExist = ("select version from databaseServer where version = '$ver'");
                $exist = mysqli_query($sqlcon, $verExist);
		$check = mysqli_num_rows($exist);
		if($check!=0){
			$aExists = "Version already exists";
                        return $aExists;
                }
		else{
			shell_exec("/home/test1/git/490/deployment/pull-back.sh '".$ver."'");
			$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "deployment");
                	$query = ("insert into databaseServer(version) values('$ver')");
			$insert = mysqli_query($sqlcon, $query);
			return 1;
		}
	}
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "qa":
	    return qa($request['version'],$request['service'],$request['working'],$request['location']);
    case "dev":
	    return devPush($request['version'],$request['location']);
    case "all":
	    return allVersion($request['location']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("deployRabbit.ini","testServer");


$server->process_requests('requestProcessor');
exit();
?>

