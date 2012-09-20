<?php
include 'helpers/auth.php';
include "helpers/head.php";

$TOPIC_PAGES_TO_SHOW = 3;

$forumID = filter_input(INPUT_GET,"forumID", FILTER_VALIDATE_INT);
$show = filter_input(INPUT_GET,"page", FILTER_VALIDATE_INT);

$topicCount = Topics::CountInForum($forumID);
$numPages = floor(($topicCount - 1)/$MAX_TOPICS_PER_PAGE) + 1;

if ($show == -1)
{
	$show = $numPages;
}

if ($show === null)
{
	$show = 1;
}
$currentPage = $show;
$show = ($show - 1) * $MAX_TOPICS_PER_PAGE;

$dbTopics = Topics::InForum($forumID, $show, $MAX_TOPICS_PER_PAGE);
$topics = array();

foreach ($dbTopics as $dbTopic)
{
	$title = $dbTopic["title"];
	$postCount = Topics::CountPosts($dbTopic["topicID"]);
	$topicURL = "/thread.php?topicID=".$dbTopic["topicID"];
	$topics[] = array ("title" => $title, "postCount" => $postCount,
					"topicURL" => $topicURL);
}

$forumInfo = Forums::Info($_GET['forumID']);

$crumbs = array(array("href" => "forums.php", "name" => "Forums"));

$iForum = Forums::Info($forumID);
while ($iForum["parentForumID"] != null)
{
	$lastID = $iForum["parentForumID"];
	$iForum = Forums::Info($lastID);
	$crumbs[] = array("href" => "forums.php?forumID=" . $lastID, "name" => $iForum["forumTitle"]);
}
$crumbs[] = array("href" => "topics.php?forumID=" . $_GET["forumID"], "name" => $forumInfo["forumTitle"]);

$headContent = "<link rel='stylesheet' type='text/css' href='css/topicsListing.css' />";
echo buildHead("Topics",$headContent);
?>
<body>
<?php
include "helpers/header.php";
$type = "Topics";

function drawTopicPages($forumID, $numPages, $currentPage, $topicsToShow)
{ ?>
<ul class="pages">
	<? if ($numPages > 1): ?>
		<li>Page <?=$currentPage?> of <?=$numPages?></li>
		<? if ($currentPage > 1): ?>
			<li><a href="/topics.php?forumID=<?=$forumID?>&page=1">First</a></li>
			<li><a href="/topics.php?forumID=<?=$forumID?>&page=<?=$currentPage-1?>">&lt;</a></li>
		<? endif; ?>
		
		<? if ($currentPage > $topicsToShow + 1): ?>
			<li>...</li>
		<? endif; ?>
		
		<? for ($pageIndex = $currentPage - $topicsToShow; $pageIndex <= $currentPage + $topicsToShow; $pageIndex++): ?>
			<? if ($pageIndex >= 1 && $pageIndex <= $numPages): ?>
				<li>
					<? if ($pageIndex == $currentPage): ?>
						<u>
					<? endif; ?>
					
					<a href="/topics.php?forumID=<?=$forumID?>&page=<?=$pageIndex?>"><?=$pageIndex?></a>
					
					<? if ($pageIndex == $currentPage): ?>
						</u>
					<? endif; ?>
				</li>
			<? endif; ?>
		<? endfor; ?>
		
		<? if ($currentPage < $numPages - $topicsToShow): ?>
			<li>...</li>
		<? endif; ?>
		
		<? if ($currentPage < $numPages): ?>
			<li><a href="/topics.php?forumID=<?=$forumID?>&page=<?=$currentPage+1?>">&gt;</a></li>
			<li><a href="/topics.php?forumID=<?=$forumID?>&page=-1">Last</a></li>
		<? endif; ?>
	<? endif; ?>
	<li class="newTopic"><a href="/myhub/createTopic.php?forumID=<?=$forumID?>">Start New Topic</a></li>
</ul><?
}

include "templates/topicGroup.template.php";
include "helpers/footer.php";

if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>