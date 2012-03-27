<?php
include 'helpers/auth.php';

if (!$GLOBALS['loggedIn'])
{
	die("Not logged in");
}

$deptID = filter_input(INPUT_GET,"departmentID", FILTER_VALIDATE_INT);

if($deptID !== null)
{
	$courses = getCourses($deptID);
	foreach ($courses as $course)
	{
		$courseDisplayName = $course["courseCode"];
		if ($course["displayName"] !== "")
		{
			$courseDisplayName .= " - " . $course["displayName"];
		}
		
		echo "<option value='" . $course['courseID'] . "'>" . $courseDisplayName . "</option>\n";
	}
}
else
{
	echo "Parameters not set";
}
?>