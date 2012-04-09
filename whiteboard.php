<?php
include 'helpers/auth.php';
include "helpers/head.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "error/notloggedin.php";
	die();
}

$whiteboardID = filter_input(INPUT_GET,"whiteboardID", FILTER_VALIDATE_INT);
$addID = (isset($_POST["studentID"])) ? $_POST["studentID"] : null;

$owner = isOwnerOfWhiteboard($whiteboardID, $GLOBALS["accountID"]);

if ($addID != null && $owner)
{
	$addAccount = getAccountIDOf($addID);
	if ($addAccount !== false)
	{
		addUserToWhiteboard($whiteboardID, $addAccount);
	}
}

$colors = array(array("Black","000000"), array("Red", "FF0000"));
?>

<?php
$headContent = "<script type='text/javascript' src='script/paper.js'></script>
<script type='text/javascript' src='/script/whiteboard.js'></script>
<link rel='stylesheet' type='text/css' href='/css/whiteboard.css' />";
echo buildHead("Whiteboard",$headContent);
?>
<body>
<?php include "helpers/header.php"; ?> <div id="whiteboardDisplay" style="display: none">
<input type="hidden" id="accountID" value="<?=$GLOBALS["accountID"]?>" />
<input type="hidden" id="whiteboardID" value="<?=$whiteboardID?>" />

<div id="pages">
	<!--<u>Draw Modes</u>!-->
	<div id="pageButtons"></div>
	<button id="newPage" type="button" onclick="newPage()">New Page</button>
</div>

<!--<div id="tools">
	<button type="button" onclick="freeDraw()">Free Draw</button><br />
	<button type="button" onclick="selectTool()">Select</button><br />
</div>!-->

<canvas id="drawBoard" style="border: 1px solid" width="600" height="500"></canvas>

<? if ($owner): ?>
<div id="members">
	<form action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
		Add user to whiteboard: <br />
		Student ID: <input type="text" name="studentID" /><br />
		<input type="submit" value="Add" />
	</form>
</div>
<? endif; ?>

<div id="debug"></div></div>

<div id="loadingWhiteboard">
	<br />
	Loading your whiteboard. Please wait.
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