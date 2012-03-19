<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"])
{
	include "error/notloggedin.php";
	die();
}

$crumbs = array(array("href" => "myhub.php", "name" => "MYHub"));

$userRealName = getUsersName();
				
$headContent = '';
echo buildHead("My Hub",$headContent);
?>
<body>

<?php
include "helpers/header.php";
?>

<div class="groupableSections">
	<div class="section">
	<h2>Welcome <?=$userRealName?></h2>
	
	<p>
		Keep track of your homework with our <a class="classicLink" href="homework.php">Homework checklist</a>.
	</p>
	
	<!--<a class="classicLink" href="schedule.php">My Schedule</a><br /> !-->
	
	<p>
		Discuss your courses with your peers on our <a class="classicLink" href="forums.php">Forums</a>.
	</p>
	
	<p>
		Navigate through BCIT's websites with easy with our <a class="classicLink" href="navigator.php">Navigator</a>.
	</p>
	
	</div>
	<div class="section">
	<br />
	<br />
	</div>
	
	<?php if (hasPermission("CREATE_HOMEWORK")): ?>
		<div class="section">
		<h3>Set Reps</h3>
		
		<p>
			<a class="classicLink" href="addHomework.php">Add Homework</a>
		</p>
		</div>
	<?php endif; ?>
	
	<?php if (hasPermission("SITE_ADMINISTRATION")): ?>
		<div class="section">
		<h3>Admin</h3>
	
		<p>
			<a class="classicLink" href="admin.php">Admin</a>
		</p>
		
		<p>
			<a class="classicLink" href="adminPermissions.php">Permissions</a>
		</p>
		</div>
	<?php endif; ?>
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