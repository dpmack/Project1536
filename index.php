<?php
include "helpers/auth.php";
include "helpers/head.php";
include "helpers/embededLogin.php";

$activity = FrontPage::RecentActivity();
$news = Forums::News();

$dateFormat = "d/m/Y - g:ia";

echo buildHead("Home"); ?>
<body>
<?php include "helpers/header.php"; ?>
<div class="groupableSections">
	<div class="section">
		<h2>Recent Forum Activity</h2>
		<ul>
			<?php
			foreach ($activity as $topic)
			{
				echo "<li><a href='thread.php?topicID=" . $topic["topicID"] . "&page=-1'>[" . 
				date($dateFormat, $topic["createdDate"]) . "] " . $topic["title"] . "</a></li>";
			}
			?>
		</ul>
	</div> <!-- /.section -->
</div> <!-- /.groupableSections -->

<hr /><br />

<?php
foreach ($news as $newsPost)
{
	echo "<div class='groupableSections'>
	<h2>" . $newsPost["title"] . "</h2>
	" . $newsPost["content"] . "
	</div>";
}
?>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>
