<?php

session_start();
session_regenerate_id();
$sid = session_id();
$_SESSION['username'];
$upUser = strtoupper($_SESSION['username']);
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1">


<head>
    <title>IT 490</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head> 
<body>
    <header>
        
    <div class="row">
	<div class="logo">
        <img src="logo.png"
    </div> 
            
    <ul class="main-nav">    
        <li class="active"><a href="home.php"> HOME </a></li>
        <li><a href="service.php"> RECALL LOOKUP </a></li>
	<li><a href="search.php"> SEARCH FOR MECHANIC </a></li>
	<?php
	echo "<li><a href='apiClient.php'>" . $upUser . "</a></li>";
	?>
        <li><a href="logout.php"> LOG OUT </a></li>
       
    </ul>    
        
        
    
    <h1>Recall Car Service </h1>    
            
    
     
    </header>
  
</body>    
</html>
