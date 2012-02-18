<?php
include 'helpers/auth.php';
include "templates/head.php";
include "helpers/embededLogin.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
$headContent = '';
echo buildHead("Registration",$headContent);
?>
<body>
<?php
include "templates/header.php";

if ($GLOBALS['loggedIn'])
{	
	echo "You are already registered";
	
	include "templates/footer.php";
	
	if ($GLOBALS['sql_debug'] != 0)
	{
		include "templates/sqlDebug.php";
	}
	die();
}
?>

<h1 class="first">Registration</h1>
<form action="register.php" method="POST">
	<fieldset>
		<legend><label for="name">Name</label></legend>
		<input type="text" name="name" id="name" />
	</fieldset>
	
	<fieldset>
		<legend><label for="studentID">Student ID</label></legend>
		<input type="text" name="studentID" id="studentID" />
	</fieldset>
	
	<fieldset>
		<legend><label for="email">Email Address</label></legend>
		<label for="email">Email Address</label><input type="text" name="email" id="email" />
		<label for="emailConfirm">Email Address Confirm</label><input type="text" name="emailConfirm" id="emailConfirm" />
	</fieldset>
	
	<fieldset>
		<legend><label for="password">Password</label></legend>
		<label for="password">Password</label><input type="password" name="password" id="password" />
		<label for="passwordConfirm">Password Confirm</label><input type="password" name="passwordConfirm" id="passwordConfirm" />
	</fieldset>
	
	<input type="submit" value="Sign up" />
</form>

<?php include "templates/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "templates/sqlDebug.php";
}
?>
</body>	
</html>