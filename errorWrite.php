<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//$client = new rabbitMQClient("errorRabbitMQ.ini","testServer");

class errorWrite
{
	public $request = array();
	public $response;
	public $payload;

	function error_input($errorMessage)
	{
		$client = new rabbitMQClient("errorRabbitMQ.ini","testServer");
		$request['type'] = "error";
		$request['error'] = $errorMessage;
		$response = $client->send_request($request);
		//$response = $client->publish($request);

		echo "client received response: ".PHP_EOL;
		$payload = json_encode($response);
		echo $payload;
		echo "\n\n";

		echo $argv[0]." END".PHP_EOL;
	}

}



?>
