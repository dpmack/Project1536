<?php
include 'helpers/auth.php';

if (!$GLOBALS['loggedIn'])
{
	die("Not logged in");
}

if (!hasPermission("SITE_ADMINISTRATION"))
{
	include "./error/notauth.php";
	die();
}

$courseID = filter_input(INPUT_GET,"courseID", FILTER_VALIDATE_INT);

if($courseID !== null)
{
	$course = getCourseInfo($courseID);
	echo json_encode($course);
}
else
{
	echo "Parameters not set";
}
?>