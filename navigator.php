<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "error/notloggedin.php";
	die();
}

$courses = getMyCourses();

$headContent = '<link rel="stylesheet" type="text/css" href="/css/navigator.css" /> 
<script type="text/javascript" src="script/navigator.js"></script>'; //if needing to add extra css files
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
		<a id="myhublink" href="myhub.php">MYHub</a>
	</div>
	
	<iframe id="navigatorFrame" src="" style="height:90%;width:100%;border:none;position:fixed;"></iframe>
	<img id="image" style="display: none" onload="" onerror="" src="" />
	
	<script type='text/javascript'>
		delta = (new Date()).getTime() - <?=time()*1000 - $MyBCITDelta?>;
	</script>
</body>
</html>