<?
class Roles
{
	public static function SetRole($accountID, $roleID, $sqlPassed=false)
	{
		$sql = $sqlPassed;
		
		$accountID = SQL::SafeInt($accountID);
		$roleID = SQL::SafeInt($roleID);
		
		if ($accountID === false || $roleID === false)
		{
			return false;
		}
		
		if ($sqlPassed === false)
		{
			$sql = new SQL();
		}
	
		$sql->query("DELETE FROM accountsRolesMapping
WHERE accountID=$accountID");
		
		$sql->query("INSERT accountsRolesMapping
(accountID, roleID)
VALUES ($accountID, $roleID)");
		
		if ($sqlPassed === false)
		{
			$sql->save();
		}
	}
	
	public static function Create($roleName, $permissions)
	{
		$sql = new SQL();
	
		$sql->query("INSERT INTO `roles`
(roleName)
VALUES (" . SQL::Safe($roleName) . ")");
		
		$result = $sql->query("SELECT LAST_INSERT_ID() as roleID");
		
		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			
			Permissions::Update($data["roleID"], $permissions, $sql);
			$sql->save();
		}
		$sql->cancel();
	}

	public static function Update($roleID, $roleName, $permissions)
	{
		$roleID = SQL::SafeInt($roleID);
		
		if ($roleID === false)
		{
			return false;
		}
		
		$sql = new SQL();
	
		$sql->query("UPDATE `roles`
SET roleName=" . SQL::Safe($roleName) . "
WHERE roleID=$roleID");
		
		Permissions::Update($roleID, $permissions, $sql);
		
		$sql->save();
	}

	public static function All()
	{
		$result = SQL::SingleQuery("SELECT roleID, roleName FROM roles");
		
		$roles = array();

		while($row = mysql_fetch_assoc($result))
		{
			$roles[] = $row;
		}
		return $roles;
	}
}
?>