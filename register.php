<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";
?>

<?php
$headContent = '<link rel="stylesheet" type="text/css" href="css/register.css" />';
echo buildHead("Registration",$headContent);
?>
<body>
<?php
include "helpers/header.php";

if ($GLOBALS['loggedIn'])
{	
	echo "You are already registered";
	
	include "helpers/footer.php";
	
	if ($GLOBALS['sql_debug'] != 0)
	{
		include "helpers/sqlDebug.php";
	}
	die();
}
?>

<h2 class="first">Registration</h2>
<form action="register.php" method="post">
	<fieldset>
		<legend><label for="fname">Name</label></legend>
		<label for="fname">First Name:</label><input type="text" name="fname" id="fname" />
		<label for="lname">Last Name:</label><input type="text" name="lname" id="lname" />

	</fieldset>
	
	<fieldset>
		<legend><label for="studentID">Student ID</label></legend>
		<label for="studentID">ID:</label><input type="text" name="studentID" id="studentID" />
	</fieldset>
	
	<fieldset>
		<legend><label for="email">Email Address</label></legend>
		<label for="email">Email Address:</label><input type="text" name="email" id="email" />
		<label for="emailConfirm">Email Address Confirm:</label><input type="text" name="emailConfirm" id="emailConfirm" />
	</fieldset>
	
	<fieldset>
		<legend><label for="passwordRegister">Password</label></legend>
		<label for="passwordRegister">Password:</label><input type="password" name="passwordRegister" id="passwordRegister" />
		<label for="passwordConfirm">Password Confirm:</label><input type="password" name="passwordConfirm" id="passwordConfirm" />
	</fieldset>
	
	<h2>Terms And Conditions</h2>
		<p id="terms">These are our terms and conditions be sure to remeber them well peons. All your base belong to us. These are our terms and conditions be sure to remeber them well peons. All your base belong to us. 
		These are our terms and conditions be sure to remeber them well peons. All your base belong to us. These are our terms and conditions be sure to remeber them well peons. All your base belong to us. 
		These are our terms and conditions be sure to remeber them well peons. All your base belong to us. These are our terms and conditions be sure to remeber them well peons. All your base belong to us. 
		These are our terms and conditions be sure to remeber them well peons. All your base belong to us. These are our terms and conditions be sure to remeber them well peons. All your base belong to us. 
		These are our terms and conditions be sure to remeber them well peons. All your base belong to us. These are our terms and conditions be sure to remeber them well peons. All your base belong to us. 
	</p>
	
	<input id="agree" type="checkbox" name="terms" value="terms" /> I Agree

	<div id="accept">
	<input type="submit" id="submit" value="Sign up" />
	</div>
</form>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>