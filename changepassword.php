<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "error/notloggedin.php";
	die();
}

if (isset($_POST["hcPassword"]))
{
	$curPassword = $_POST["hcPassword"];
}
else if (isset($_POST["curPassword"]))
{
	$curPassword = sha1($_POST["curPassword"]);
}
else
{
	$curPassword = false;
}

if (isset($_POST["hPassword"]))
{
	$newPassword = $_POST["hPassword"];
}
else if (isset($_POST["newPassword"]) && strlen($_POST["newPassword"]) >= MIN_PASSWORD_LENGTH)  
{
	$newPassword = sha1($_POST["newPassword"]);
}
else
{
	$newPassword = false;
} 

if (isset($_POST["confirmPassword"])) 
{
	$confirmPassword = sha1($_POST["confirmPassword"]);
}
else
{
	$confirmPassword = false;
}

$successfulChange = false;

if ($curPassword !== false && checkPassword($GLOBALS["accountID"], $curPassword))
{	
	if (($confirmPassword !== false && $confirmPassword === $newPassword) ||
		($confirmPassword === false && $newPassword !== false))
	{
		changePassword($GLOBALS["accountID"], $newPassword);
		header("Location: myhub.php");
		$successfulChange = true;
	}
}

?>

<?php
$headContent = '<link rel="stylesheet" type="text/css" href="/css/" />
<script type="text/javascript" src="/script/jquery.validate.js"></script>
<script type="text/javascript" src="/script/changepassword.js"></script>
<script type="text/javascript" src="script/sha1.js"></script>';
if ($successfulChange)
{
	$headContent .= "<meta http-equiv='Refresh' content='3; URL='myhub.php'>";
}

echo buildHead("Change your password",$headContent);
?>
<body>
<?php include "helpers/header.php"; ?>

<div class="groupableSections">
	<div class="section">
	<h2>Change your password</h2>
	
	<?php if ($successfulChange): ?>
		<p id="success">Password successfully changed. You will be directed to your <a href="myhub.php">myHub</a> in 3 seconds...</p>
	<?php else: ?>
		<?php if (isset($_POST["curPassword"]) || isset($_POST["hcPassword"])): ?>
			<p class="error">Password Invalid</p>
		<?php endif; ?>
		<form action="changepassword.php" method="post" id="changePassword">

			<fieldset>
				<legend>Change Password</legend>
				<label for="curPassword">Current password</label> <input type="password" name="curPassword" id="curPassword"/>
				<label for="newPassword">New password</label> <input type="password" name="newPassword" id="newPassword" />
				<label for="confirmPassword">Confirm password</label> <input type="password" name="confirmPassword" id="confirmPassword" />
			</fieldset>
			<input type="submit" value="Change it!" id="changeItButton" />
			<input type="hidden" id="hPassword" />
			<input type="hidden" id="hcPassword" />
			
		</form>
	<?php endif; ?>
	
</div></div>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>