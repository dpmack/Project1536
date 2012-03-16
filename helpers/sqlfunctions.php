<?php

function createUser($studentID, $firstName, $lastName, $email, $password)
{
	$password = generateHash($password);
	
	$sql = "INSERT INTO accounts
(firstName, lastName, username, password, email)
VALUES (\"" . mysql_real_escape_string($firstName) . "\", \"" . mysql_real_escape_string($lastName) . "\",
 \"" . mysql_real_escape_string($studentID) . "\", \"" . mysql_real_escape_string($password) . "\",
\"" . mysql_real_escape_string($email) . "\")";
	sql_query($sql);

	$sql = "SELECT accountID FROM accounts WHERE username = \"" . mysql_real_escape_string($studentID) . "\"";
	$result = mysql_fetch_array(sql_query($sql), MYSQL_ASSOC);
	return $result['accountID'];
}

function doesStudentIDExist($studentID)
{
	$sql = "SELECT 1 FROM accounts WHERE username = \"" . mysql_real_escape_string($studentID) . "\"";
	return (mysql_num_rows(sql_query($sql)) > 0);
}

function cleanEmailConfirms()
{
	sql_query("DELETE FROM confirmationEmails
WHERE expire < " . time());
}

function deleteEmailConfirmFor($accountID)
{	
	sql_query("DELETE FROM confirmationEmails
WHERE accountID = " . $accountID);
}

function createNewEmailConfirm($accountID)
{
	$MAX_TIME_EMAIL_CONFIRM = 60*60*24;
	
	cleanEmailConfirms();

	deleteEmailConfirmFor($accountID);

	do
	{
		$hash = sha1(uniqid("",true));
	}
	while (mysql_num_rows(sql_query("SELECT 1 FROM confirmationEmails WHERE hash='" . $hash . "'")) > 0);

	$sql = "INSERT INTO confirmationEmails
(hash, accountID, expire)
VALUES (\"" . $hash . "\", " . $accountID . ", " . (time() + $MAX_EMAIL_CONFIRM) . ")";
	sql_query($sql);
	
	$sql = "SELECT email FROM accounts
WHERE accountID=" . $accountID;
	$result = mysql_fetch_array(sql_query($sql), MYSQL_ASSOC);
	
	return array($result["email"], $hash);
}

function getAccountForEmailConfirm($hash)
{
	cleanEmailConfirms();
	
	$sql = "SELECT accountID FROM confirmationEmails
WHERE hash=\"" . mysql_real_escape_string($hash) . "\"";
	$result = sql_query($sql);
	
	if (mysql_num_rows($result) == 1)
	{
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
		return $data["accountID"];
	}
	return -1;
}

function confirmAccount($accountID)
{
	sql_query("UPDATE accounts
SET emailConfirmed=1
WHERE accountID = " . $accountID);

	deleteEmailConfirmFor($accountID);
}
	
?>