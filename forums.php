<?php
include 'helpers/auth.php';
include "templates/head.php";
include "helpers/embededLogin.php";

// to create example data before db is set up
$forums = array();
$forums[0] = array();
$forums[0]["title"] = "News";
$forums[0]["topics"] = "12";
$forums[0]["posts"] = "16";

$forums[1] = array();
$forums[1]["title"] = "Homework";
$forums[1]["topics"] = "32";
$forums[1]["posts"] = "67";

$forums[2] = array();
$forums[2]["title"] = "Courses";
$forums[2]["topics"] = "10";
$forums[2]["posts"] = "145";

$forums[3] = array();
$forums[3]["title"] = "Offtopic";
$forums[3]["topics"] = "4";
$forums[3]["posts"] = "42";
?>

<?php
$headContent = "<link rel='stylesheet' type='text/css' href='css/forums.css' />";
echo buildHead("Forums",$headContent);
?>
<body>
<?php
include "templates/header.php";
?>

<h2 class="first">Forums</h2>
<?php

foreach($forums as $forum)
{
	echo "<div class='forum'><span>" . $forum["title"] . "</span>";
	echo "<span>Topics: " . $forum["topics"] . "</span><span>Posts: " . $forum["posts"] . "</span>";
	echo "<a href='topics.php'>View Forum</a></div>";
}

?>

<?php include "templates/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "templates/sqlDebug.php";
}
?>
</body>	
</html>