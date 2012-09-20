<?php
require_once "helpers/auth.php";
require_once "helpers/head.php";
require_once "helpers/embededLogin.php";

$dest = "/myhub/login.php?referer=" . $_SERVER["PHP_SELF"] . "&q=" . $_SERVER["QUERY_STRING"];

header("Location: $dest");

$headContent = "<meta http-equiv='Refresh' content='0; URL=/myhub/login.php?referer=$dest'>";
echo buildHead("Not logged In", $headContent);
?>
<body>
<?php include "helpers/header.php"; ?>

You must be logged in to view this page. Please visit the <a href="/myhub/login.php?referer=<?php echo $dest; ?>">login page.</a>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>