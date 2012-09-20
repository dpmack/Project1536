<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "errors/notloggedin.php";
	die();
}

if (!Permissions::Has("DELETE_REPLY"))
{
	include "errors/notauth.php";
	die();
}

$postID = filter_input(INPUT_GET,"postID", FILTER_VALIDATE_INT);
$topicID = filter_input(INPUT_GET,"topicID", FILTER_VALIDATE_INT);
	
if ($postID && $topicID)
{
	Posts::Delete($postID);
	header("Location: /thread.php?topicID=$topicID");
}
?>

<?php
$headContent = "<link rel='stylesheet' type='text/css' href='css/forums.css' />";
echo buildHead("Delete Post",$headContent);
?>
<body>
<?php
include "helpers/header.php";
?>

<div class="section">
	<h2>Post has been deleted</h2>
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