<?php
include 'helpers/auth.php';

if (!$GLOBALS['loggedIn'])
{
	die("Not logged in");
}

if (isset($_GET["homeworkID"]) && isset($_GET["homeworkStatus"]))
{
	// may not be the best joins double check
	$sql = "SELECT !ISNULL(ham.homeworkID) as finished, accounts.accountID as accountID 
FROM homework
JOIN courses on homework.courseID=courses.courseID
JOIN accounts
LEFT JOIN homeworkAccountMapping as ham on homework.homeworkID=ham.homeworkID and accounts.accountID=ham.accountID
WHERE accounts.username='" . $GLOBALS['username'] . "'  
and homework.homeworkID=" . mysql_real_escape_string($_GET["homeworkID"]);
	
	$result = mysql_fetch_assoc(sql_query($sql));

	if ($_GET["homeworkStatus"] == "done" && $result['finished'] == 0)
	{
		$sql = "INSERT INTO homeworkAccountMapping VALUES (" . mysql_real_escape_string($_GET["homeworkID"]) . ", " . 
			   $result['accountID'] . ")";
			  
		sql_query($sql);
		echo "set to done";
	}
	else if ($_GET["homeworkStatus"] == "todo" && $result['finished'] == 1)
	{
		$sql = "DELETE FROM homeworkAccountMapping where accountID=" . $result["accountID"] . 
		       " and homeworkID=" .  mysql_real_escape_string($_GET["homeworkID"]);
		
		sql_query($sql);
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