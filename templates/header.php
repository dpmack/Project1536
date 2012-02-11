<div id="wrapper_header">
	<div id="header">
		<div id="wrapper_final_header">
			<div id="logo">
				<a href="/">
					<h1>CSThub</h1>
				</a>
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