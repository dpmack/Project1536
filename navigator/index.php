<?php
include 'helpers/auth.php';
include "helpers/head.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "errors/notloggedin.php";
	die();
}

$hasCourses = Courses::HasAny($GLOBALS['accountID']);
$courses = Courses::Mine();

$headContent = '<link rel="stylesheet" type="text/css" href="/css/navigator.css" /> 
<script type="text/javascript" src="/script/navigator.js"></script>'; //if needing to add extra css files
echo buildHeadNoCSS("Navigator",$headContent);
?>
<body>
	<div class="menu">
		<span id="spanPassword">
		<input type="hidden" id="userID" value="<?=$GLOBALS["username"]?>" />
		BCIT Password: <input type="password" id="password" /></span>
		<select id="course" onchange="goCourse()">
			<option>--Select--</option>
			<?php
				foreach ($courses as $course)
				{
					if ($course["location"] == "--Select--" || $course["location"] == "" || $course["courseURL"] == "")
					{
						continue;
					}
					
					$courseName = $course["departmentName"] . " " . $course["courseCode"];
					if ($course["displayName"] !== "")
					{
						$courseName .= " - " . $course["displayName"];
					}
					
					echo "		<option location='" . $course["location"] . "' value='" . $course["courseURL"] . "'>$courseName</option>\n";
				}
			?>
		</select>
		<button type="button" onclick="goCourse()">Refresh</button>
		Popups must be enabled for this page to work.
		<a id="myhublink" href="/myhub/index.php">MYHub</a>
	</div>
	
	<?php if (!$hasCourses): ?>
		<br />You have not selected any courses. Please select your courses <a style="color: blue" href='manageCourses.php'>here.</a>
	<?php else: ?>
		<iframe id="navigatorFrame" src="" style="height:90%;width:100%;border:none;position:fixed;"></iframe>
	<?php endif; ?>
	
	<img id="image" style="display: none" onload="" onerror="" src="" />
	
	<script type='text/javascript'>
		delta = (new Date()).getTime() - <?=time()*1000 - $MyBCITDelta?>;
	</script>
</body>
</html>