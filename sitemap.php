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

<b>Non logged In content</b>

<a href="index.php">Homepage</a>
<a href="login.php">Login Page</a>
<a href="faq.php">FAQ</a>
<a href="forums.php">Forums</a>
<a href="topics.php">Topics</a>
<a href="viewtopic.php">View Topic</a>

<b>Logged In content</b>

<a href="landing.php">Temporary Landing page</a>
<a href="homework.php">Homework</a>
<a href="schedule.php">Schedule</a>

<b>Logged In super user content (Note these are only displayed for marker convenace)</b>

<a href=""></a>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>