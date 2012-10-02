<?
class Whiteboards
{
	public static function IsOwner($whiteboardID, $accountID)
	{
		$whiteboardID = SQL::SafeInt($whiteboardID);
		$accountID = SQL::SafeInt($accountID);
		
		if ($whiteboardID === false || $accountID === false)
		{
			return false;
		}
		
		$result = SQL::SingleQuery("SELECT 1 from whiteboards
WHERE accountID=$accountID and whiteboardID=$whiteboardID");
		
		return (mysql_num_rows($result) == 1);
	}

	public static function AddUser($whiteboardID, $accountID, $sql=false)
	{
		$whiteboardID = SQL::SafeInt($whiteboardID);
		$accountID = SQL::SafeInt($accountID);
		
		if ($whiteboardID === false || $accountID === false)
		{
			return false;
		}
		
		$query = "INSERT INTO whiteboardsAccountsMapping (whiteboardID, accountID)
VALUES ($whiteboardID, $accountID)";
		
		if ($sql === false)
		{
			SQL::SingleQuery($query);
		}
		else
		{
			$sql->query($query);
		}
	}

	public static function Create($title)
	{
		$sql = new SQL();
	
		$sql->query("INSERT INTO whiteboards (title, accountID)
VALUES (" . SQL::Safe(HTML::Safe($title)) . ", " . SQL::SafeInt($GLOBALS["accountID"]) . ")");
		
		$result = $sql->query("SELECT LAST_INSERT_ID() as whiteboardID");
		
		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			$whiteboardID = $data["whiteboardID"];
			
			Whiteboards::AddUser($whiteboardID, $GLOBALS["accountID"],$sql);
			
			mkdir("whiteboards\\boards\\" . $whiteboardID);
			file_put_contents("whiteboards\\boards\\" . $whiteboardID . "\\pages.json", '["Default"]');
			
			$sql->save();
		}
		else
		{
			$sql->cancel();
		}
	}

	public static function Mine()
	{
		$result = SQL::SingleQuery("SELECT whiteboards.whiteboardID as whiteboardID, title, CONCAT(owner.firstName, ', ', owner.lastName) as authorName FROM whiteboards
JOIN accounts as owner on owner.accountID = whiteboards.accountID
JOIN whiteboardsAccountsMapping as wbam on wbam.whiteboardID = whiteboards.whiteboardID
JOIN accounts on accounts.accountID = wbam.accountID
WHERE accounts.username=" . SQL::Safe($GLOBALS["username"]) . "");

		$whiteboards = array();

		while($row = mysql_fetch_assoc($result))
		{
			$whiteboards[] = $row;
		}
		
		return $whiteboards;
	}
}
?>