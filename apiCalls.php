<?php
$results = shell_exec('GET https://one.nhtsa.gov/webapi/api/Recalls/vehicle/modelyear/2018/make/ford/model/focus?format=json');
$arrayCode = json_decode($results, true);
$apiCode = array_values($arrayCode);
var_dump($apiCode[2][0]["Make"]);


#for ($i = 0; $i < count($apiCode); $i++){
#	var_dump($apiCode[$i]);
#echo $arrayCode[$i];
#	if ($i == 2){
#		for ($j = 0; $j < count($innerArray); $j++){
#			print_r($j);
#		}
#	}
#}
#var_dump($arrayCode);
?>
