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

    $sqlcon = mysqli_connect("localhost", "testuser", "Letmein123!", "test");
    $sqlstatement = "select password from users where username = '$username'";
    $result = mysqli_query($sqlcon, $sqlstatement);
    $rows = mysqli_num_rows($result);
    $checkArray = mysqli_fetch_assoc($result);
    $sqlPass = $checkArray["password"];
    
    if ($count == 1){
	    if(password_verify($password,$sqlPass)){
		    $response = "0";
	    	    return $response;
	    }
	    else{
		    $response = "1";
		    return $response;
	    }

    }
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
	}
	else{
		$d="insert into users(username, password) values('$username','$password')";
	        ($t = mysqli_query($sqlcon, $d)) or die (mysqli_error($sqlcon));
	}
}

function apiCall($make, $model, $year){
	$results = shell_exec('GET https://one.nhtsa.gov/webapi/api/Recalls/vehicle/modelyear/'.$year.'/make/'.$make.'/model/'.$model.'?format=json');
	$arrayCode = json_decode($results, true);
	$apiCode = array_values($arrayCode);
	var_dump($apiCode[2][0]["Make"]);

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

