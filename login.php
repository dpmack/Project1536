<?php
include 'helpers/auth.php';
?>

<html>
<head>
<title>Login</title>
<?php
if ($loggedin)
{
	echo "<META HTTP-EQUIV=Refresh CONTENT='3; URL=success.php'>";
}
?>
</head>
<body>
<?php
if ($loggedin)
{
	echo "Login successful, redirecting in 3 seconds. Or click <a href='success.php'>here</a>";
}
else
{
	echo '<form id="login" method="post" action="login.php">
	Username:<br />
	<input name="username" type="text" /><br />
	Password:<br />
	<input name="password" id="password" type="password" /><br />
	<button type="button" onclick="btnSubmitClick()">Submit</button>
</form>';
}
?>

<script type="text/javascript" src="script/md5.js"></script>

<script type="text/javascript">
	function btnSubmitClick()
	{
		var txtPassword = document.getElementById("password");
		txtPassword.value = b64_md5(txtPassword.value);
		var fmLogin = document.getElementById("login");
		fmLogin.submit();
	}
</script>

</body>
</html>