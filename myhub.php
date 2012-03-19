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
echo buildHead("My Hub",$headContent);
?>
<body>

<?php
include "helpers/header.php";
?>

<div class="groupableSections">
	<div class="section">
	<h2>My Hub</h2>
	<br />
	<a class="classicLink" href="homework.php">Homework checklist</a><br />
	<a class="classicLink" href="schedule.php">My Schedule</a><br />
	<a class="classicLink" href="forums.php">Forums</a><br />
	</div>
</div>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>