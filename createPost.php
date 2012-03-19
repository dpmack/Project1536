<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "error/notloggedin.php";
	die();
}

$topicID = $_GET['topicID'];

$topicInfo = getTopicInfo($topicID);
$forumInfo = getForumInfo($topicInfo['forumID']);


$crumbs = array(array("href" => "forums.php", "name" => "Forums"),
				array("href" => "topics.php?forumID=" . $topicInfo["forumID"], "name" => $forumInfo["forumTitle"]),
				array("href" => "thread.php?topicID=" . $topicID, "name" => $topicInfo["title"]),
				array("href" => "createPost.php?topicID=" . $topicID, "name" => "New Reply"));
				
if (isset($_POST['postContent']))
{
	createPost($topicID, $_POST['postContent']);
	header("Location: thread.php?topicID=$topicID");
}
?>

<?php
$headContent = "<link rel='stylesheet' type='text/css' href='css/forums.css' />";
echo buildHead("Create Post",$headContent);
?>
<body>
<?php
include "helpers/header.php";
?>

<div class="section">
	<h2>Post</h2>
	<form id="createPost" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">	
		<textarea name="postContent" id="postContent"></textarea>		
		<input type="submit" value="Post" />		
	</form>
</div>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>