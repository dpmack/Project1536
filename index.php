<?php
include "helpers/auth.php";
include "templates/header.php";
include "helpers/embededLogin.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php echo buildHeader("Home"); ?>
<body>

<div id="wrapper_header">
	<div id="header">
		<div id="wrapper_final_header">
			<div id="logo">
				<h1>CSThub</h1>
			</div>
			
			<div id="login">	
				<?php 
					if ($GLOBALS['loggedIn'])
					{
						echo loggedInUser();
					}
					else
					{
						echo embededLogin();
					}
				?>
			</div>
		</div> <!-- /#login -->
		
		
		
		
	</div> <!-- /#header -->
</div> <!-- /#wrapper_header -->


		<div id="navmain">
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">Forums</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Help</a></li>
			
			
			</ul>
		</div> <!-- /#navmain -->
		


<div id="wrapper_outer">
<div id="wrapper_inner">
<div id="wrapper_final">





	<ul id="feeds">
		<li>
			<div id="teacherfeed">
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
			</div> <!-- /#teacherfeed -->
		</li>
		
		
		<li>		
			<div id="userfeed">
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
			</div> <!-- /#userfeed -->
		</li>
		
		
		
	</ul> <!-- /#feeds -->

	<ul id="news">
		<li>
			<div id="adminfeed">
			<h3>News 1</h3>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
				</p>
			</div>  <!-- /#adminfeed -->
		</li>
		

		<li>
			<div id="resources">
				<h3>News 2</h3>
				<p>
				It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
				</p>

			</div>  <!-- /#resources -->
		</li>
	</ul> <!-- /#news -->



	<div id="footer">
	
		
		<h3>Help?</h3>
		<ul>
			<li><a href="#">about</a></li>
			<li><a href="#">site map</a></li>
			<li><a href="#">feedback</a></li>
			<li><a href="#">d2l</a></li>
			<li><a href="#">my.bcit.ca</a></li>
			<li><a href="#">bcit.ca</a></li>
			<li><a href="#">share.cas.bcit.ca</a></li>
			<li><a href="#">msdnaa.bcit.ca</a></li>
		</ul>
		
		
	</div> <!-- /#generalinfo -->

</div> <!-- /#wrapper_final -->
</div> <!-- /#wrapper_inner -->
</div> <!-- /#wrapper_outer -->

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "templates/sqlDebug.php";
}
?>
</body>
</html>
