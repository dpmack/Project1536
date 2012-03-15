<?php
include 'helpers/auth.php';
include "helpers/head.php";
?>

<?php
$headContent = ""; //if needing to add extra css files
echo buildHead("Registration Successful",$headContent);
?>
<body>
<?php include "helpers/header.php"; ?>

Registration Sucessful! Please check your email for a link to confirm your account.

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>