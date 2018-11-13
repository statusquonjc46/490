<?php

session_start();

?>

<!DOCTYPE>
<script type = "text/javascript">
	function countDown(secs, elem){
		var element = document.getElementById(elem);
		element.innerHTML = "To sign in, Please wait for <span style = 'color:red;'>"+secs+ "</span> Second(s)";
		if (secs<1){
			clearTimeout(timer);
			window.location = 'index.html';
		}
		secs--;
		var timer = setTimeout('countDown('+secs+',"'+elem+'")',1000);
	}
</script>

<div style="margin:0 auto;text-align:center;" class="container" id="Content">
<h3>You have Successfully logged out!</h3><br/><p id='status' style="font-size:12px;"></p></div>
<script type="text/javascript">countDown(5,"status");</script>
<?php
session_unset();
session_destroy();
?>
</body>
</html>
