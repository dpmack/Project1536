<?
class Departments
{
	public static function All()
	{
		$result = SQL::SingleQuery("SELECT departmentID, departmentName
									FROM departments");

		$departments = array();
		while($row = mysql_fetch_assoc($result))
		{
			$departments[] = $row;
		}
		return $departments;
	}

	public static function Create($name)
	{
		return SQL::SingleQuery("INSERT INTO departments
(departmentName)
VALUES (" . SQL::Safe($name) . ")") !== false;
	}

	public static function Rename($departmentID, $name)
	{
		$departmentID = SQL::SafeInt($departmentID);
		
		if ($departmentID === false)
		{
			return false;
		}
		
		return SQL::SingleQuery("UPDATE departments
SET departmentName=". SQL::Safe($name) . "
WHERE departmentID=$departmentID") !== false;
	} 
}
?>