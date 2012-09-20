<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "errors/notloggedin.php";
	die();
}

$forumID = $_GET['forumID'];

$iForum = Forums::Info($forumID);

$crumbs = array(array("href" => "forums.php", "name" => "Forums"));
$secondLastCrumb = array("href" => "topics.php?forumID=" . $forumID, "name" => $iForum["forumTitle"]);

while ($iForum["parentForumID"] != null)
{
	$lastID = $iForum["parentForumID"];
	$iForum = Forums::Info($lastID);
	$crumbs[] = array("href" => "forums.php?forumID=" . $lastID, "name" => $iForum["forumTitle"]);
}
$crumbs[] = $secondLastCrumb;
$crumbs[] = array("href" => "/myhub/createTopic.php?forumID=$forumID", "name" => "New Topic");
				
if (isset($_POST['postContent']) && isset($_POST['title']))
{
	$topicID = Topics::Create($forumID, $_POST['title']);
	if ($topicID)
	{
		Posts::Create($topicID, $_POST['postContent']);
		header("Location: /thread.php?topicID=$topicID");
	}
	//header("Location: topics.php?forumID=$forumID");
}

$headContent = "<link rel='stylesheet' type='text/css' href='css/forums.css' />";
echo buildHead("Create Topic",$headContent);
?>
<body>
<?php include "helpers/header.php"; ?>

<div class="section">
	<h2>New Topic</h2>
	<form id="createPost" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
		Title <br />
		<input type="text" name="title" />
		<br />
		<br />
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