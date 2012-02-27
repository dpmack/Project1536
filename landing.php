<?php
include 'helpers/auth.php';
include "templates/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"])
{
	include "error/notloggedin.php";
	die();
}
?>

<?php
$headContent = '';
echo buildHead("Landing page",$headContent);
?>
<body>

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