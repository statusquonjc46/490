<?php
session_start();
?>

<?php
require_once('/home/test1/git/490/path.inc');
require_once('/home/test1/git/490/get_host_info.inc');
require_once('/home/test1/git/490/rabbitMQLib.inc');

//Goes into /var/www/html/

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
?>

