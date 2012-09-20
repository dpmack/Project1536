<?

class Email
{
	public static function CleanConfirm()
	{
		SQL::SingleQuery("DELETE FROM confirmationEmails
	WHERE expire < " . time());
	}

	public static function DeleteCofirm($accountID, $sqlPassed=false)
	{	
		$accountID = SQL::SafeInt($accountID);
		
		if ($accountID === false)
		{
			return false;
		}
	
		$sql = $sqlPassed;
		if ($sqlPassed === false)
		{
			$sql = new SQL();
		}
	
		$sql->query("DELETE FROM confirmationEmails
	WHERE accountID = " . $accountID);
	
		if ($sqlPassed === false)
		{
			$sql->close();
		}
	}

	public static function NewConfirm($accountID)
	{
		$accountID = SQL::SafeInt($accountID);
		
		if ($accountID === false)
		{
			return false;
		}
	
		$MAX_TIME_EMAIL_CONFIRM = 60*60*24;
		
		Email::CleanConfirms();
		
		$sql = new SQL();

		Email::DeleteConfirm($accountID,$sql);

		do
		{
			$hash = sha1(uniqid("",true));
		}
		while (mysql_num_rows(SQL::SingleQuery("SELECT 1 FROM confirmationEmails WHERE hash=" . SQL::Safe($hash) . "")) > 0);

		$sql->query("INSERT INTO confirmationEmails
	(hash, accountID, expire)
	VALUES (" . SQL::Safe($hash) . ", $accountID, " . (time() + $MAX_EMAIL_CONFIRM) . ")");
		
		$result = $sql->query("SELECT email FROM accounts
	WHERE accountID=$accountID");
	
		if (mysql_num_rows($result) == 0)
		{
			$data = mysql_fetch_assoc($result);
			$sql-save();
			return array($data["email"], $hash);
		}
		$sql->cancel();
		
		return false;
	}

	public static function AccountByConfirm($hash)
	{
		Email::CleanConfirms();
		
		$result = SQL::SingleQuery("SELECT accountID FROM confirmationEmails
WHERE hash=" . SQL::Safe($hash));
		
		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			return $data["accountID"];
		}
		return false;
	}
}
?>