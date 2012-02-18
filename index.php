<?php
include "helpers/auth.php";
include "templates/head.php";
include "helpers/embededLogin.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php echo buildHead("Home"); ?>
<body>

<?php include "templates/header.php"; ?>
<div class="feed">
	<div id="homework" >
		<h3>Homework</h3>
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
	</div>
</div> <!-- /#teacherfeed -->

<div class="feed">
	<div id="recentPosts">
		<h3>Off Topic</h3>
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
	</div>
</div> <!-- /#userfeed -->

<ul id="news">
	<li>
		<div class="section">
		<h3>News 1</h3>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
			</p>
		</div>
	</li>
	

	<li>
		<div class="section">
			<h3>News 2</h3>
			<p>
			It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
			</p>
		</div>
	</li>
</ul> <!-- /#news -->



	<?php include "templates/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "templates/sqlDebug.php";
}
?>
</body>
</html>
