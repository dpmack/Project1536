<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

$dbPosts = getPosts($_GET['topicID']);
$posts = array();

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
	
	//$topicID = $dbPost["topicID"];
	$content = $dbPost["content"];
	$createdDate = date($dateFormat, $dbPost["createdDate"]);

	$modifiedDate = "";
	if ($dbPost["modifiedDate"]) {
		$modifiedDate = date($dateFormat, $dbPost["modifiedDate"]);
	}
	$posts[] = array ("userName" => $name, "postDateCreated" => $createdDate, 
						"userPostCount" => 16, "postDateEdited" => $modifiedDate,
						"postContent" => $content);
}

$topicTitle = "Thread about how awesome CST is";


$headContent = "<link rel='stylesheet' type='text/css' href='css/post.css' />";
echo buildHead("View Topic",$headContent);
?>
<body>
<?php
include "helpers/header.php";
?>
<div class="section">
	<h2>Viewing Topic - <?php echo $topicTitle; ?></h2>
</div>

<p class="reply"><a href="/createPost.php">Reply</a></p>

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

<p class="reply"><a href="/createPost.php">Reply</a></p>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>