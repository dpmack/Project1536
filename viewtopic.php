<?php
include 'helpers/auth.php';
include "templates/head.php";
include "helpers/embededLogin.php";

$posts = array();
$posts[0] = array();
$posts[0]["title"] = "Thread about how awesome CST is";
$posts[0]["time"] = "Yesterday 12:04pm";
$posts[0]["username"] = "David";
$posts[0]["posts"] = "16";
$posts[0]["message"] = "Man this forum is epic!";

$posts[1] = array();
$posts[1]["title"] = "Thread about how awesome CST is";
$posts[1]["time"] = "Yesterday 12:14pm";
$posts[1]["username"] = "Kevin";
$posts[1]["posts"] = "5";
$posts[1]["message"] = "I know right";

$posts[2] = array();
$posts[2]["title"] = "Thread about how awesome CST is";
$posts[2]["time"] = "Yesterday 12:24pm";
$posts[2]["username"] = "Troy";
$posts[2]["posts"] = "2";
$posts[2]["message"] = "UR all NOOBS";

$posts[3] = array();
$posts[3]["title"] = "Thread about how awesome CST is";
$posts[3]["time"] = "Yesterday 12:34pm";
$posts[3]["username"] = "David";
$posts[3]["posts"] = "16";
$posts[3]["message"] = "Thanks for that troy";

$posts[4] = array();
$posts[4]["title"] = "Thread about how awesome CST is";
$posts[4]["time"] = "Yesterday 12:44pm";
$posts[4]["username"] = "Kevin";
$posts[4]["posts"] = "5";
$posts[4]["message"] = "ya well its cause u touch ... nvm";

$posts[5] = array();
$posts[5]["title"] = "Thread about how awesome CST is";
$posts[5]["time"] = "Yesterday 12:54pm";
$posts[5]["username"] = "Jake";
$posts[5]["posts"] = "56";
$posts[5]["message"] = "Thats enough from both of you. Topic closed";
?>

<?php
$headContent = "<link rel='stylesheet' type='text/css' href='css/forums.css' />";
echo buildHead("View Topic",$headContent);
?>
<body>
<?php
include "templates/header.php";
?>

<h2 class="first">Viewing Topic - <?php echo $posts[0]["title"]; ?></h2>
<br />
<button type="button">Reply</button>
<br />

<div class="postContainer">
<?php
$i = 1;
foreach($posts as $post)
{
	echo "<div class='post'><div class='time'>#" . $i . " " . $post["time"] .
	"</div><div class='userinfo'><span>" . $post["username"] . "</span><br />" . 
	"<span># of posts: " . $post["posts"] . "</span></div><div class='body'>" . 
	"<div class='content'>" .
	$post["message"] . "</div></div></div>";
	$i += 1;
}
?>
</div>

<?php include "templates/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "templates/sqlDebug.php";
}
?>
</body>	
</html>