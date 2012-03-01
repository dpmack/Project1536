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
$headContent = ""; //if needing to add extra css files
echo buildHead("Page name here",$headContent);
?>
<body>
<?php include "helpers/header.php"; ?>

<!-- code here !-->

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>