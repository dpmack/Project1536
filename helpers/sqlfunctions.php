<?php

function createUser($studentId, $firstName, $lastName, $email, $password)
{
	$password = generateHash($password);
	$sql = "INSERT INTO accounts
(firstName, lastName, username, password, email)
VALUES (\"" . mysql_real_escape_string($firstName) . "\", \"" . mysql_real_escape_string($lastName) . "\",
 \"" . mysql_real_escape_string($studentId) . "\", \"" . mysql_real_escape_string($password) . "\",
\"" . mysql_real_escape_string($email) . "\")";
	sql_query($sql);

	$sql = "SELECT accountID FROM accounts WHERE username = \"" . mysql_real_escape_string($studentId) . "\"";
	$result = mysql_fetch_array(sql_query($sql), MYSQL_ASSOC);
	return $result['accountID'];
}






























?>