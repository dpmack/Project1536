<?php
require_once 'helpers/auth.php';
require_once "templates/head.php";
require_once "helpers/embededLogin.php";
?>

<?php
header('Location: login.php?referer=' . $_SERVER["REQUEST_URI"]);

$headContent = "<meta http-equiv='Refresh' content='0; URL=login.php?referer=" . $_SERVER["REQUEST_URI"] . "'>";
echo buildHead("Not logged In", $headContent);
?>
<body>
<?php include "templates/header.php"; ?>

You must be logged in to view this page. Please visit the <a href="login.php">login page.</a>

<?php include "templates/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "templates/sqlDebug.php";
}
?>
</body>
</html>