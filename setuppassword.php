<?php
include 'helpers/auth.php';
include "helpers/head.php";

$go = "";

if (isset($_GET["id"]))
{
	$confirmID = $_GET["id"];
	
	$accountID = getAccountForEmailConfirm($confirmID);
	if ($accountID != -1)
	{
		confirmAccount($accountID);
	}
	else
	{
		//header("Location: index.php");
		$go = "index.php";
	}
}
else
{
	header("Location: index.php");
	$go = "index.php";
}
?>

<?php
$headContent = "";

if ($go)
{
	$headContent .= "<meta http-equiv='Refresh' content='3; URL=\"" . $go . "\"'>";
}

echo buildHead("Setup Password",$headContent);
?>
<body>
<?php include "helpers/header.php"; ?>

<?php

if ($go)
{
	?>  You will be redirected to <a href="<?php echo $go; ?>">here</a><?php
}
else
{
	?> Your account has been successfully verified.
	Please login at the <a href="login.php">login page.</a>

<?php
}
?>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>