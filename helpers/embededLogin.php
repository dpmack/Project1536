<?php

function embededLogin()
{
	return '
<form action="/login.php" method="POST">
	<fieldset>
		<!--<legend>login</legend>-->
				
		<label for="username">ID</label>
		<input type="text" id="username" name="username" value="" />
		<label for="password">Password
		</label><input type="password" id="password" name="password" value="" />
		<input type="submit" value="login" />
					
		<p>
			<a href="/register.html">Register</a>
			<a href="/forgotpassword.html">Forgot Password</a>
		</p>
					
	</fieldset>
</form>';
}

function loggedInUser()
{
	return '
<img alt="userPicture">David, Mack<br />
<a href="/logout.php">Logout</a>';
}