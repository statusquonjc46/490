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
</head>
<body>
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
</body>
</html>

