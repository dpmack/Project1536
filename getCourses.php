<?php
include 'helpers/auth.php';

if (!$GLOBALS['loggedIn'])
{
	die("Not logged in");
}

$deptID = filter_input(INPUT_GET,"departmentID", FILTER_VALIDATE_INT);

if($deptID !== null)
{
	echo "<option>--Select--</option>";
	$courses = getCourses($deptID);
	foreach ($courses as $course)
	{
		echo "<option value='" . $course['courseID'] . "'>" . $course["courseCode"] . "</option>\n";
	}
}
else
{
	echo "Parameters not set";
}
?>