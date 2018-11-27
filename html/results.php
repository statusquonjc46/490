<?php
session_start();
session_regenerate_id();
$_SESSION['username'];
$_SESSION['payload'];
$sArray = $_SESSION['payload'];
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
        <li><a href=""> HOME </a></li>
        <li class="active"><a href="service.php"> RECALL LOOKUP </a></li>
        <li><a href=""> ABOUT </a></li>
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
                <th>Notes</th>
        </tr>
        <?php
	$c = count($sArray, 0);
	for($x = 0; $x < $c; $x++)
	{
                echo "<tr><td>" . $sArray[$x]['make'] . "</td><td>" . $sArray[$x]['model'] . "</td><td>" . $sArray[$x]['modelyear'] . "</td><td>" . $sArray[$x]['manufacturer'] . "</td><td>" . $sArray[$x]['nhtsanumber'] . "</td><td>" . $sArray[$x]['date'] . "</td><td>" . $sArray[$x]['summary'] . "</td><td>" . $sArray[$x]['notes'] . "</td></tr>";
	}
        ?>
      </table>
</header>
</body>
</html>

