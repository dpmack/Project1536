<?php
include 'helpers/auth.php';
include "helpers/head.php";

if ($GLOBALS["loggedIn"])
{	
	logout();
}

$firstName = (isset($_POST["firstName"])) ? $_POST["firstName"] : "";
$lastName = (isset($_POST["lastName"])) ? $_POST["lastName"] : "";
$studentID = (isset($_POST["studentID"])) ? $_POST["studentID"] : "";
$email = (isset($_POST["email"])) ? $_POST["email"] : "";
$emailConfirm = (isset($_POST["emailConfirm"])) ? $_POST["emailConfirm"] : "";
$terms = (isset($_POST["agree"]) && $_POST["agree"] == "terms");

if (isset($_POST["hPasswordConfirm"]))
{
	$passwordConfirm = $_POST["hPasswordConfirm"];
}
else if (isset($_POST["passwordConfirm"]))
{
	$passwordConfirm = sha1($_POST["passwordConfirm"]);
}
else
{
	$passwordConfirm = "";
}

if (isset($_POST["hPassword"]))
{
	$password = $_POST["hPassword"];
	$passwordLength = -1;
}
else if (isset($_POST["password"]))
{
	$password = sha1($_POST["password"]); 
	$passwordLength = strlen($_POST["password"]);
}
else
{
	$password = "";
}

// Validating your information.
$validated = true;
$studentIDExist = false; 

function isValidEmail($email)
{
	return true;//CREATE THIS OR FILL IN
}

function sendSignUpEmail($accountID)
{
	list($email, $hash) =  createNewEmailConfirm($accountID);
	
	mail($email,"Verify Your Email Address","Thank you for signing up for CST Hub, please verify your email address by clicking this link.
<a href='http://localhost/setuppassword.php?id=" . $hash);
}

if ($firstName == "" || $lastName == "" || $email == "" || $emailConfirm == "" || $studentID == "" || $password == "" || $passwordConfirm == "" || $terms == false)
{
	$validated = false;
}
else if ($email != $emailConfirm)
{
	$validated = false;
}
else if (!isValidEmail($email))
{
	$validated = false;
}
else if ($password != $passwordConfirm)
{
	$validated = false;
}
else if ($passwordLength < 8 && $passwordLength != -1)
{
	$validated = false;
}
else if (doesStudentIDExist($studentID))
{
	$validated = false;
	$studentIDExist = true;
}
else
{	
	$accountID = createUser($studentID, $firstName, $lastName, $email, $password);
	sendSignUpEmail($accountID);
	header("Location: registersuccess.php");
}
?>

<?php
$headContent = '<link rel="stylesheet" type="text/css" href="/css/register.css" />
<script type="text/javascript" src="/script/jquery.validate.js"></script>
<script type="text/javascript" src="/script/register.js"></script>';

if ($validated)
{
	$headContent .= "<meta http-equiv='Refresh' content='3; URL='registersuccess.php'>";
}
	
echo buildHead("Registration",$headContent);
?>
<body>
<?php
include "helpers/header.php";
?>

<?php
if ($validated)
{
	?>  Registration Successful! You will be redirected to <a href="registersuccess.php">here</a><?php
}
else
{
	?>
<div class="section">
	<h2 class="first">Registration</h2>
	<form action="register.php" id="registration" method="post" onsubmit="return btnSubmitClick()">
		<fieldset>
			<legend>Name</legend>
			<p>If you do not wish to provide your name, you may use an alias. This name is publicly visible in the CSThub forums; to CSThub members and visitors alike.</p>
			<label for="fname" title="First name">First Name</label><input type="text" name="firstName" id="fname" value="<?php echo $firstName; ?>" />
			<label for="lname" title="Last name">Last Name</label><input type="text" name="lastName" id="lname" value="<?php echo $lastName; ?>" />

		</fieldset>
	
		<fieldset>
			<legend>Student ID</legend>
			<p>You <strong>must</strong> use your own BCIT student ID. Using another ID is against our <a href="#terms">terms of service</a>.</p>
			<label for="studentID" title="Student ID">BCIT ID</label><input type="text" name="studentID" id="studentID" value="<?php echo $studentID; ?>" />
			<?php 
			if ($studentIDExist)
			{
				?>  <label for="studentID" class="error">Student ID: <?php echo $studentID; ?> already registered. If the ID belongs to you, please see the FAQ page, or contact us. </label><?php
			}?>
		</fieldset>
	
		<fieldset>
			<legend>Email Address</legend>
			<p>We need an email address to validate your account. We will not share it with others. Other members of CSThub will not see this email address unless you explicitly allow them to.</p>
			<label for="email" title="Email address">Email</label><input type="text" name="email" id="email" value="<?php echo $email; ?>" />
			<label for="emailConfirm" title="Confirm email address">Confirm</label><input type="text" name="emailConfirm" id="emailConfirm" value="<?php echo $emailConfirm; ?>" />
		</fieldset>
	
		<fieldset>
			<legend>Password</legend>
			<p>Do <strong>not</strong> use one of your BCIT passwords. Use a password unique to CSThub.</p>
			<label for="passwordRegister">Password</label><input type="password" name="password" id="passwordRegister" />
			<label for="passwordConfirm" title="Confirm password">Confirm</label><input type="password" name="passwordConfirm" id="passwordConfirm" />
			<input type="hidden" id="hPasswordConfirm" />
			<input type="hidden" id="hPasswordRegister" />
		</fieldset>

		
		<fieldset id="terms">
			<legend>Terms of Service</legend>
			<p>
			You must read and agree with our terms of service to use this site.
			CSThub is not liable for any damages of leaked password or lost data (including, but not limited to homework, eaten by your dog.)
			
			These are our terms and conditions be sure to remeber them well peons. All your base belong to us. These are our terms and conditions be sure to remeber them well peons. All your base belong to us. 
			</p>
			<label for="agree">I agree with these terms.</label><input id="agree" type="checkbox" title="You must agree to our terms." name="agree" value="terms" />
		</fieldset>

		<fieldset>
			<input type="submit" id="submit" name="submit" value="Join!" />
		</fieldset>
	</form>
</div><!-- section -->

<?php
	if (isset($_POST["submit"]) && !$validated)
	{
		?> <script type="text/javascript">
				$("#registration").validate();
		   </script><?php
	}
}
?>

<script type="text/javascript" src="script/sha1.js"></script>

<script type="text/javascript">
	function btnSubmitClick()
	{
		var txtPassword = document.getElementById("passwordRegister");
		var hdnPassword = document.getElementById("hPasswordRegister");
		
		hdnPassword.value = Sha1.hash(txtPassword.value);
		hdnPassword.setAttribute("name","hPassword");
		txtPassword.removeAttribute("name");	
		
		var txtPassword = document.getElementById("passwordConfirm");
		var hdnPassword = document.getElementById("hPasswordConfirm");
		
		hdnPassword.value = Sha1.hash(txtPassword.value);
		hdnPassword.setAttribute("name","hPasswordConfirm");
		txtPassword.removeAttribute("name");
		
		return true;
	}
</script>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>
