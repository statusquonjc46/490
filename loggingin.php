
<?php
require_once('./home/njc46/490project/rabbitmqphp_example/path.inc');
require_once('./home/njc46/490project/rabbitmqphp_example/get_host_info.inc');
require_once('./home/njc46/490project/rabbitmqphp_example/rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");


$request = array();
$request['type'] = "login";
$request['username'] = $_POST["username"];
$request['password'] = $_POST["pasword"];
$request['message'] = "HI";
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
?>

<html>
<head>
<title>Logging in..</title>
<body>
	<?php
		if ($response == "0")
		{
			session_start();
			echo "<p>login succesful</p>";
		}
		else
		{
			echo "<p>login not successful</p>";
			header('refresh: 3; url=../login.html');
		}
	?>
</body>
</html>

