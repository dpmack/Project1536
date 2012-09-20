<?php
include 'helpers/auth.php';

if (!$GLOBALS['loggedIn'])
{
	die("Not logged in");
}

if (!Permissions::Has("SITE_ADMINISTRATION"))
{
	include "errors/notauth.php";
	die();
}

$courseID = filter_input(INPUT_GET,"courseID", FILTER_VALIDATE_INT);

if($courseID !== null)
{
	$course = Courses::Info($courseID);
	echo json_encode($course);
}
else
{
	echo "Parameters not set";
}
?>