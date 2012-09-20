<?php
include 'sql/opensql.php';

if($SSL_ENABLED && $_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

define("MIN_PASSWORD_LENGTH", 8);

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
	while (mysql_num_rows(SQL::SingleQuery("SELECT 1 FROM tickets WHERE ticket=" . SQL::Safe($newTick))) > 0);
	
	$success = true;
	
	if (isset($_COOKIE["ticket"]))
	{
		SQL::SingleQuery("UPDATE tickets
SET ticket=" . SQL::Safe($newTick) . ", lastActivity=" . SQL::SafeInt(time()) . "
WHERE ticket=" . SQL::Safe($_COOKIE["ticket"]));
		if (mysql_affected_rows(SQL::$Link) !== 1)
		{
			$success = false;
		}
	}
	else
	{
		SQL::SingleQuery("INSERT INTO tickets (ticket, clientHash, lastActivity, accountID)
VALUES (" . SQL::Safe($newTick) . ", " . SQL::Safe(browserSig()) . ", " . SQL::SafeInt(time()) . ", " . SQL::SafeInt($accountID) . ")");
	}
	
	if ($success)
	{
		$GLOBALS['ticket'] = $newTick;
		setcookie('ticket',$newTick,$_SERVER['REQUEST_TIME'] + $GLOBALS['LOGIN_WINDOW'], "/");
	}
}

function cleanTickets()
{
	SQL::SingleQuery("DELETE FROM tickets
WHERE lastActivity < " . (time() - $GLOBALS['LOGIN_WINDOW']));
}

function logout()
{
	if (isset($_COOKIE['ticket']))
	{
		SQL::SingleQuery("DELETE FROM tickets
WHERE ticket=" . SQL::Safe($_COOKIE['ticket']));
	}
	setcookie('ticket',"expired",time()-60*60,"/");
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
	
	$result = SQL::SingleQuery("SELECT accountID, password FROM accounts
WHERE username=" . SQL::Safe($_POST['username']));
	
	$data = mysql_fetch_assoc($result);
	
	if ($data && $data['password'] != '' && checkHash($pass, $data['password']))
	{
		$passHash = generateHash($pass);
		newTicket($data["accountID"], $passHash);
		$GLOBALS['loggedIn'] = true;
		$GLOBALS['accountID'] = $data["accountID"];
		$GLOBALS['username'] = $_POST['username'];
		$GLOBALS['message'] = "Logged in successfully";
		cleanTickets();
	}
	else
	{
		$GLOBALS['message'] = "Error: Invalid user name or password";
	}
}
elseif (isset($_COOKIE["ticket"]))
{
	$result = SQL::SingleQuery("SELECT accounts.accountID, username, password, clientHash, lastActivity
FROM tickets
JOIN accounts on tickets.accountID = accounts.accountID
WHERE tickets.ticket=" . SQL::Safe($_COOKIE["ticket"]));
	
	$data = mysql_fetch_assoc($result);
	
	if ($data && ($data['lastActivity'] > (time() - $GLOBALS['LOGIN_WINDOW'])))
	{
		if ($data['clientHash'] != browserSig())
		{
			SQL::SingleQuery("INSERT INTO errors
(time,message,comment)
VALUES(NOW(), " . SQL::Safe("Ticket matched but Sig didn't") . ", " . SQL::Safe("AccountID: " . $data['accountID'] .
			" IP: " . $_SERVER['REMOTE_ADDR'] . " Referer: " . @$_SERVER['HTTP_REFERER'] . 
			" User Agent: " . $_SERVER["HTTP_USER_AGENT"] . " Ticket: " . $_COOKIE["ticket"] . " Sig: " . browserSig()) . ")");
			
			logout();
			//Delete all tickets for that account
			$GLOBALS['message'] = "Error: Logged out cause client hash does not match";
		}
		else
		{
			newTicket($data["accountID"], $data['password']);
			$GLOBALS['loggedIn'] = true;
			$GLOBALS['accountID'] = $data["accountID"];
			$GLOBALS['username'] = $data['username'];
			$GLOBALS['message'] = "Ticket matches, logged in is ok";
		}
	}
	else
	{
		logout();
		$GLOBALS['message'] = "You have been auto logged out due to inactivity";
	}
}
?>