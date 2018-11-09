<head> <meta charset = "utf-8" /> </head>
<body>

<h1>Vehicle Recalls</h1>
	<h2>Enter the information requested, to see if there are recalls for your vehicle</h3>
        <form id='recall' action='apiClient.php' method='get' accept-charset='UTF-8'>
        <fieldset>
        <legend>Vehicle Recalls</legend>
        <input type='hidden' name='submitted' id='submitted' value='1'/>
        <label for='make'> Make of Vehicle:</label>
        <input type='text' name='make' id='make' maxlength="50"/>
        <label for='model'> Model of Vehicle:</label>
        <input type='text' name='model' id='model' maxlength="50"/>
	<label for='year'> Year of Vehicle:</label>
        <input type='text' name='year' id='year' maxlength="50"/>
        <input type='submit' name='submit' value='submit'/>
        </fieldset>
        </form>
</body>
</html>

