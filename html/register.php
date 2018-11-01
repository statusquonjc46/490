<?php
function create ( $username, $password ) {
	global $db;
	
	$output .= "<br>Your Account $username and $password";
	$d="insert into user values('$username','$password')";
	($t = mysqli_query($db, $d)) or die (mysqli_error($db));

	$s = "select * from user where user = '$user' and pass = '$password'";
	$output.=<br>SQL statement is: $s<br>";

	while ($r = mysqli_fetch_array($t,MYSQLI_ASSOC)){
		$username = $r ["user"]; $password = $r ["pass"];

		$output.="<br>User: $username";
		$output.="<br>Pass: $password";
	}
	$output .= "<br>*******************************************<br>";
	echo $output
}
