<?php
require_once('/home/njc46/490project/rabbitmqphp_example/path.inc');
require_once('/home/njc46/490project/rabbitmqphp_example/get_host_info.inc');
require_once('/home/njc46/490project/rabbitmqphp_example/rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
	$msg = $argv[1];
}
else
{
	$msg = "test";
}

$request = array();
$request['type'] = "login";
$request['username'] = $_GET["username"];
$request['password'] = $_GET["password"];
$request['message'] = "HI";
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
$payload = json_encode($response);
echo $payload;
echo "\n\n";

echo $argv[0]." END".PHP_EOL;

function redirect($message, $targetfile){
	$message = "You have logged in redirecting to home page";
	echo $message;
	header("refresh: 5; url=home.html");
	exit();
}

?>


