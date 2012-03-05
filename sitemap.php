<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";
?>

<?php
$headContent = "";
echo buildHead("Sitemap",$headContent);
?>
<body>
<?php include "helpers/header.php"; ?>
<br />
<br />
<p>
	<b>Non logged In content</b>
</p>
<p>
	<a href="index.php">Homepage</a><br />
	<a href="login.php">Login Page</a><br />
	<a href="faq.php">FAQ</a><br />
	<a href="forums.php">Forums</a><br />
	<a href="topics.php">Topics</a><br />
	<a href="viewtopic.php">View Topic</a><br />
</p>
<p>
	<b>Logged In content</b>
</p>
<p>
	<a href="landing.php">Temporary Landing page</a><br />
	<a href="homework.php">Homework</a><br />
	<a href="schedule.php">Schedule</a><br />
</p>
<p>
	<b>Logged In super user content (Note these are only displayed for marker convenace)</b>
</p>
<p>
	<a href="admin.php">General Admin</a><br />
	<a href="addHomework.php">Add Homework</a><br />
</p>
<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>