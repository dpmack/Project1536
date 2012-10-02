<?php
include "helpers/auth.php";
include "helpers/head.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "errors/notloggedin.php";
	die();
}

if (isset($_POST["title"]))
{
	Whiteboards::Create($_POST["title"]);
}

$whiteboards = Whiteboards::Mine();

$crumbs = array(array("href" => "index.php", "name" => "MYHub"),
				array("href" => "whiteboards.php", "name" => "Whiteboards"));

echo buildHead("Whiteboards");
?>
<body>
<?php include "helpers/header.php"; ?>

<br />

<h2>My whiteboards</h2>
<table id="whiteboards">
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

<br />
<br />

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