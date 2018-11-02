#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function errorWrite($error)
{
	//generate date and time for text name
	#$date = (new \DateTime())->format('Y-m-d H:i:s');
	$date = (new \DateTime())->format('Y-m-d');
	//manual file creation, know works
	//fopen creates/opens file, file path needs to be configured for host system
        $fp = fopen('/home/test1/git/errors/'.$date.'-error.txt', 'w');
        fwrite($fp, $error);
        fclose($fp);

	//error function, not sure it works
	//error_log(print_r($error, TRUE), 3, '/home/test1/git/errors/'.$date.'error.txt');
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
    case "error":
      return errorWrite($request['error']);
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("errorRabbitMQ.ini","testServer");


$server->process_requests('requestProcessor');
exit();
?>

