<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

$headContent = "<link rel='stylesheet' type='text/css' href='/css/login.css' />";
	
if (isset($_GET["referer"]))
{
	$dest = $_GET["referer"];
}
else
{
	$dest = "/landing.php";
}
	
if ($GLOBALS['loggedIn'])
{
	$headContent = "<meta http-equiv='Refresh' content='3; URL=" . $dest . "'>";
	header('Location: ' . $dest);
}

echo buildHead("Login",$headContent);
?>
<body>
<?php include "helpers/header.php"; ?>

<?php
if ($GLOBALS['loggedIn'])
{
	?>
	<span>Login successful, redirecting in 3 seconds. Or click 
	<a class='classicLink' href='<?php echo $dest; ?>'>here</a></span>";
	<?php
}
else
{
	?>
	<div class="section">
		<h2>Log In</h2>
		<form id="loginInPage" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
			
			
			<fieldset>
				<legend><!-- something semantic should go here? then hide with css? --jake --></legend>
			
				<label for="username">Username</label>
				<input name="username" id="username" type="text"/>
			
				<label for="password">Password</label>
				<input id="password" name="password" type="password" />
			</fieldset>
			
				<input type="submit" onclick="btnSubmitClick()" value="Login" />
			
			<input type="hidden" id="hiddenPassword" />
			<?php echo $GLOBALS['message']; ?>
			
		</form>
		<p>
			<a href="/register.php">Register</a> / 
			<a href="/forgotpassword.php">Forgot Password</a>
		</p>
	</div>
<?php
}
?>

<script type="text/javascript" src="script/sha1.js"></script>

<script type="text/javascript">
	function btnSubmitClick()
	{
		var txtPassword = document.getElementById("password");
		var hdnPassword = document.getElementById("hiddenPassword");
		
		hdnPassword.value = Sha1.hash(txtPassword.value);
		hdnPassword.setAttribute("name","hPassword");
		txtPassword.removeAttribute("name");
	
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
