<?php
require_once "./helpers/auth.php";
require_once "./helpers/head.php";
require_once "./helpers/embededLogin.php";

addAuthError();

$headContent = "";
echo buildHead("Not authorized", $headContent);
?>
<body>
<?php include "helpers/header.php"; ?>

<br />
You are not permitted to view this page. This incident has been reported.

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>