<?php
require_once "helpers/auth.php";
require_once "helpers/head.php";

echo buildHead("Something went wrong");
?>
<body>
<?php include "helpers/header.php"; ?>

<br />
Something went wrong. We are working to fix this as soon as possible.
<?=$error?>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>