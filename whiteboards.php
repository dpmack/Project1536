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
	$sql = "
INSERT INTO whiteboards (title, accountID)
VALUES ('" . mysql_real_escape_string($_POST["title"]) . "', " . $GLOBALS["accountID"] . ");

INSERT INTO whiteboardsaccountsmapping (whiteboardID, accountID, color)
VALUES (last_insert_id(), " . $GLOBALS["accountID"] . ", 'df4b26');

";
	sql_query($sql);
}

$sql = "SELECT whiteboards.whiteboardID as whiteboardID, title, (owner.firstName + ', ' + owner.lastName) as authorName FROM whiteboards
JOIN accounts as owner on owner.accountID = whiteboards.accountID
JOIN whiteboardsaccountsmapping as wbam on wbam.whiteboardID = whiteboards.whiteboardID
JOIN accounts on accounts.accountID = wbam.accountID
WHERE accounts.username='" . $GLOBALS["username"] . "'";
$result = sql_query($sql);

$whiteboards = array();

while($row = mysql_fetch_assoc($result))
{
	$whiteboards[] = $row;
}

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