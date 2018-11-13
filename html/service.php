<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>RECALL LOOKUP </title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <style>
    
    * {
  margin: 0px;
  padding: 0px;
}
body {
  font-size: 120%;
  background: #F8F8FF;
}

.header {
  width: 30%;
  margin: 50px auto 0px;
  color: white;
  background: #5F9EA0;
  text-align: center;
  border: 1px solid #B0C4DE;
  border-bottom: none;
  border-radius: 10px 10px 0px 0px;
  padding: 20px;
}
form, .content {
  width: 30%;
  margin: 0px auto;
  padding: 20px;
  border: 1px solid #B0C4DE;
  background: white;
  border-radius: 0px 0px 10px 10px;
}
.input-group {
  margin: 10px 0px 10px 0px;
}
.input-group label {
  display: block;
  text-align: left;
  margin: 3px;
}
.input-group input {
  height: 30px;
  width: 93%;
  padding: 5px 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid gray;
}
.btn {
  padding: 10px;
  font-size: 15px;
  color: white;
  background: #5F9EA0;
  border: none;
  border-radius: 5px;
}
.error {
  width: 92%; 
  margin: 0px auto; 
  padding: 10px; 
  border: 1px solid #a94442; 
  color: #a94442; 
  background: #f2dede; 
  border-radius: 5px; 
  text-align: left;
}
.success {
  color: #3c763d; 
  background: #dff0d8; 
  border: 1px solid #3c763d;
  margin-bottom: 20px;
}
    </style>
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
        
       <div class="input-group"> 
        <input type='hidden' name='submitted' id='submitted' value='1'/>
           <label for='make'> Make of Vehicle:</label>
        </div>
        <div class="input-group">
        <input type='text' name='make' id='make' maxlength="50"/>
            <label for='model'> Model of Vehicle:</label></div>
        <div class="input-group">
        <input type='text' name='model' id='model' maxlength="50"/>
            <label for='year'> Year of Vehicle:</label></div>
        <div class="input-group">
        <input type='text' name='year' id='year' maxlength="50"/>
            <input type='submit' name='submit' value='submit'/></div>
        
     </form>
    
    </div>
        </div>
    </header>

        
</body>    
</html>
