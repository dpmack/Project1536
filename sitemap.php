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
<p>
	<b>Non logged In content</b>
</p>
<a href="index.php">Homepage</a><br />
<a href="login.php">Login Page</a><br />
<a href="faq.php">FAQ</a><br />
<a href="forums.php">Forums</a><br />
<a href="topics.php">Topics</a><br />
<a href="viewtopic.php">View Topic</a><br />
<p>
	<b>Logged In content</b>
</p>
<a href="landing.php">Temporary Landing page</a><br />
<a href="homework.php">Homework</a><br />
<a href="schedule.php">Schedule</a><br />
<p>
	<b>Logged In super user content (Note these are only displayed for marker convenace)</b>
</p>
<a href="admin/admin.php">General Admin</a><br />
<a href="admin/addHomework.php">Add Homework</a><br />

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>