<?php

session_start();
session_regenerate_id();
$sid = session_id();
echo $_SESSION['username'];
?>

<html>
    
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
        <li class="active"><a href=""> HOME </a></li>
        <li><a href="service.php"> RECALL LOOKUP </a></li>
        <li><a href=""> ABOUT </a></li>
        <li><a href="logout.php"> LOG OUT </a></li>
       
    </ul>    
        
    </div>
        
    <div class="hero">
    <h1>Recall Car Service </h1>
        
    <div class="button">
     
    </div>    
            
    </div>
        </div>
    </header>


        
</body>    
</html>
