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
		<input type="hidden" id="userID" value="<?=$GLOBALS["username"]?>" />
		Password: <input type="password" id="password" />
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
		<a id="myhublink" href="myhub.php">MYHub</a>
	</div>
	
	<iframe id="navigatorFrame" src="" style="height:90%;width:100%;border:none;position:fixed;"></iframe>
	<img id="image" style="display: none" onload="" onerror="" src="" />
</body>
</html>