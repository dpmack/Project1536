<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "error/notloggedin.php";
	die();
}

if (isset($_POST["title"]))
{
	createWhiteboard($_POST["title"]);
}

$whiteboards = getMyWhiteboards();
?>

<?php
$headContent = ""; //if needing to add extra css files
echo buildHead("Whiteboards",$headContent);
?>
<body>
<?php include "helpers/header.php"; ?>

<h2>My whiteboards</h2>
<table border="1">
	<tr>
		<th>Title</th>
		<th>View</th>
		<th>Owner</th>
	</tr>
	
	<?php
		foreach ($whiteboards as $whiteboard)
		{
			echo "<tr><td>" . $whiteboard["title"] . "</td>";
			echo "<td><a href='whiteboard.php?whiteboardID=" . $whiteboard["whiteboardID"] . "'>View whiteboard</a></td>";
			echo "<td>" . $whiteboard["authorName"] . "</td></tr>";
		}
		
		if ($whiteboards == array())
		{
			echo "<tr><td colspan='3'>You are not part of any whiteboards</td></tr>";
		}
	?>
</table>

<h2>Create whiteboard</h2>
<form action="whiteboards.php" method="post">
	<label for="title">Title</label>
	<input type="text" name="title" id="title" />
	<input type="submit" value="Create" />
</form>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>