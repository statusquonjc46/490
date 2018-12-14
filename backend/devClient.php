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
        echo "Push directory?(yes or no) ";
        $work = trim(fgets(STDIN));

        if($work=='yes'){
		$check = false;
		echo "Front end or back end?(front or back) "
		$loc = trim(fgets(STDIN));
		if($loc=='front'){
			$num = 0;
			shell_exec("/home/test1/git/490/deployment/tar-front.sh '".$ver."'");
		}
		elseif($loc=='back'){
			$num = 1;
			shell_exec("/home/test1/git/490/deployment/tar-back.sh '".$ver."'");
		}
        }
        elseif($work=='no'){
		$check = false;
		break;
        }
}
$request = array();
$request['type'] = "dev";
$request['version'] = $ver;
$request['location'] = $num;
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;

