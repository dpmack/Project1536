<?php
include 'opensql.php';

$username = '';
$GLOBALS['loggedIn'] = false;
$message = "";

define('SALT_LENGTH', 9);

function generateHash($plainText, $salt = null)
{
	if ($salt === null)
	{
		$salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
    }
    else
    {
        $salt = substr($salt, 0, SALT_LENGTH);
    }

    return $salt . sha1($salt . $plainText);
}

function new_ticket($name)
{
	$ticket = time();
	sql_set('accounts','username',$name,'ticket',$ticket);
	setcookie('ticket',$ticket,time()+60*30);
	setcookie('login',$name,time()+60*30);
};

if (isset($_POST["password"]) && isset($_POST['username']))
{
	$result = sql_get_single('accounts','username',$_POST['username']);
	if ($result["username"] != '' && $result['password'] == '' && $_POST['password'] != '')
	{
		$passHash = generateHash($_POST['password']);
		sql_set('accounts','username',$_POST['username'],'password',$passHash);
		$message = "New password created";
	}
	elseif(generateHash($_POST['password'],$result['password']) == $result['password'] && $_POST['password'] != '')
	{
		$GLOBALS['loggedIn'] = true;
		new_ticket($_POST['username']);
		$message = "Logged in successfully";
	}
	else
	{
		$message = "Invalid user name or password";
	};
};

if (isset($_COOKIE["login"]))
{
	$username = $_COOKIE['login'];
	$ticket = $_COOKIE['ticket'];

	if (floor($ticket)+60*30 > time())
	{
		$result = sql_get_single('accounts','username',$username);
		if ($result['ticket'] == $ticket && $ticket != '' && $ticket != 0)
		{
			$GLOBALS['loggedIn'] = true;
			if ($result['ticket']+60*5 < time())
			{
				new_ticket($username);
			}
		}
	}
	else
	{
		$message = "You have been auto logged out due to inactivity";
		sql_set('accounts','username',$username,'ticket',0);
	};
}

function logout()
{
	if (isset($_COOKIE['login']) && $GLOBALS['loggedIn'])
	{
		$username = $_COOKIE['login'];
		sql_set('accounts','username',$username,'ticket',0);
	}
}
?>