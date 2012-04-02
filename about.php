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
	<h2>About CSTHub</h2>	
	<p>	
		CSTHub was started by five CST students, (Jake, Jay, Kevin, Troy and David),
		because we that found the BCIT system difficult to use.
	</p>
	
	<br />
	
	<p>
		BCIT has Desire 2 Learn, share In/Out, and my.bcit, that are being used by all the professors.
		It is not immediately clear which website had what courses on them.
		This system has caused students to be confused and spend more time on jumping around multiple websites for their studies.
	</p>
	
	<br />
	
	<p>
		This frustration gave us the motivation to build CSTHub.
		Which allows us to bring all the platforms together, and ultimately help students study with ease. 
	</p>
	
	<br />
	
	<h2>What exactly is CSTHub</h2>
	
	<p>
		With the Forums we wrote from scratch allow students to discuss homework problems, organize study groups and find out
		the latest on what's happening around campus.
	</p>
	
	<br />
	
	<p>
		Our navigator provides quick access to [multiple platforms such as] D2L, MyBCIT and Share.
	</p>
		
	<br />
	
	<p>
		Our homework checklist allows students to keep track of their homework and due dates, all in one place.
		Which is updated by set reps, so as to be constantly up to date.
	</p>
	
	<br />
	
	<p>
		Our front page shows a quick overview of whats new.
		Listing off major news posts as well as showing which topics have been active recently.
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