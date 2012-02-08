<?php

function embededLogin()
{
	return '
<form action="/login.php" method="POST">
	<fieldset>
		<!--<legend>login</legend>-->
				
		<label for="studentid">ID</label>
		<input type="text" name="studentid" value="" />
		<label for="password">Password
		</label><input type="password" name="password" value="" />
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