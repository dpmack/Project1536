<?
class Courses
{
	public static function InSet($setID)
	{
		$setID = SQL::SafeInt($setID);
		
		if ($setID === false)
		{
			return false;
		}
	
		$result = SQL::SingleQuery("SELECT courses.courseID, departmentName, courseCode, displayName FROM courses
JOIN departments ON courses.departmentID = departments.departmentID
JOIN setsCoursesMapping as scm ON courses.courseID = scm.courseID
WHERE scm.setID=$setID");
		
		$courses = array();

		while($row = mysql_fetch_assoc($result))
		{
			$courses[] = $row;
		}
		return $courses;
	}

	public static function Mine()
	{
		$accountID = SQL::Safe($GLOBALS["accountID"]);
		
		if ($accountID === false)
		{
			return false;
		}
		
		$result = SQL::SingleQuery("SELECT departmentName, courses.courseID, courseCode, displayName, location, courseURL FROM courses
JOIN accountsCoursesMapping AS acm ON acm.courseID = courses.courseID
JOIN departments ON departments.departmentID = courses.departmentID
WHERE accountID=$accountID");
		
		$courses = array();

		while($row = mysql_fetch_assoc($result))
		{
			$courses[] = $row;
		}
		return $courses;
	}

	public static function HasAny($accountID)
	{
		$accountID == SQL::SafeInt($accountID);
		
		if ($accountID === false)
		{
			return false;
		}
	
		$result = SQL::SingleQuery("SELECT 1 FROM accountsCoursesMapping
WHERE accountID=$accountID");
		return mysql_num_rows($result) > 0;
	}

	public static function UpdateMyCourses($newCourses)
	{
		$accountID = SQL::SafeInt($GLOBALS['accountID']);
		
		if ($accountID === false)
		{
			return false;
		}

		$currentCourses = Courses::Mine();
		$currentCourseIDs = array();
		for ($i = 0; $i < count($currentCourses); $i++)
		{
			$currentCourseIDs[] = $currentCourses[$i]["courseID"];
		}
		
		if (count($newCourses) == 0)
		{
			return SQL::SingleQuery("DELETE FROM accountsCoursesMapping
WHERE accountID=$accountID");
		}
		
		$sql = new SQL();
		
		for ($i = 0; $i < count($currentCourseIDs); $i++)
		{	
			$courseID = SQL::SafeInt($currentCourseIDs[$i]);
			
			if ($courseID === false)
			{
				$sql->cancel();
				return;
			}
			
			if (!in_array($courseID, $newCourses))
			{
				$sql->query("DELETE FROM accountsCoursesMapping
WHERE accountID=$accountID AND courseID=$courseID");
			}
		}
		
		for ($i = 0; $i < count($newCourses); $i++)
		{
			$courseID = SQL::SafeInt($newCourses[$i]);
			
			if ($courseID === false)
			{
				$sql->cancel();
				return;
			}
			
			if ($courseID == 0)
			{
				continue;
			}
			
			if (!in_array($courseID, $currentCourseIDs))
			{
				$sql->query("INSERT INTO accountsCoursesMapping
(accountID, courseID)
VALUES ($accountID, $courseID)");
			}
		}
		
		return $sql->save();
	}

	public static function Create($departmentID, $courseCode, $courseName, $courseDesc, $location, $url, $displayName, $parentCourseID)
	{
		$departmentID = SQL::SafeInt($departmentID);
		$courseCode = SQL::SafeInt($courseCode);
		$parentCourseID = SQL::SafeInt($parentCourseID);
		
		if ($parentCourseID === false)
		{
			$parentCourseID = "NULL";
		}
		
		if ($departmentID === false || $courseCode === false)
		{
			return false;
		}
	
		return SQL::SingleQuery("INSERT INTO courses
(departmentID, courseCode, courseName, description, location, courseUrl, displayName, parentCourse)
VALUES ($departmentID, $courseCode, " . SQL::Safe($courseName) . ",
" . SQL::Safe($courseDesc) . ",
" . SQL::Safe($location) . ",
" . SQL::Safe($url) . ",
" . SQL::Safe($displayName) . ", $parentCourseID)") !== false;
	}

	public static function Update($departmentID, $courseID, $courseCode, $courseName, $courseDesc, $location, $url, $displayName, $parentCourseID)
	{
		$departmentID = SQL::SafeInt($departmentID);
		$courseID = SQL::SafeInt($courseID);
		$courseCode = SQL::SafeInt($courseCode);
		$parentCourseID = SQL::SafeInt($parentCourseID);
		
		if ($parentCourseID === false)
		{
			$parentCourseID = "NULL";
		}
		
		if ($departmentID === false || $courseID === false || $courseCode === false)
		{
			return false;
		}
	
		return SQL::SingleQuery("UPDATE courses
SET departmentID=$departmentID, 
courseCode=$courseCode,
courseName=" . SQL::Safe($courseName) . ",
description=" . SQL::Safe($courseDesc) . ",
location=" . SQL::Safe($location) . ",
courseUrl=" . SQL::Safe($url) . ",
displayName=" . SQL::Safe($displayName) . ",
parentCourse=$parentCourseID
WHERE courseID=$courseID") !== false;
	}

	public static function Info($courseID)
	{
		$courseID = SQL::SafeInt($courseID);
		
		if ($courseID === false)
		{
			return false;
		}
		
		$result = SQL::SingleQuery("SELECT courseID, courseCode, courseName, parentCourse, courseURL, displayName, description, location FROM courses
WHERE courseID=$courseID");

		if (mysql_num_rows($result) == 1)
		{
			return mysql_fetch_assoc($result);
		}
		return false;
	}

	function InDepartment($departmentID)
	{
		$departmentID = SQL::SafeInt($departmentID);
		
		if ($departmentID === false)
		{
			return false;
		}
		
		$result = SQL::SingleQuery("SELECT courseID, courseCode, displayName FROM courses
WHERE departmentID=$departmentID
ORDER BY courseCode");

		$courses = array();

		while($row = mysql_fetch_assoc($result))
		{
			$courses[] = $row;
		}
		return $courses;
	}
}
?>