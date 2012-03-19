<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

$topicID = $_GET['topicID'];

$dbPosts = getPosts($_GET['topicID']);
$posts = array();
$userPosts = array();

// DD MM YYYY HH:MM
$dateFormat = "d/m/Y - g:ia";
foreach ($dbPosts as $dbPost)
{

	//$postID = $dbPost["postID"];
	$name = getNamesByAccountID($dbPost["accountID"]);
	
	if ($name)
	{
		$name = implode(' ', $name);
	}
	
	if (!isset($userPosts[$dbPost["accountID"]]))
	{
		$userPosts[$dbPost["accountID"]] = getUserPosts($dbPost["accountID"]);
	}
	
	//$topicID = $dbPost["topicID"];
	$content = $dbPost["content"];
	$createdDate = date($dateFormat, $dbPost["createdDate"]);

	$modifiedDate = "";
	if ($dbPost["modifiedDate"]) {
		$modifiedDate = date($dateFormat, $dbPost["modifiedDate"]);
	}
	$posts[] = array ("userName" => $name, "postDateCreated" => $createdDate, 
						"userPostCount" => $userPosts[$dbPost["accountID"]], "postDateEdited" => $modifiedDate,
						"postContent" => $content);
}

$topicInfo = getTopicInfo($_GET['topicID']);
$forumInfo = getForumInfo($topicInfo['forumID']);


$crumbs = array(array("href" => "forums.php", "name" => "Forums"),
				array("href" => "topics.php?forumID=" . $topicInfo["forumID"], "name" => $forumInfo["forumTitle"]),
				array("href" => "thread.php?topicID=" . $_GET["topicID"], "name" => $topicInfo["title"]));

$headContent = "<link rel='stylesheet' type='text/css' href='css/post.css' />";
echo buildHead("View Topic",$headContent);
?>
<body>
<?php
include "helpers/header.php";
?>

<p class="reply"><a href="/createPost.php?topicID=<?=$topicID?>">Reply</a></p>

<ol id="posts">
	<?php
	$i = 1;
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

<p class="reply"><a href="/createPost.php?topicID=<?=$topicID?>">Reply</a></p>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>