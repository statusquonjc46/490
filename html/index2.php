<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head> <meta charset = "utf-8" /> </head>
<body>

<h1>login page</h1>

        <form id='login' action='/loggingin.php' method='get' accept-charset='UTF-8'>
        <fieldset>
        <legend>Login</legend>
        <input type='hidden' name='submitted' id='submitted' value='1'/>
        <label for='username'> Username:</label>
	<input type='text' name='username' id='username' maxlength="50" placeholder="Enter Username" required autofocus autocomplete=on />
        <label for='password'> Password:</label>
        <input type='password' name='password' id='password' maxlength="50"placeholder="Enter Password" required autofocus autocomplete=on />
        <input type='submit' name='submit' value='submit'/>
	</fieldset>
        </form>

	<form action='register.html' method='post'>
                <button type='submit'>Registration</button>
        </form>
</body>
</html>

