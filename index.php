<?php
include "helpers/auth.php";
include "helpers/head.php";
include "helpers/embededLogin.php";
?>

<?php echo buildHead("Home"); ?>
<body>

<?php include "helpers/header.php"; ?>




	<div class="groupableSections">
		<div class="section">
			<h2>Homework</h2>
			<ul>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
			</ul>
		</div> <!-- /.section -->

		<div class="section">
			<h2>Recent Forum Activity</h2>
			<ul>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
				<li><a href="#">[2012.05.01] Item - Thing</a></li>
			</ul>
		</div> <!-- /.section -->
	</div> <!-- /.groupableSections -->

	<div class="groupableSections">
		<div class="section">
			<h2>News 1</h2>
			<p>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
			</p>
			<p>
			It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
			</p>
		</div>

		<div class="section">
			<h2>News 2</h2>
			<p>
			It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
			</p>
		</div>
	</div> <!-- /.groupableSections -->







<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>
