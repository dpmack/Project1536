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
	<h2>About Us</h2>	
	<p>	
		We are five students that found the current BCIT system difficult to navigate.	
		BCIT has Desire 2 Learn, share In/Out, and my.bcit, that are being used by all the professors.
		This system has caused students to be confused and spend more time on jumping around multiple websites for their studies. 
		Therefore, we made this website to bring all three platforms together, and ultimately help students study with ease. 
		With Forums written from scratch students can discuss homework problems, organize study groups and find out
		the latest on what's happening around campus.
		Our navigator provides quick access to [multiple platforms such as] D2L, MyBCIT and MSDNAA.
		
		
		An updated homework checklist will allow students to keep track of their homework and due dates, all in one place.
	</p>
	<h2>Features</h2>
	<p>
		Access to D2L<br />
		Access to MyBcit<br />
		Access to MSDNAA<br />
		News<br />
		Updated Homework Checklist<br />
		Course Forum<br />
		Off-Topic Forum<br />
	</p>
	
	<p>
	
	</p>
	
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