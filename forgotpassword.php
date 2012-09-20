<?php
include 'helpers/auth.php';
include "helpers/head.php";

echo buildHead("Forgot Password");
?>
<body>
<?php include "helpers/header.php"; ?>

<div class="section">
	<h2>Coming soon!</h2>
	In the mean time contact us at <a href="mailto:csthub@gmail.com">csthub@gmail.com</a> if you have any password problems.
</div>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>