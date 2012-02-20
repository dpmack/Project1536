<?php
include 'helpers/auth.php';
include "templates/head.php";
include "helpers/embededLogin.php";

// to create example data before db is set up
$topcis = array();
$topcis[0] = array();
$topcis[0]["title"] = "Thread about how awesome CST is";
$topcis[0]["posts"] = "16";

$topics[1] = array();
$topics[1]["title"] = "Thread about student get together lan party at lunch";
$topics[1]["posts"] = "67";

$topics[2] = array();
$topics[2]["title"] = "Various other thread";
$topics[2]["posts"] = "145";

$topics[3] = array();
$topics[3]["title"] = "David is awesome thread";
$topics[3]["posts"] = "42";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
$headContent = "<link rel='stylesheet' type='text/css' href='css/forums.css' />";
echo buildHead("Topics",$headContent);
?>
<body>
<?php
include "templates/header.php";
?>

<h2 class="first">Topics in Example Forum</h2>
<br />
<button type="button">Post New Topic</button>
<br />

<div class='topicContainer'>
<?php

foreach($topics as $topic)
{
	echo "<div id='' class='topic'><span>" . $topic["title"] . "</span>";
	echo "<span>Posts: " . $topic["posts"] . "</span>";
	echo "<a href='viewtopic.php'>View Topic</a></div>";
}
?>
</div>

<?php include "templates/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "templates/sqlDebug.php";
}
?>
</body>	
</html>