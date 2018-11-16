<?php


require_once('/home/njc46/490/490/path.inc');
require_once('/home/njc46/490/490/get_host_info.inc');
require_once('/home/njc46/490/490/rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
	$msg = $argv[1];
}
else
{
	$msg = "test";
}
$uid = $_GET["username"];
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
#$check = $argv[0];
if($payload==1)
{
	session_start();
	$_SESSION['username'] = $uid;
	header('Location: /home.php');
	exit();
}
else
{
	header('Location: /index.html');
	exit();
}
?>


