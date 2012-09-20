<?
class Accounts
{
	public static function CurrentUsersName()
	{
		$result = SQL::SingleQuery("SELECT firstName, lastName FROM accounts
WHERE accountID=" . SQL::SafeInt($GLOBALS["accountID"]));

		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			return $data["firstName"] . " " . $data["lastName"];
		}
		return "";
	}

	public static function AccountID($username)
	{
		$result = SQL::SingleQuery("SELECT accountID from accounts
WHERE username=" . SQL::Safe(strtoupper($username)));
		
		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			return $data["accountID"];
		}
		return false;
	}

	public static function All()
	{
		$result = SQL::SingleQuery("SELECT roleID, accounts.accountID, firstName, lastName, username from accounts
LEFT JOIN accountsRolesMapping as arm on arm.accountID = accounts.accountID");
		
		$users = array();

		while($row = mysql_fetch_assoc($result))
		{
			$users[] = $row;
		}
		return $users;
	}

	public static function UsersName($accountID)
	{
		$accountID = SQL::SafeInt($accountID);
		
		if ($accountID === false)
		{
			return false;
		}
		
		$result = SQL::SingleQuery("SELECT firstName, lastName FROM accounts
WHERE accountID = $accountID");

		return mysql_fetch_assoc($result);	
	}

	public static function Create($username, $firstName, $lastName, $email, $password)
	{
		$emailConfirmed = 1; //Until mail works on server
	
		$passwordHash = generateHash($password);
		
		$sql = new SQL();
		
		$sql->query("INSERT INTO accounts
(firstName, lastName, username, password, email, emailConfirmed)
VALUES (" . SQL::Safe($firstName) . ", " . SQL::Safe($lastName) . ",
	 " . SQL::Safe(strtoupper($username)) . ", " . SQL::Safe($passwordHash) . ",
	" . SQL::Safe($email) . ", $emailConfirmed)");

		$result = $sql->query("SELECT accountID FROM accounts
WHERE username=" . SQL::Safe(strtoupper(($username))));

		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			$accountID = $data['accountID'];
		
			$result = $sql->query("SELECT roleID FROM roles
WHERE roleName = 'Student'");
			$data = mysql_fetch_assoc($result);
			Roles::SetRole($accountID, $data['roleID'], $sql);
			
			$sql->save();
			return $accountID;
		}
		
		$sql->cancel();
	}

	public static function Exists($username)
	{
		$result = SQL::SingleQuery("SELECT 1 FROM accounts
WHERE username=" . SQL::Safe(strtoupper($username)));
		return (mysql_num_rows($result) > 0);
	}

	public static function Confirm($accountID)
	{
		$accountID = SQL::SafeInt($accountID);
		
		if ($accountID === false)
		{
			return false;
		}
	
		$sql = new SQL();
		
		$sql->query("UPDATE accounts
SET emailConfirmed=1
WHERE accountID=$accountID");

		Email::DeleteConfirm($accountID, $sql);
		
		$sql->save();
	}

	public static function CheckPassword($accountID, $password)
	{
		$accountID = SQL::SafeInt($accountID);
		
		if ($accountID === false)
		{
			return false;
		}
	
		$result = SQL::SingleQuery("SELECT password FROM accounts
WHERE accountID=$accountID");
		
		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			return checkHash($password, $data["password"]);
		}
		return false;
	}

	public static function ChangePassword($accountID, $password)
	{
		$accountID = SQL::SafeInt($accountID);
		
		if ($accountID === false)
		{
			return false;
		}
	
		$passwordHash = generateHash($password);
		
		$result = SQL::SingleQuery("UPDATE accounts 
SET password=" . SQL::Safe($passwordHash) . "
WHERE accountID=$accountID");

		return ($result !== false);
	}
}
?>