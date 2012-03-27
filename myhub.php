<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"])
{
	include "error/notloggedin.php";
	die();
}

$crumbs = array(array("href" => "myhub.php", "name" => "MYHub"));
				
$headContent = '';
echo buildHead("My Hub",$headContent);
?>
<body>

<?php
include "helpers/header.php";
?>

<div class="groupableSections">
	<div class="section">
	<br />
	<a class="classicLink" href="homework.php">Homework checklist</a><br />
	<a class="classicLink" href="schedule.php">My Schedule</a><br />
	<a class="classicLink" href="forums.php">Forums</a><br />
	<a class="classicLink" href="changepassword.php">Change your password</a><br />
	<a class="classicLink" href="manageCourses.php">Manage your courses</a><br />
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