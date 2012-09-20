<?php
include 'helpers/auth.php';

if (!$GLOBALS['loggedIn'])
{
	die("Not logged in");
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
		$courses = Courses::InSet($setID);
	}
	
	echo json_encode($courses);
}
else
{
	echo "Parameters not set";
}
?>