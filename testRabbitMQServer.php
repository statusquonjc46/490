#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('login.php.inc');

function doLogin($username,$password)
{
    // lookup username in databas
	// check password
    $login = new loginDB();
    return $login->validateLogin($username,$password);
    //return false if not valid
}

function doRegister($username, $password)
{
	$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "test");
	$query = "select username from users where username = '$username'";
	$result = mysqli_query($sqlcon, $query);
	$check = mysqli_num_rows($result);
	if($check!=0){
		echo ("Sorry this username has already been taken");
		return 0;
	}
	else{
		$d="insert into users(username, password) values('$username','$password')";
		($t = mysqli_query($sqlcon, $d)) or die (mysqli_error($sqlcon));
		return 1;
	}
}

function apiCall($make, $model, $year){
	$results = shell_exec('GET https://one.nhtsa.gov/webapi/api/Recalls/vehicle/modelyear/'.$year.'/make/'.$make.'/model/'.$model.'?format=json');
	
	$apiCode = json_decode($results, true);
	
	$c = count($apiCode['Results'], 0); //Checks the to see how many arrays exist
	var_dump($apiCode);
	for($x = 0; $x < $c; $x++)
	{
        	$qMake = $apiCode['Results'][$x]["Make"];
        	$qModel = $apiCode['Results'][$x]["Model"];
        	$qManufac = $apiCode['Results'][$x]["Manufacturer"];
        	$qCampNum = $apiCode['Results'][$x]["NHTSACampaignNumber"];
        	$qDate = $apiCode['Results'][$x]["ReportReceivedDate"];
	        $qSum = $apiCode['Results'][$x]["Summary"];
        	$qComp = $apiCode['Results'][$x]["Component"];
        	$qYear = $apiCode['Results'][$x]["ModelYear"];
        	$qNotes = $apiCode['Results'][$x]["Notes"];
	}

	/*
	
	$arrayCode = json_decode($results, true);
	$apiCode = array_values($arrayCode);
	var_dump($apiCode[2][0]);
	$qMake = $apiCode[2][0]["Make"];
	$qModel = $apiCode[2][0]["Model"];
	$qManufac = $apiCode[2][0]["Manufacturer"];
	$qCampNum = $apiCode[2][0]["NHTSACampaignNumber"];
	$qDate = $apiCode[2][0]["ReportReceivedDate"];
	$qSum = $apiCode[2][0]["Summary"];
	$qComp = $apiCode[2][0]["Component"];
	$qYear = $apiCode[2][0]["ModelYear"];
	$qNotes = $apiCode[2][0]["Notes"];
	 */
	$username = 'nick';
	$recallExist = "select username, make, model, modelyear from recallTable where username = '$username' and make = '$qMake' and model = '$qModel' and modelyear = '$qYear'";
	$sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "test");
	$existQ = mysqli_query($sqlcon, $recallExist);
	$check = mysqli_num_rows($existQ);
	if ($check != 0)
	{
		echo ("Recall Exists already.");
		return 0;

	}
	else
	{
		$storeData = "insert into recallTable(username, make, model, manufacturer, nhtsanumber, date, summary, notes, modelyear) values('$username', '$qMake', '$qModel', '$qManufac', '$qCampNum', '$qDate', '$qSum', '$qNotes', '$qYear')";
		$result = mysqli_query($sqlcon, $storeData);
		return 1;
		echo "$result";//echos 1 or 0, 1 being submit success, 0 being a failure.
	}

}

function show($make, $model, $year){
        $recallshow= "select * from recallTable where username = '$username' and make = '$qMake' and model = '$qModel' and modelyear = '$qYear'";
        $sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "test");
        $existQ = mysqli_query($sqlcon, $recallshow);
                echo ("<br>Username: $username");
                echo ("<br>Make: $qMake");
                echo ("<br>Model: $qModel");
                echo ("<br>Manufacturer: $qManufac");
                echo ("<br>NHTSA Campaign Number: $qCampNum");
                echo ("<br>Report Received Data: $qDate");
                echo ("<br>Summary: $qSum");
                echo ("<br>Component: $qComp");
                echo ("<br>Model Year: $qYear");
                echo ("<br>Notes: $qNotes");
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
     	    return doLogin($request['username'],$request['password']);
    case "validate_session":
	    return doValidate($request['sessionId']);
    case "register":
	    return doRegister($request['username'],$request['password']);
    case "api":
	    return apiCall($request['make'],$request['model'],$request['year']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>

