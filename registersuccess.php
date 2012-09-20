<?php
include "helpers/auth.php";
include "helpers/head.php";

echo buildHead("Registration Successful");
?>
<body>
<?php include "helpers/header.php"; ?>

Registration Sucessful! <!--Please check your email for a link to confirm your account. !-->

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>