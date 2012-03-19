<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

$forumID = $_GET['forumID'];
$dbTopics = getTopics($_GET['forumID']);
$topics = array();

foreach ($dbTopics as $dbTopic)
{
	$title = $dbTopic["title"];
	$postCount = getPostCountFromTopic($dbTopic["topicID"]);
	$topicURL = "/thread.php?topicID=".$dbTopic["topicID"];
	$topics[] = array ("title" => $title, "postCount" => $postCount,
					"topicURL" => $topicURL);
}

$forumInfo = getForumInfo($_GET['forumID']);

$crumbs = array(array("href" => "forums.php", "name" => "Forums"),
				array("href" => "topics.php?forumID=" . $_GET["forumID"], "name" => $forumInfo["forumTitle"]));

$headContent = "<link rel='stylesheet' type='text/css' href='css/topicsListing.css' />";
echo buildHead("Topics",$headContent);
?>
<body>
<?php
include "helpers/header.php";
$type = "Topics";
include "templates/topicGroup.template.php";
include "helpers/footer.php";

if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>