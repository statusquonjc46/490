<?php
session_start();
session_regenerate_id();
$_SESSION['username'];
$upUser = strtoupper($_SESSION['username']);
if(isset($_POST['submit']))
{
	header('Location:https://www.google.com/maps/search/?api=1&query=mechanic+' . $_POST['city'] .'+' . $_POST['state']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
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

h2
{
    color: white;
    text-transform: uppercase;
    font-size: 70px;
    text-align: center;
    margin-top: 275px;

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
        <li><a href="service.php"> RECALL LOOKUP </a></li>
        <li class="active"><a href="search.php"> SEARCH FOR MECHANIC </a></li>
        <?php
        echo "<li><a href='apiClient.php'>" . $upUser . "</a></li>";
        ?>
        <li><a href="logout.php"> LOG OUT </a></li>

    </ul>

    </div>

    <div class="hero">
    <h2>Enter your city and state to search for mechanics in your area.</h2>
    <form id='recall' target='_blank' action='' method='post' accept-charset='UTF-8'>

       <div class="input-group">
        <input type='hidden' name='submitted' id='submitted' value='1'/>
           <label for='city'> City:</label>
        </div>
        <div class="input-group">
        <input type='text' name='city' id='city' maxlength="50"/>
            <label for='state'> State:</label></div>
        <div class="input-group">
        <input type='text' name='state' id='state' maxlength="50"/>
            <input type='submit' name='submit' value='submit'/></div>

     </form>
    </div>
        </div>
                                                                                87,1          94%
</header>


</body>
</html>

