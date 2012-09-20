<?php
include 'helpers/auth.php';
include "helpers/head.php";

$POST_PAGES_TO_SHOW = 2;

$topicID = filter_input(INPUT_GET,"topicID", FILTER_VALIDATE_INT);
$show = filter_input(INPUT_GET,"page", FILTER_VALIDATE_INT);

$postCount = Topics::CountPosts($topicID);
$numPages = floor(($postCount - 1)/$MAX_POSTS_PER_PAGE) + 1;

if ($show == -1)
{
	$show = $numPages;
}

if ($show === null)
{
	$show = 1;
}
$currentPage = $show;
$show = ($show - 1) * $MAX_POSTS_PER_PAGE;

$dbPosts = Posts::InTopic($topicID, $show, $MAX_POSTS_PER_PAGE);
$posts = array();
$userPosts = array();
$userNames = array();

// DD MM YYYY HH:MM
$dateFormat = "d/m/Y - g:ia";
foreach ($dbPosts as $dbPost)
{

	$postID = $dbPost["postID"];
	
	if (!isset($userNames[$dbPost["accountID"]]))
	{
		$userNames[$dbPost["accountID"]] = implode(" ", Accounts::UsersName($dbPost["accountID"]));
	}
	$name = $userNames[$dbPost["accountID"]];
	
	if (!isset($userPosts[$dbPost["accountID"]]))
	{
		$userPosts[$dbPost["accountID"]] = Posts::FromAccount($dbPost["accountID"]);
	}
	
	$topicID = $dbPost["topicID"];
	$content = $dbPost["content"];
	$createdDate = date($dateFormat, $dbPost["createdDate"]);

	$modifiedDate = "";
	if ($dbPost["modifiedDate"]) {
		$modifiedDate = date($dateFormat, $dbPost["modifiedDate"]);
	}
	$posts[] = array ("userName" => $name, "postDateCreated" => $createdDate, 
						"userPostCount" => $userPosts[$dbPost["accountID"]], "postDateEdited" => $modifiedDate,
						"postContent" => $content, "postID" => $postID, "topicID" => $topicID);
}

$topicInfo = Topics::Info($_GET['topicID']);
$iForum = Forums::Info($topicInfo['forumID']);

$crumbs = array(array("href" => "forums.php", "name" => "Forums"));
$secondLastCrumb = array("href" => "topics.php?forumID=" . $topicInfo["forumID"], "name" => $iForum["forumTitle"]);

while ($iForum["parentForumID"] != null)
{
	$lastID = $iForum["parentForumID"];
	$iForum = Forums::Info($lastID);
	$crumbs[] = array("href" => "forums.php?forumID=" . $lastID, "name" => $iForum["forumTitle"]);
}
$crumbs[] = $secondLastCrumb;
$crumbs[] = array("href" => "thread.php?topicID=" . $_GET["topicID"], "name" => $topicInfo["title"]);

$headContent = "<link rel='stylesheet' type='text/css' href='css/post.css' />";
echo buildHead("View Topic",$headContent);
?>
<body>
<?php
include "helpers/header.php";

function drawPageNumbers($topicID, $currentPage, $numPages, $numToShow)
{ ?>
<ul class="pages">
	<? if ($numPages > 1): ?>
		<li>Page <?=$currentPage?> of <?=$numPages?></li>
		<? if ($currentPage > 1): ?>
			<li><a href="/thread.php?topicID=<?=$topicID?>&page=1">First</a></li>
			<li><a href="/thread.php?topicID=<?=$topicID?>&page=<?=$currentPage-1?>">&lt;</a></li>
		<? endif; ?>
		
		<? if ($currentPage > $numToShow + 1): ?>
			<li>...</li>
		<? endif; ?>
		
		<? for ($pageIndex = $currentPage - $numToShow; $pageIndex <= $currentPage + $numToShow; $pageIndex++): ?>
			<? if ($pageIndex >= 1 && $pageIndex <= $numPages): ?>
				<li>
					<? if ($pageIndex == $currentPage): ?>
						<u>
					<? endif; ?>
					
					<a href="/thread.php?topicID=<?=$topicID?>&page=<?=$pageIndex?>"><?=$pageIndex?></a>
					
					<? if ($pageIndex == $currentPage): ?>
						</u>
					<? endif; ?>
				</li>
			<? endif; ?>
		<? endfor; ?>
		
		<? if ($currentPage < $numPages - $numToShow): ?>
			<li>...</li>
		<? endif; ?>
		
		<? if ($currentPage < $numPages): ?>
			<li><a href="/thread.php?topicID=<?=$topicID?>&page=<?=$currentPage+1?>">&gt;</a></li>
			<li><a href="/thread.php?topicID=<?=$topicID?>&page=<?=$numPages?>">Last</a></li>
		<? endif; ?>
	<? endif; ?>
	<li class="replyItem"><a class="reply" href="/myhub/createPost.php?topicID=<?=$topicID?>">Reply</a></li>
</ul><?
}

drawPageNumbers($topicID, $currentPage, $numPages, $POST_PAGES_TO_SHOW);
?>

<ol id="posts">
	<?php
	$i = $show + 1;
	foreach($posts as $post)
	{
		$postNumber = $i;
		
		extract($post);
		echo '<li>';
		include "templates/post.template.php";
		echo '</li>';
		
		$i += 1;
	}
	?>
</ol>

<? drawPageNumbers($topicID, $currentPage, $numPages, $POST_PAGES_TO_SHOW); ?>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>