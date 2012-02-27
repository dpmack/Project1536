<?php
include "helpers/auth.php";
include "templates/head.php";
include "helpers/embededLogin.php";

logout();

?>

<?php 
header("Location: /index.php");
$headContent = '<meta http-equiv="REFRESH" content="0;url=index.php">';
echo buildHead("Logout", $headContent);
?>
<body>

<?php include "templates/header.php"; ?>

You are being logged out.

<?php include "templates/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "templates/sqlDebug.php";
}
?>	
</body>
</html>
