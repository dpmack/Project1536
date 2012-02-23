<?php
include 'helpers/auth.php';
include "templates/head.php";
include "helpers/embededLogin.php";
?>

<?php
$headContent = "";
if ($GLOBALS['loggedIn'])
{
	$headContent = "<meta http-equiv='Refresh' content='3; URL=landing.php'>";
}

echo buildHead("Login",$headContent);
?>
<body>
<?php include "templates/header.php"; ?>

<?php
if ($GLOBALS['loggedIn'])
{
	echo "<span>Login successful, redirecting in 3 seconds. Or click <a class='classicLink' href='landing.php'>here</a></span>";
}
else
{
	?>
	<div id="login">
		<form id="loginInPage" method="post" action="login.php">
			Username:<br />
			<input name="username" type="text" /><br />
			Password:<br />
			<input id="passwordInPage" name="password" type="password" /><br />
			<input type="hidden" id="hiddenPasswordInPage" />
			<input type="submit" onclick="btnSubmitClick()" value="Login" />
			
			<p>
				<a href="/register.php">Register</a> / 
				<a href="/forgotpassword.php">Forgot Password</a>
			</p>
		</form>
	</div>
<?php
}
?>

<script type="text/javascript" src="script/md5.js"></script>

<script type="text/javascript">
	function btnSubmitClickInPage()
	{
		var txtPassword = document.getElementById("passwordInPage");
		var hdnPassword = document.getElementById("hiddenPasswordInPage");
		
		hdnPassword.value = Sha1.hash(txtPassword.value);
		hdnPassword.setAttribute("name","hPassword");
		txtPassword.removeAttribute("name");
	}
</script>

<?php include "templates/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "templates/sqlDebug.php";
}
?>
</body>
</html>