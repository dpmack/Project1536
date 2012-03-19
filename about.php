<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";
?>

<?php
$headContent = ""; //if needing to add extra css files
echo buildHead("About",$headContent);
?>
<body>
<?php include "helpers/header.php"; ?>

<div class="section">
	<h2>Coming soon!</h2>
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