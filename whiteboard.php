<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "error/notloggedin.php";
	die();
}
?>

<?php
$headContent = "<script type='text/javascript' src='script/paper.js'></script>
<script type='text/paperscript' canvas='drawBoard' src='/script/whiteboard.js'></script>"; //if needing to add extra css files
echo buildHead("Whiteboard",$headContent);
?>
<body>
<?php include "helpers/header.php"; ?>
<input type="hidden" id="accountID" value="<?=$GLOBALS["accountID"]?>" />
<span onclick="lineTool()">Line</span>
<span onclick="freeTool()">Free</span><br />
<canvas id="drawBoard" style="border: 1px solid" width="500" height="400"></canvas>

<div id="debug"></div>
<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>