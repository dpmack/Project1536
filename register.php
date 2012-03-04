<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";
?>

<?php
$headContent = '<link rel="stylesheet" type="text/css" href="css/register.css" />'
	. '<script type="text/javascript" src="/script/jquery.validate.js"></script>'
	. '<script type="text/javascript" src="/script/register.js"></script>';
	
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

<div class="section">
	<h2 class="first">Registration</h2>
	<form action="http://webdevfoundations.net/scripts/formdemo.asp" id="registration" method="post">
		<fieldset>
			<legend>Name</legend>
			<p>If you do not wish to provide your name, you may use an alias. This name is publicly visible in the CSThub forums; to CSThub members and visitors alike.</p>
			<label for="fname" title="First name">First Name</label><input type="text" name="fname" id="fname" />
			<label for="lname" title="Last name">Last Name</label><input type="text" name="lname" id="lname" />

		</fieldset>
	
		<fieldset>
			<legend>Student ID</legend>
			<p>You <strong>must</strong> use your own BCIT student ID. Using another ID is against our <a href="#terms">terms of service</a>.</p>
			<label for="studentID" title="Student ID">BCIT ID</label><input type="text" name="studentID" id="studentID" />
		</fieldset>
	
		<fieldset>
			<legend>Email Address</legend>
			<p>We need an email address to validate your account. We will not share it with others. Other members of CSThub will not see this email address unless you explicitly allow them to.</p>
			<label for="email" title="Email address">Email</label><input type="text" name="email" id="email" />
			<label for="emailConfirm" title="Confirm email address">Confirm</label><input type="text" name="emailConfirm" id="emailConfirm" />
		</fieldset>
	
		<fieldset>
			<legend>Password</legend>
			<p>Do <strong>not</strong> use one of your BCIT passwords. Use a password unique to CSThub.</p>
			<label for="passwordRegister">Password</label><input type="password" name="passwordRegister" id="passwordRegister" />
			<label for="passwordConfirm" title="Confirm password">Confirm</label><input type="password" name="passwordConfirm" id="passwordConfirm" />
		</fieldset>
		
		<fieldset id="terms">
			<legend><h3>Terms of Service</h3></legend>
			<p>
			You must read and agree with our terms of service to use this site.
			CSThub is not liable for any damages of leaked password or lost data (including, but not limited to homework, eaten by your dog.)
			
			These are our terms and conditions be sure to remeber them well peons. All your base belong to us. These are our terms and conditions be sure to remeber them well peons. All your base belong to us. 
			</p>
			<label for="agree">I agree with these terms.</label><input id="agree" type="checkbox" title="You must agree to our terms." name="agree" value="terms" />
		</fieldset>
	
		<fieldset>
			<input type="submit" id="submit" value="Join!" />
		</fieldset>
	</form>
</div><!-- section -->

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>
