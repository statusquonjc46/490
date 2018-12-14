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

        echo "Pull directory?(pull) ";
        $dir = trim(fgets(STDIN));

	if($dir='pull'){
		$check = false;
		$ser = 1;
		$end = true;
		$untar = 0;
		while($end==true){
			echo "Front end or back end?(front or back) ";
                	$loc = trim(fgets(STDIN));
                        if($loc=='front'){
                                $end = false;
                                $eNum = 0;
                        }
                        elseif($loc=='back'){
                                $end = false;
                                $eNum = 1;
                        }
                }

		$request = array();
		$request['type'] = "work";
		$request['location'] = $eNum;
		$response = $client->send_request($request);
		//$response = $client->publish($request);
		
		echo "client received response: ".PHP_EOL;
		print_r($response);
		echo "Enter version ";
		$ver = trim(fgets(STDIN));
        }
}
$request = array();
$request['type'] = "prod";
$request['version'] = $ver;
$request['service'] = $ser;
$request['location'] = $eNum;
//$response = $client->send_request($request);
//$response = $client->publish($request);
echo "hello";
if($untar==0){
	if($eNum==0){
		shell_exec("/home/test1/git/490/deployment/untar-front.sh '".$ver."'");
	}
	elseif($eNum==1){
		shell_exec("/home/test1/git/490/deployment/untar-back.sh '".$ver."'");
	}
}
echo "client received response: ".PHP_EOL;
//print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
