#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('login.php.inc');
require_once('emailer.php');

function doLogin($username,$password)
{
    // lookup username in databas
	// check password
    $login = new loginDB();
    return $login->validateLogin($username,$password);
    //return false if not valid
}

function doRegister($username, $password, $email)
{
	$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "test");
	$query = "select username from users where username = '$username'";
	$result = mysqli_query($sqlcon, $query);
	$check = mysqli_num_rows($result);
	if($check!=0){
		echo ("Sorry this username has already been taken");
		return 0;
	}
	else{
		$d="insert into users(username, password, email) values('$username','$password','$email')";
		($t = mysqli_query($sqlcon, $d)) or die (mysqli_error($sqlcon));
		return 1;
	}
}

function apiCall($username, $make, $model, $year){

	$rArray = array();

	$results = shell_exec('GET https://one.nhtsa.gov/webapi/api/Recalls/vehicle/modelyear/'.$year.'/make/'.$make.'/model/'.$model.'?format=json');
	
	$apiCode = json_decode($results, true);
	
	$c = count($apiCode['Results'], 0); //Checks the to see how many arrays exist
	
	$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "test");
	for($x = 0; $x < $c; $x++)
	{
        	$qMake = $apiCode['Results'][$x]["Make"];
        	$qModel = $apiCode['Results'][$x]["Model"];
        	$qManufac = $apiCode['Results'][$x]["Manufacturer"];
        	$qCampNum = $apiCode['Results'][$x]["NHTSACampaignNumber"];
        	$qDate = $apiCode['Results'][$x]["ReportReceivedDate"];
	        $qSum = $apiCode['Results'][$x]["Summary"];
        	$qComp = $apiCode['Results'][$x]["Component"];
        	$qYear = $apiCode['Results'][$x]["ModelYear"];
		$qNotes = $apiCode['Results'][$x]["Notes"];

		
		$recallExist = "select username, nhtsanumber from recallTable where username = '$username' and nhtsanumber = '$qCampNum'";
		$existQ = mysqli_query($sqlcon, $recallExist);
        	$check = mysqli_num_rows($existQ);
        	if ($check != 0)
        	{
			echo ("Recall Exists already.");
			$recallInfo = ("select * from recallTable where username = '$username'and nhtsanumber = '$qCampNum'");
			$result = mysqli_query($sqlcon, $recallInfo);
                	continue;	
        	}
        	else
		{
			
                	$storeData = ("insert into recallTable(username, make, model, manufacturer, nhtsanumber, date, summary, notes, modelyear) values('$username', '$qMake', '$qModel', '$qManufac', '$qCampNum', '$qDate', '$qSum', '$qNotes', '$qYear')");
			($r = mysqli_query($sqlcon, $storeData)) or die(mysqli_error($sqlcon));
			$recallInfo = ("select * from recallTable where username = '$username'and nhtsanumber = '$qCampNum'");
                        $result = mysqli_query($sqlcon, $recallInfo);
			continue;	
        	}
	}
	
	$getData = ("select * from recallTable where username = '$username'");
	$result = mysqli_query($sqlcon, $getData);
	while($row = mysqli_fetch_assoc($result))
        {
                $rArray[] = $row;
        }

	return $rArray;
}

function recallFixed($username, $fixed, $campNum)
{
	$rArray = array();

	$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "test");
	if($fixed == 1)
	{
		$set = ("update recallTable set fixed='1' where username = '$username' and nhtsanumber = '$campNum'");
		$query = mysqli_query($sqlcon, $set);
	}
	else
	{
		$set = ("update recallTable set fixed='0' where username = '$username' and nhtsanumber = '$campNum'");
                $query = mysqli_query($sqlcon, $set);
	}

	$getData = ("select * from recallTable where username = '$username'");
        $result = mysqli_query($sqlcon, $getData);
        while($row = mysqli_fetch_assoc($result))
        {
                $rArray[] = $row;
        }

        return $rArray;
}

function recallDelete($username, $campNum)
{
	$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "test");
        $query = "delete from recallTable where username = '$username'and nhtsanumber = '$campNum'";
	$delete = mysqli_query($sqlcon, $query);

	$getData = ("select * from recallTable where username = '$username'");
        $result = mysqli_query($sqlcon, $getData);
        while($row = mysqli_fetch_assoc($result))
        {
                $rArray[] = $row;
        }

        return $rArray;
}

function recallEmail($username, $make, $model, $year, $opt)
{
	$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "test");
	
	$recallExist = ("select username, make, model, year from optEmail where username = '$username' and make = '$make' and model = '$model' and year = '$year'");
        $existQ = mysqli_query($sqlcon, $recallExist);
        $check = mysqli_num_rows($existQ);
	if($check!=0){
		echo "already opted in";
	}
	else{	
		if($opt == 1)
        	{
                	$set = ("insert into optEmail (username, make, model, year, opt) values ('$username','$make','$model','$year','$opt')");
			$query = mysqli_query($sqlcon, $set);
			$get = ("select email from users where username='$username'");
			$query = mysqli_query($sqlcon, $get);
			while($row=mysqli_fetch_assoc($query))
			{
        			$selection[] = $row;
			}
			$address = $selection[0]['email'];
			$email = new emailer;
			$email->welcome_email($username, $address, $make, $model, $year);

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
    case "login":
     	    return doLogin($request['username'],$request['password']);
    case "email":
	    return recallEmail($request['username'],$request['make'],$request['model'],$request['year'],$request['opt']);
    case "register":
	    return doRegister($request['username'],$request['password'],$request['email']);
    case "api":
	    if($request['type2']=='email'){
	    	recallEmail($request['username'],$request['make'],$request['model'],$request['year'],$request['opt']);
	    }	
	    return apiCall($request['username'],$request['make'],$request['model'],$request['year']);
    case "fix":
	    return recallFixed($request['username'],$request['box'],$request['cNum']);
    case "delete":
	    return recallDelete($request['username'],$request['cNum']);
  }
  
   return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>

