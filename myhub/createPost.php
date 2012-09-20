<?php
include "helpers/auth.php";
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "errors/notloggedin.php";
	die();
}

$topicID = $_GET['topicID'];

$topicInfo = Topics::Info($topicID);
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
$crumbs[] = array("href" => "thread.php?topicID=" . $topicID, "name" => $topicInfo["title"]);
$curmbs[] = array("href" => "/myhub/createPost.php?topicID=" . $topicID, "name" => "New Reply");
				
if (isset($_POST['postContent']))
{
	Posts::Create($topicID, $_POST['postContent']);
	header("Location: /thread.php?topicID=$topicID&page=-1");
}

$headContent = "<link rel='stylesheet' type='text/css' href='css/forums.css' />";
echo buildHead("Create Post",$headContent);
?>
<body>
<?php include "helpers/header.php"; ?>

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