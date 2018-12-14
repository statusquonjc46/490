#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function qa($msg,$num) 
{
	echo $msg;
	echo $num;
}

function devPush($ver,$location)
{
	if($location==0){
		shell_exec("/home/test1/git/490/deployment/pull-front.sh '".$ver."'");
	}
	elseif($location==1){
		shell_exec("/home/test1/git/490/deployment/pull-back.sh '".$ver."'");
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
	    return qa($request['version'],$request['working']);
    case "dev":
	    return function devPush($request['version'],$request['location']);
    case "":
	    return ;
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("deployRabbit.ini","testServer");


$server->process_requests('requestProcessor');
exit();
?>

