<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

$dbForums = getForums();
$forums = array();

foreach ($dbForums as $dbForum)
{
	$title = $dbForum["forumTitle"];
	$subTopicCount = getTopicCount($dbForum["forumID"]);
	$postCount = getPostCount($dbForum["forumID"]);
	$topicURL = "/topics.php?forumID=" . $dbForum["forumID"];
	$forums[] = array("title" => $title, "subTopicCount" => $subTopicCount,
						"postCount" => $postCount, "topicURL" => $topicURL);
}

$crumbs = array(array("href" => "forums.php", "name" => "Forums"));

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