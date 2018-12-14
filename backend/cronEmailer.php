<?php
require_once('emailer.php');

$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "test");

$get = ("select * from optEmail where opt='1'");
$query = mysqli_query($sqlcon, $get);
while($row=mysqli_fetch_assoc($query))
{
        $selection[] = $row;
}

$count = count($selection, 0);

for($x=0;$x<$count;$x++)
{
	$user = $selection[$x]['username'];
	$make = $selection[$x]['make'];
	$model = $selection[$x]['model'];
	$year = $selection[$x]['year'];
	
	$results = shell_exec('GET https://one.nhtsa.gov/webapi/api/Recalls/vehicle/modelyear/'.$year.'/make/'.$make.'/model/'.$model.'?format=json');
	$apiCode = json_decode($results, true);

	$c = count($apiCode['Results'], 0);

	for($i = 0; $i < $c; $i++)
	{
        	$qCampNum = $apiCode['Results'][$i]["NHTSACampaignNumber"];
		$recallExist = "select username, nhtsanumber from recallTable where username = '$user' and nhtsanumber = '$qCampNum'";
                $existQ = mysqli_query($sqlcon, $recallExist);
		$check = mysqli_num_rows($existQ);
		
		if($check == 0){
			$qMake = $apiCode['Results'][$i]["Make"];
                	$qModel = $apiCode['Results'][$i]["Model"];
                	$qManufac = $apiCode['Results'][$i]["Manufacturer"];
	                $qDate = $apiCode['Results'][$i]["ReportReceivedDate"];
	                $qSum = $apiCode['Results'][$i]["Summary"];
	                $qComp = $apiCode['Results'][$i]["Component"];
	                $qYear = $apiCode['Results'][$i]["ModelYear"];
	                $qNotes = $apiCode['Results'][$i]["Notes"];

			$storeData = ("insert into recallTable(username, make, model, manufacturer, nhtsanumber, date, summary, notes, modelyear) values('$user', '$qMake', '$qModel', '$qManufac', '$qCampNum', '$qDate', '$qSum', '$qNotes', '$qYear')");
                        ($r = mysqli_query($sqlcon, $storeData)) or die(mysqli_error($sqlcon));

			$getEmail = ("select email from users where username='$user'");
                        $queryEmail = mysqli_query($sqlcon, $getEmail);
                        while($row=mysqli_fetch_assoc($queryEmail))
                        {
                                $sEmail[] = $row;
                        }
                        $address = $sEmail[0]['email'];
			$email = new emailer;
			$email->recall_email($address,$user,$make,$model,$year,$qSum);
			continue;
		}
		else{
			continue;
		}
	}	
}

?>
