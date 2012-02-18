<div id="wrapper_header">
	<div id="header">
		<div id="wrapper_final_header">
			<div id="logo">
				<h1><a href="/">CSThub</a></h1>				
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
				<li><a href="index.php">Home</a></li>
				<li><a href="forums.php">Forums</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="faq.php">Help</a></li>
			
			
			</ul>
		</div> <!-- /#navmain -->
		

<div id="wrapper_outer">
<div id="wrapper_inner">
<div id="wrapper_final">