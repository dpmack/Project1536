<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"])
{
	include "errors/notloggedin.php";
	die();
}

$crumbs = array(array("href" => "index.php", "name" => "MYHub"));

$userRealName = Accounts::CurrentUsersName();

$siteAdmin = Permissions::Has("SITE_ADMINISTRATION");
$courseAdmin = Permissions::Has("COURSE_ADMINISTRATION");
				
$headContent = '';
echo buildHead("My Hub",$headContent);
?>
<body>
<?php include "helpers/header.php"; ?>

<div class="groupableSections">
	<div class="section">
	<h2>Welcome <?=$userRealName?></h2>
	
	<p>
		Keep track of your homework with our <a class="classicLink" href="homework.php">Homework checklist</a>.
	</p>
	
	<!--<a class="classicLink" href="schedule.php">My Schedule</a><br /> !-->
	
	<p>
		Discuss your courses with your peers on our <a class="classicLink" href="/forums.php">Forums</a>.
	</p>
	
	<p>
		Navigate through BCIT's websites with easy with our <a class="classicLink" href="/navigator/index.php">Navigator</a>.
	</p>
	
	<p>
		Collaborate with your peers with our shared <a class="classicLink" href="whiteboards.php">whiteboards</a>.
	</p>

	</div>
	<div class="section">
	<br />
	<br />
	<h3>Account</h3>
	
	<p>
		<a class="classicLink" href="manageCourses.php">Manage your courses</a>
	</p>
	
	<p>
		<a class="classicLink" href="changepassword.php">Change your password</a>
	</p>
	</div>
	
	<?php if (Permissions::Has("CREATE_HOMEWORK")): ?>
		<div class="section">
		<h3>Set Reps</h3>
		
		<p>
			<a class="classicLink" href="/admin/addHomework.php">Add Homework</a>
		</p>
		</div>
	<?php endif; ?>
	
	<?php if ($courseAdmin || $siteAdmin): ?>
		<div class="section">
		<h3>Admin</h3>
		
		<?php if ($courseAdmin): ?>
			<p>
				<a class="classicLink" href="/admin/admin.php">Course Admin</a>
			</p>
		<?php endif; ?>
		
		<?php if ($siteAdmin): ?>
			<p>
				<a class="classicLink" href="/admin/adminPermissions.php">Permissions</a>
			</p>
		<?php endif; ?>
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