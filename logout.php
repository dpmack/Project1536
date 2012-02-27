<?php
include "helpers/auth.php";
include "helpers/head.php";
include "helpers/embededLogin.php";

logout();

?>

<?php 
header("Location: /index.php");
$headContent = '<meta http-equiv="REFRESH" content="0;url=index.php">';
echo buildHead("Logout", $headContent);
?>
<body>

<?php include "helpers/header.php"; ?>

You are being logged out.

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>	
</body>
</html>
