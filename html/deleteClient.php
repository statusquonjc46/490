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

$request = array();
$request['type'] = "delete";
$request['username'] = $_SESSION["username"];
$request['cNum'] = $_POST["cNum"];
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
#$payload = json_encode($response);
$payload = $response;

echo "\n\n";

$_SESSION['payload'] = $payload;

echo $argv[1]." END".PHP_EOL;

header('Location: /results.php');
exit();
?>
