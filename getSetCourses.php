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

$setID = filter_input(INPUT_GET,"setID", FILTER_VALIDATE_INT);

if ($setID !== null)
{
	if ($setID == -1)
	{
		$courses = array();
	}
	else
	{
		$courses = getCoursesInSet($setID);
	}
	
	echo json_encode($courses);
}
else
{
	echo "Parameters not set";
}
?>