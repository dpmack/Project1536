<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

?>

<?php
$headContent = "<link rel='stylesheet' type='text/css' href='css/forums.css' />";
echo buildHead("Create Post",$headContent);
?>
<body>
<?php
include "helpers/header.php";
echo isset($_POST['postContent']) ? $_POST['postContent'] : "";
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