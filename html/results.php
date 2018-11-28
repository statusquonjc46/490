<?php
session_start();
session_regenerate_id();
$_SESSION['username'];
$_SESSION['payload'];
$sArray = $_SESSION['payload'];
$upUser = strtoupper($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<header>
<div class="row">
        <div class="logo">
        <img src="logo.png"
</div>
<ul class="main-nav">
        <li><a href="home.php"> HOME </a></li>
        <li><a href="service.php"> RECALL LOOKUP </a></li>
	<li><a href=""> ABOUT </a></li>
	`<?php
        echo "<li class='active'><a href='apiClient.php'>" . $upUser . "</a></li>";
        ?>
        <li><a href="logout.php"> LOG OUT </a></li>

    </ul>
     <h2>Recalls</h2>
      <table>
        <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Manufacturer</th>
                <th>NHTS Number</th>
                <th>Date</th>
                <th>Summary</th>
                <th>Fixed</th>
        </tr>
        <?php
	$c = count($sArray, 0);
	for($x = 0; $x < $c; $x++)
	{
		echo "<tr><td>" . $sArray[$x]['make'] . "</td><td>" . $sArray[$x]['model'] . "</td><td>" . $sArray[$x]['modelyear'] . "</td><td>" . $sArray[$x]['manufacturer'] . "</td><td>" . $sArray[$x]['nhtsanumber'] . "</td><td>" . $sArray[$x]['date'] . "</td><td>" . $sArray[$x]['summary'] . "</td><td>";
		echo "<form id='fixed' action='fixedClient.php' method='post'><input type='hidden' name='cNum' value=" . $sArray[$x]['nhtsanumber']. "><input type='hidden' name='box' value='0'><input type='checkbox' name='box' value='1'";
		if($sArray[$x]['fixed'] == 1){ 
			echo "checked='checked'";
		}	
		echo "><input type='submit' value='Submit'></form>" . "</td></tr>";
	}
        ?>
      </table>
</header>
</body>
</html>

