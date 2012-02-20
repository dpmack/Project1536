<?php
include 'helpers/auth.php';
include "templates/head.php";
include "helpers/embededLogin.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
$headContent = '';
if (!$GLOBALS['loggedIn'])
{
	$headContent .= '<meta http-equiv="Refresh" content="0; URL=login.php" />';
}

echo buildHead("Landing page",$headContent);
?>
<body>
<?php
include "templates/header.php";

if (!$GLOBALS['loggedIn'])
{	
	echo "To view this page you must be logged in";
	
	include "templates/footer.php";
	
	if ($GLOBALS['sql_debug'] != 0)
	{
		include "templates/sqlDebug.php";
	}
	echo "</body></html>";
	die();
}
?>

Temporay Landing page
<br />
<a class="classicLink" href="homework.php">Homework checklist</a><br />
<a class="classicLink" href="schedule.php">My Schedule</a><br />

<?php include "templates/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "templates/sqlDebug.php";
}
?>
</body>	
</html>