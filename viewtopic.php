<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

$topicTitle = "Thread about how awesome CST is";

$posts = array();
$posts[0] = array();
$posts[0]["postDateCreated"] = "Yesterday 12:04pm";
$posts[0]["userName"] = "David";
$posts[0]["userPostCount"] = "16";
$posts[0]["postContent"] = "Man this forum is epic!";

$posts[1] = array();
$posts[1]["postDateCreated"] = "Yesterday 12:14pm";
$posts[1]["userName"] = "Kevin";
$posts[1]["userPostCount"] = "5";
$posts[1]["postContent"] = "I know right";

$posts[2] = array();
$posts[2]["postDateCreated"] = "Yesterday 12:24pm";
$posts[2]["userName"] = "Troy";
$posts[2]["userPostCount"] = "2";
$posts[2]["postContent"] = "UR all NOOBS";

$posts[3] = array();
$posts[3]["postDateCreated"] = "Yesterday 12:34pm";
$posts[3]["userName"] = "David";
$posts[3]["userPostCount"] = "16";
$posts[3]["postContent"] = "Thanks for that troy";

$posts[4] = array();
$posts[4]["postDateCreated"] = "Yesterday 12:44pm";
$posts[4]["userName"] = "Kevin";
$posts[4]["userPostCount"] = "5";
$posts[4]["postContent"] = "ya well its cause u touch ... nvm";

$posts[5] = array();
$posts[5]["postDateCreated"] = "Yesterday 12:54pm";
$posts[5]["userName"] = "Jake";
$posts[5]["userPostCount"] = "56";
$posts[5]["postContent"] = "Thats enough from both of you. Topic closed";
?>

<?php
$headContent = "<link rel='stylesheet' type='text/css' href='css/forums.css' />";
echo buildHead("View Topic",$headContent);
?>
<body>
<?php
include "helpers/header.php";
?>

<h2>Viewing Topic - <?php echo $topicTitle; ?></h2>

<a href="/createPost.php">Reply</a>

<div class="postContainer">
<?php
$i = 1;
foreach($posts as $post)
{
	$postNumber = $i;
	
	extract($post);
	include "templates/post.template.php";
	
	$i += 1;
}
?>
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