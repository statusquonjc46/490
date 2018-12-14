#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("deployRabbit.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $mg = "test message";
}
$check=true;
while($check==true){

	echo "Enter version number: ";
	$ver = trim(fgets(STDIN));
	echo "Is version working?(yes or no) ";
	$work = trim(fgets(STDIN));

	if($work=='yes'){
		$num = 1;
		$check = false;
	}
	elseif($work=='no'){
		$num = 0;
		$check = false;
	}
}
$request = array();
$request['type'] = "qa";
$request['version'] = $ver;
$request['working'] = $num;
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
