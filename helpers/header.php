<div id="header">
<div class="wrapper"><div class="wrapper">
	<ul id="quickLinks">
		<?php if (!$GLOBALS['loggedIn']): ?>
		<li><a href="/login.php">log in</a></li>
		<li><a href="/register.php">join</a></li>
		<?php else: ?>
		<li><a href="/logout.php">log out</a></li>
		<li><a href="/myhub.php">MYhub</a></li>
		<?php endif; ?>
	</ul>
	<h1><a href="/">CSThub</a></h1>
	<ul id="navigation">
		<li><a href="/index.php">Home</a></li>
		<li><a href="/forums.php">Forums</a></li>
		<li><a href="/help.php">Help</a></li>
		<li><a href="/homework.php">Homework</a></li>
		<li><a href="/schedule.php">Schedule</a></li>
	</ul>
</div></div> <!-- /wrappers for header -->
</div> <!-- /#header -->



<div id="breadcrumbs">
<div class="wrapper"><div class="wrapper">
	<ol>
		<?php
		if (isset($crumbs))
		{
			foreach ($crumbs as $crumb)
			{
				echo "<li><a href='" . $crumb["href"] . "'>" . $crumb["name"] . "</a></li>";
			}
		}
		?>
	</ol>
</div></div> <!-- /wrappers for navigation -->
</div><!-- /#navigation -->



<!-- main content area -->
<div id="content">
<div class="wrapper"><div class="wrapper"><div class="wrapper">

