<?php
include 'helpers/auth.php';

if (!$GLOBALS['loggedIn'])
{
	die("Not logged in");
}

if (isset($_GET["homeworkID"]) && isset($_GET["homeworkStatus"]))
{
	$finished = Homework::Status($GLOBALS["accountID"], $_GET["homeworkID"]);
	
	if ($_GET["homeworkStatus"] == "done" && $finished == 0)
	{
		Homework::SetDone($GLOBALS["accountID"], $_GET["homeworkID"]) or die("Couldn't SetDone");
		echo "set to done";
	}
	else if ($_GET["homeworkStatus"] == "todo" && $finished == 1)
	{
		Homework::SetNotDone($GLOBALS["accountID"], $_GET["homeworkID"]) or die("Couldn't SetNotDone");
		echo "set to todo";
	}
	else
	{
		echo "set to " . $_GET["homeworkStatus"] . " but db already has it as " . $result['finished'];
	}
}
else
{
	echo "Parameters not set";
}
?>