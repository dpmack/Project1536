<?
class Permissions
{
	public static function Update($roleID, $permissions, $sqlPassed)
	{
		$roleID = SQL::SafeInt($roleID);
		
		if ($roleID === false)
		{
			return false;
		}
		
		$sql = $sqlPassed;
		if ($sqlPassed === false)
		{
			$sql = new SQL();
		}
		
		$deletes = array();
		$inserts = array();
		foreach ($permissions as $permission)
		{
			if ($permission["status"] == "new")
			{
				$inserts[] = $permission["permissionID"];
			}
			else if ($permission["status"] == "deleted")
			{
				$deletes[] = $permission["permissionID"];
			}
		}
		
		foreach ($deletes as $permissionID)
		{
			$permissionID = SQL::SafeInt($permissionID);
			
			if ($permissionID === false)
			{
				$sql->cancel();
				return false;
			}
			
			$sql->query("DELETE FROM rolesPermissionsMapping
WHERE roleID=$roleID and permissionID=$permissionID");
		}
		
		foreach ($inserts as $permissionID)
		{
			$permissionID = SQL::SafeInt($permissionID);
			
			if ($permissionID === false)
			{
				$sql->cancel();
				return false;
			}
			
			$sql->query("INSERT INTO rolesPermissionsMapping
(roleID, permissionID)
VALUES ($roleID, $permissionID)");
		}
		
		if ($sqlPassed === false)
		{
			$sql->save();
		}
	}

	public static function All()
	{
		$result = SQL::SingleQuery("SELECT permissionID, permissionName FROM permissions");
		
		$permissions = array();

		while($row = mysql_fetch_assoc($result))
		{
			$permissions[] = $row;
		}
		return $permissions;
	}

	public static function InRole($roleID)
	{
		$roleID = SQL::SafeInt($roleID);
		
		if ($roleID === false)
		{
			return false;
		}
		
		$result = SQL::SingleQuery("SELECT permissions.permissionID, permissionName FROM permissions
JOIN rolesPermissionsMapping as rpm on permissions.permissionID = rpm.permissionID
WHERE rpm.roleID=$roleID");

		$permissions = array();

		while($row = mysql_fetch_assoc($result))
		{
			$permissions[] = $row;
		}
		return $permissions;
	}

	public static function Has($permission)
	{
		if (!$GLOBALS['loggedIn'])
		{
			return false;
		}
		
		$permission = SQL::Safe($permission);
		
		$result = SQL::SingleQuery("SELECT 1
FROM permissions
JOIN rolesPermissionsMapping as rpm on permissions.permissionID = rpm.permissionID
JOIN roles on rpm.roleID = roles.roleID
JOIN accountsRolesMapping as arm on roles.roleID = arm.roleID
JOIN accounts on arm.accountID = accounts.accountID
WHERE accounts.username=" . SQL::Safe($GLOBALS['username']) . " and permissions.permissionName=$permission");

		return (mysql_num_rows($result) > 0);
	}
}

?>