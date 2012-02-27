<?php
include 'helpers/auth.php';
include "helpers/head.php";
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

<?php
include "helpers/header.php";
?>

Temporay Landing page
<br />
<a class="classicLink" href="homework.php">Homework checklist</a><br />
<a class="classicLink" href="schedule.php">My Schedule</a><br />

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>