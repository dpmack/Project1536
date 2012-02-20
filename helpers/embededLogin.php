<?php

function embededLogin()
{
	return '
<form id="loginForm" action="login.php" method="post">
	<fieldset>
		<!--<legend>login</legend>-->
				
		<label for="username">ID</label><br />
		<input type="text" id="username" name="username" value="" /><br />
		<label for="password">Password</label>
		<br /><input type="password" id="password" name="password" value="" /><br />
		<button type="button" onclick="btnSubmitClick()">Login</button>
					
		<p>
			<a href="/register.php">Register</a> / 
			<a href="/forgotpassword.php">Forgot Password</a>
		</p>
					
	</fieldset>
</form>
<script type="text/javascript" src="script/md5.js"></script>

<script type="text/javascript">
	function btnSubmitClick()
	{
		var txtPassword = document.getElementById("password");
		txtPassword.value = b64_md5(txtPassword.value);
		var fmLogin = document.getElementById("loginForm");
		fmLogin.submit();
	}
</script>';
}

function loggedInUser()
{
	return '
<img class="userPicture" alt="userPicture">David, Mack<br />
<a href="/landing.php">My Home</a><br />
<br />
<a href="/logout.php">Logout</a>';
}