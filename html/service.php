<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>RECALL LOOKUP </title>
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
        <li class="active"><a href="service.php"> RECALL LOOKUP </a></li>
        <li><a href=""> ABOUT </a></li>
        <li><a href="register2.html"> SIGN UP </a></li>
        <li><a href="index.html"> LOG IN </a></li>
        <li><a href="logout2.php"> LOG OUT </a></li>
       
    </ul>    
        
    </div>
        
    <div class="hero">
    <h1>Please enter your car information below</h1>
    <form id='recall' action='apiClient.php' method='get' accept-charset='UTF-8'>
        
        
        <input type='hidden' name='submitted' id='submitted' value='1'/>
        <label for='make'> Make of Vehicle:</label>
        <input type='text' name='make' id='make' maxlength="50"/>
        <label for='model'> Model of Vehicle:</label>
        <input type='text' name='model' id='model' maxlength="50"/>
        <label for='year'> Year of Vehicle:</label>
        <input type='text' name='year' id='year' maxlength="50"/>
        <input type='submit' name='submit' value='submit'/>
        
     </form>
    
    </div>
        </div>
    </header>

        
</body>    
</html>
