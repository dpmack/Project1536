<?php
include 'helpers/auth.php';
include "helpers/head.php";

if (isset($_GET["forumID"]))
{
	$dbForums = Forums::ForumsOF($_GET["forumID"]);
	$forumID = $_GET["forumID"];
}
else
{
	$dbForums = Forums::AllTopLevel();
	$forumID = null;
}

$forums = array();
foreach ($dbForums as $dbForum)
{
	$title = $dbForum["forumTitle"];
	$subTopicCount = 0;//Topics::CountInForum($dbForum["forumID"]);
	$postCount = 0;//Posts::CountInForum($dbForum["forumID"]);
	if ($dbForum["hasSubForum"])
	{
		$topicURL = "/forums.php?forumID=" . $dbForum["forumID"];
	}
	else
	{
		$topicURL = "/topics.php?forumID=" . $dbForum["forumID"];
	}
	$forums[] = array("title" => $title, "subTopicCount" => $subTopicCount,
						"postCount" => $postCount, "topicURL" => $topicURL);
}

$crumbs = array(array("href" => "forums.php", "name" => "Forums"));

if ($forumID)
{
	$iForum = Forums::Info($forumID);
	$lastCrumb = array("href" => "forums.php?forumID=$forumID", "name" => $iForum["forumTitle"]);
	
	while ($iForum["parentForumID"] != null)
	{
		$lastID = $iForum["parentForumID"];
		$iForum = Forums::Info($lastID);
		$crumbs[] = array("href" => "forums.php?forumID=" . $lastID, "name" => $iForum["forumTitle"]);
	}
	$crumbs[] = $lastCrumb;
}

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