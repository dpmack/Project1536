<?
class Sets
{
	public static function UpdateCourses($setID, $courses, $sqlPassed=false)
	{
		$setID = SQL::SafeInt($setID);
		
		if ($setID === false)
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
		foreach ($courses as $course)
		{
			if ($course["status"] == "new")
			{
				$inserts[] = $course["courseID"];
			}
			else if ($course["status"] == "deleted")
			{
				$deletes[] = $course["courseID"];
			}
		}
		
		foreach ($deletes as $courseID)
		{
			$courseID = SQL::SafeInt($courseID);
			
			if ($courseID === false)
			{
				$sql->cancel();
				return false;
			}
			
			$sql->query("DELETE FROM setsCoursesMapping
WHERE setID=$setID and courseID=$courseID");
		}
		
		foreach ($inserts as $courseID)
		{
			$courseID = SQL::SafeInt($courseID);
			
			if ($courseID === false)
			{
				$sql->cancel();
				return false;
			}
			
			$sql->query("INSERT INTO setsCoursesMapping
(setID, courseID)
VALUES ($setID, $courseID)");
		}
		
		if ($sqlPassed === false)
		{
			return $sql->save();
		}
	}

	public static function Create($setName, $courses)
	{
		$sql = new SQL();
		
		$sql->query("INSERT INTO `sets`
(setName)
VALUES (" . SQL::Safe($setName) . ")");
		
		$result = $sql->query("SELECT LAST_INSERT_ID() as setID");
		
		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			
			Sets::UpdateCourses($data["setID"], $courses, $sql);
			
			return $sql->save();
		}
		$sql->cancel();
		return false;
	}

	public static function Update($setID, $setName, $courses)
	{
		$setID = SQL::SafeInt($setID);
		
		if ($setID === false)
		{
			return false;
		}
		
		$sql = new SQL();
	
		$sql->query("UPDATE `sets`
SET setName=" . SQL::Safe($setName) . "
WHERE setID=$setID");
		
		Sets::UpdateCourses($setID, $courses, $sql);
		
		return $sql->save();
	}

	public static function Name($setID)
	{
		$setID = SQL::SafeInt($setID);
		
		if ($setID === false)
		{
			return false;
		}
	
		$result = SQL::SingleQuery("SELECT setName FROM `sets`
WHERE setID=$setID");
		
		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			return $data["setName"];
		}
		return false;
	}

	public static function All()
	{
		$result = SQL::SingleQuery("SELECT setID, setName FROM sets");

		$sets = array();

		while($row = mysql_fetch_assoc($result))
		{
			$sets[] = $row;
		}
		return $sets;
	}
}
?>