<?php

function apis($make, $model, $year){

$results = shell_exec('GET https://one.nhtsa.gov/webapi/api/Recalls/vehicle/modelyear/'.$year.'/make/'.$make.'/model/'.$model.'?format=json');
$arrayCode = json_decode($results, true);
$apiCode = array_values($arrayCode);
var_dump($apiCode[2][0]);


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

}
apis('ford', 'focus', '2018');
?>

