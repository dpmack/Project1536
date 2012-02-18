<?php

function embededLogin()
{
	return '
<form id="loginForm" action="login.php" method="post">
	<fieldset>
		<!--<legend>login</legend>-->
				
		<label for="username">ID</label>
		<input type="text" id="username" name="username" value="" />
		<label for="password">Password
		</label><input type="password" id="password" name="password" value="" />
		<button type="button" onclick="btnSubmitClick()">Submit</button>
					
		<p>
			<a href="/register.php">Register</a>
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
<img alt="userPicture">David, Mack<br />
<a href="/logout.php">Logout</a>';
}