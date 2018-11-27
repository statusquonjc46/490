<?php
session_start();
session_regenerate_id();
$_SESSION['username'];
$_SESSION['payload'];
$rArray = $_SESSION['payload'];
echo $rArray;
foreach($rArray as $sArray)
        {
                echo "<tr><td>" . $sArray['make'] . "</td><td>" . $sArray['model'] . "</td><td>" . $sArray['modelyear'] . "</td><td>" . $sArray['manufacturer'] . "</td><td>" . $sArray['nhtsanumber'] . "</td><td>" . $sArray['date'] . "</td><td>" . $sArray['summary'] . "</td><td>" . $sArray['notes'] . "</td></tr>";
        }

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
       # while($row = $sArray)
	foreach($rArray as $sArray)
	{
                echo "<tr><td>" . $sArray['make'] . "</td><td>" . $sArray['model'] . "</td><td>" . $sArray['modelyear'] . "</td><td>" . $sArray['manufacturer'] . "</td><td>" . $sArray['nhtsanumber'] . "</td><td>" . $sArray['date'] . "</td><td>" . $sArray['summary'] . "</td><td>" . $sArray['notes'] . "</td></tr>";
	}
        ?>
      </table>
</body>
</html>

