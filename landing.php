<?php
include 'helpers/auth.php';
include "templates/head.php";
include "helpers/embededLogin.php";

?>

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