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

        echo "Update working status or pull directory?(update or pull) ";
        $dir = trim(fgets(STDIN));

        if($dir=='update'){
		$check = false;
		$ser = 0;

		echo "Is version working?(yes or no) ";
        	$work = trim(fgets(STDIN));
		
		if($work=='yes'){
			echo "Enter version ";
                	$ver = trim(fgets(STDIN));
                	$num = 1;
        	}
		elseif($work=='no'){
			echo "Enter version ";
                        $ver = trim(fgets(STDIN));
                	$num = 0;
		}
		$end = true;
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
        }
	elseif($dir='pull'){
		$check = false;
		$ser = 1;
		$end = true;
		$num = 0;
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
		$request['type'] = "all";
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
$request['type'] = "qa";
$request['version'] = $ver;
$request['service'] = $ser;
$request['working'] = $num;
$request['location'] = $eNum;
$response = $client->send_request($request);
//$response = $client->publish($request);
echo "hello";
echo "client received response: ".PHP_EOL;
//print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;

