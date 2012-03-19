<?php
date_default_timezone_set('America/Vancouver');

include 'opensql.php';

$GLOBALS['LOGIN_WINDOW'] = 60*30;

$GLOBALS['accountID'] = -1;
$GLOBALS['username'] = '';
$GLOBALS['loggedIn'] = false;
$GLOBALS['message'] = "";
$GLOBALS['ticket'] = "";

function generateSalt()
{	
	return md5(uniqid(rand(), true));
}

function extraHash($password)
{
	return sha1($password);
}

function generateHash($password)
{
	$salt = generateSalt();
	return crypt($password, '$6$rounds=45489$' . $salt. '$');
}

function checkHash($password, $hash)
{
	return (crypt($password, $hash) === $hash);
}

function browserSig()
{
	$data = $_SERVER['HTTP_HOST'];
	$data .= $_SERVER['HTTP_USER_AGENT'];
	return sha1($data);
}

function makeTicket($passwordHash)
{
	return sha1(uniqid("",true) . browserSig() . $passwordHash);
}

function newTicket($accountID, $passwordHash)
{
	do
	{
		$newTick = makeTicket($passwordHash);
	}
	while (mysql_num_rows(sql_query("SELECT 1 FROM tickets WHERE ticket='" . $newTick . "'")) > 0);
		
	if (isset($_COOKIE["ticket"]))
	{
		$sql = "UPDATE tickets
SET ticket='" . $newTick . "', lastActivity=" . time() . "
WHERE ticket='" . mysql_real_escape_string($_COOKIE["ticket"]) . "'";
	}
	else
	{
		$sql = "INSERT INTO tickets (ticket, clientHash, lastActivity, accountID)
VALUES ('" . $newTick . "', '" . browserSig() . "', " . time() . ", " . $accountID . ")";
	}
	
	sql_query($sql);
	$GLOBALS['ticket'] = $newTick;
	setcookie('ticket',$newTick,$_SERVER['REQUEST_TIME'] + $GLOBALS['LOGIN_WINDOW']);
}

function cleanTickets()
{
	$sql = "DELETE FROM tickets
WHERE lastActivity < " . (time() - $GLOBALS['LOGIN_WINDOW']);
	sql_query($sql);
}

function logout()
{
	if (isset($_COOKIE['ticket']))
	{
		sql_query("DELETE FROM tickets
WHERE ticket='" . mysql_real_escape_string($_COOKIE['ticket']) . "'");
		setcookie('ticket',"expired",time()-60*60);
	}
}

if ((isset($_POST["password"]) || isset($_POST["hPassword"])) && isset($_POST['username']))
{
	if (isset($_COOKIE["ticket"]))
	{
		logout();
	}
	
	if (isset($_POST["password"]))
	{
		$pass = extraHash($_POST["password"]);
	}
	else
	{
		$pass = $_POST["hPassword"];
	}
	
	$username = strtoupper(mysql_real_escape_string($_POST['username']));
	
	$sql = "SELECT accountID, password, emailConfirmed FROM accounts
WHERE username='" . $username . "'";
	
	$result = mysql_fetch_array(sql_query($sql), MYSQL_ASSOC);
	
	if ($result && !$result["emailConfirmed"])
	{
		$GLOBALS["message"] = "Email Address has not been confirmed. Please check your email.";
	}
	elseif ($result && $result['password'] != '' && checkHash($pass, $result['password']))
	{
		$passHash = generateHash($pass);
		newTicket($result["accountID"], $passHash);
		$GLOBALS['loggedIn'] = true;
		$GLOBALS['accountID'] = $result["accountID"];
		$GLOBALS['username'] = $username;
		$GLOBALS['message'] = "Logged in successfully";
		cleanTickets();
	}
	else
	{
		$GLOBALS['message'] = "Invalid user name or password";
	}
}
elseif (isset($_COOKIE["ticket"]))
{
	$oldTicket = mysql_real_escape_string($_COOKIE['ticket']);
	
	$sql = "SELECT accounts.accountID, username, password, clientHash, lastActivity
FROM tickets
JOIN accounts on tickets.accountID = accounts.accountID
WHERE tickets.ticket = '" . $oldTicket . "'";
	
	$result = mysql_fetch_array(sql_query($sql), MYSQL_ASSOC);
	
	if ($result && ($result['lastActivity'] > (time() - $GLOBALS['LOGIN_WINDOW'])))
	{
		if ($result['clientHash'] != browserSig())
		{
			sql_error("Ticket matched but Sig didn't", "AccountID: " . $result['accountID'] .
			" IP: " . $_SERVER['REMOTE_ADDR'] . " Referer: " . $_SERVER['HTTP_REFERER'] . 
			" User Agent: " . $_SERVER["HTTP_USER_AGENT"] . " Ticket: " . $oldTicket . " Sig: " . browserSig());
			
			logout();
			//Delete all tickets for that account
			$GLOBALS['message'] = "Logged out cause client hash does not match";
		}
		else
		{
			newTicket($result["accountID"], $result['password']);
			$GLOBALS['loggedIn'] = true;
			$GLOBALS['accountID'] = $result["accountID"];
			$GLOBALS['username'] = $result['username'];
			$GLOBALS['message'] = "Ticket matches, logged in is ok";
		}
	}
	else
	{
		logout();
		$GLOBALS['message'] = "You have been auto logged out due to inactivity";
	}
}

function hasPermission($permission)
{
	if (!$GLOBALS['loggedIn'])
	{
		return false;
	}
	
	$sql = "SELECT 1
FROM permissions
JOIN rolespermissionsmapping as rpm on permissions.permissionID = rpm.permissionID
JOIN roles on rpm.roleID = roles.roleID
JOIN accountrolesmapping as arm on roles.roleID = arm.roleID
JOIN accounts on arm.accountID = accounts.accountID
WHERE accounts.username = " . $GLOBALS['username'];

	return (mysql_num_rows(sql_query($sql)) > 0);
}

if (isset($_GET["demoaccount"]))
{
	$GLOBALS['loggedIn'] = true;
	$GLOBALS['username'] = "A00000000";
	$GLOBALS['accountID'] = 0;
	$GLOBALS['message'] = "Logged in as demo account";
}
?>