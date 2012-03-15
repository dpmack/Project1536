<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

// to create example data before db is set up
$forums = array();
$forums[0] = array();
$forums[0]["title"] = "News";
$forums[0]["subTopicCount"] = "12";
$forums[0]["postCount"] = "16";
$forums[0]["topicURL"] = "/topics.php";

$forums[1] = array();
$forums[1]["title"] = "Homework";
$forums[1]["subTopicCount"] = "32";
$forums[1]["postCount"] = "67";
$forums[1]["topicURL"] = "/topics.php";

$forums[2] = array();
$forums[2]["title"] = "Courses";
$forums[2]["subTopicCount"] = "10";
$forums[2]["postCount"] = "145";
$forums[2]["topicURL"] = "/topics.php";

$forums[3] = array();
$forums[3]["title"] = "Offtopic";
$forums[3]["subTopicCount"] = "4";
$forums[3]["postCount"] = "42";
$forums[3]["topicURL"] = "/topics.php";
?>

<?php
$headContent = "<link rel='stylesheet' type='text/css' href='css/forumListing.css' />";
echo buildHead("Forums",$headContent);
?>
<body>
<?php
include "helpers/header.php";
$topics = $forums;
$type = "Forums";
include "templates/topicGroup.template.php";
include "helpers/footer.php";


if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>