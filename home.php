<?php

// Inialize session
session_start();
}

?>

<!DOCTYPE html>
<html>
<title>Website</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<style>
    
body {font-family: "Times New Roman", Georgia, Serif;}
h1,h2,h3,h4,h5,h6 {
    font-family: "Playfair Display";
    letter-spacing: 5px;
}
</style>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
    <a href="home.html" class="w3-bar-item w3-button">ARS</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="about.html" class="w3-bar-item w3-button">About</a>
      <a href="service.html" class="w3-bar-item w3-button">Service</a>
      <a href="home.html" class="w3-bar-item w3-button">Contact Us</a>
         <a href="index2.html" class="w3-bar-item w3-button"> Log In</a>
        <a href="index2.html" class="w3-bar-item w3-button"> Logout</a>
        
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
  <img class="w3-image" src="/w3images/hamburger.jpg" alt="Hamburger Catering" width="1600" height="800">
  <div class="w3-display-bottomleft w3-padding-large w3-opacity">
    <h1 class="w3-xxlarge">Le Catering</h1>
  </div>
</header>

<!-- Page content -->
<div class="w3-content" style="max-width:1100px">

  <!-- About Section -->
  <div class="w3-row w3-padding-64" id="about">
    <div class="w3-col m6 w3-padding-large w3-hide-small">
     <img src="recall.png" class="w3-round w3-image w3-opacity-min" width="600" height="100">
    </div>

    <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center">Automotive Recall Service</h1><br>
      <h5 class="w3-center">Since 2018</h5>
      <p class="w3-large"> Welcome to Automotive Recall Service Center. Here you can check if there is any open recall on your car. Also, its a great way to buy used car because you can check if the car's recall has been fixed or not. A recall is issued when a manufacturer or NHTSA determines that a vehicle, equipment, car seat, or tire creates an unreasonable safety risk or fails to meet minimum safety standards. Most decisions to conduct a recall and remedy a safety defect are made voluntarily by manufacturers prior to any involvement by NHTSA.Manufacturers are required to fix the problem by repairing it, replacing it, offering a refund. Using our car lookup tool, you can access recall information provided by the manufacturer conducting the recall which may be not posted yet on NHTSA’s site. </p>
    </div>
  </div>
  
  <hr>
  
  <!-- Menu Section -->
  <div class="w3-row w3-padding-64" id="Pricing">
    <div class="w3-col l6 w3-padding-large">
    <div class="w3-col l6 w3-padding-large">
    </div>
  </div>

  <hr>
  <!-- Contact Section -->
  
<!-- End page content -->
<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Powered by Karan, Nick, and Stephano</p>
</footer>
    </div>
    </div>
    
<?php 
$_SESSION['user'] = "kp378";
echo $SESSION['user'];

?>

</body>
</html>