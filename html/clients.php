<?php
session_start();
session_regenerate_id();
$_SESSION['username'];

require_once('/home/test1/git/490/path.inc');
require_once('/home/test1/git/490/get_host_info.inc');
require_once('/home/test1/git/490/rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
        $msg = $argv[1];
}
else
{
        $msg = "test";
}

if($_GET["login"]){
	$uid = $_GET["username"];
	$request = array();
	$request['type'] = $_GET["login"];
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
}

if($_GET["register"]){
	$request = array();
	$request['type'] = "register";
	$request['username'] = $_GET["username"];
	$request['password'] = $_GET["password"];
	$response = $client->send_request($request);
	//$response = $client->publish($request);

	echo "client received response: ".PHP_EOL;
	$payload = json_encode($response);
	echo $payload;
	echo "\n\n";

	echo $argv[0]." END".PHP_EOL;

	if($payload==1)
	{
        	header('Location: /index.html');
        	exit();
	}
	else
	{
        	header('Location: /register2.html');
        	exit();
	}
}

if($_GET["api"]){
	$request = array();
	$request['type'] = "api";
	$request['username'] = $_SESSION["username"];
	$request['make'] = $_GET["make"];
	$request['model'] = $_GET["model"];
	$request['year'] = $_GET["year"];
	$response = $client->send_request($request);

//$response = $client->publish($request);

	echo "client received response: ".PHP_EOL;
	$payload = $response;

	echo "\n\n";

	$_SESSION['payload'] = $payload;

	echo $argv[1]." END".PHP_EOL;

	header('Location: /results.php');
	exit();
}

if($_POST["fix"]){
	$request = array();
	$request['type'] = "fix";
	$request['username'] = $_SESSION["username"];
	$request['box'] = $_POST["box"];
	$request['cNum'] = $_POST["cNum"];
	$response = $client->send_request($request);
	//$response = $client->publish($request);

	echo "client received response: ".PHP_EOL;

	$payload = $response;

	echo "\n\n";

	$_SESSION['payload'] = $payload;

	echo $argv[1]." END".PHP_EOL;

	header('Location: /results.php');
	exit();

}

if($_POST["delete"]){
	$request = array();
	$request['type'] = "delete";
	$request['username'] = $_SESSION["username"];
	$request['cNum'] = $_POST["cNum"];
	$response = $client->send_request($request);
	//$response = $client->publish($request);

	echo "client received response: ".PHP_EOL;
	$payload = $response;

	echo "\n\n";

	$_SESSION['payload'] = $payload;

	echo $argv[1]." END".PHP_EOL;

	header('Location: /results.php');
	exit();
}
?>
