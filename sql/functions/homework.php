<?
class Homework
{
	public static function All()
	{
		$result = SQL::SingleQuery("SELECT homeworkID, courseName, title, description, dueDate 
FROM homework");

		$homework = array();

		while($row = mysql_fetch_assoc($result))
		{
			$homework[] = $row;
		}
		
		return $homework;
	}
	
	public static function Mine()
	{
		$hiddenDate = time() - 60*60*24*3;

		$result = SQL::SingleQuery("SELECT homework.homeworkID as homeworkID, courseName, title, homework.description, dueDate, !ISNULL(ham.homeworkID) as finished 
FROM homework
JOIN courses on homework.courseID=courses.courseID
JOIN accountsCoursesMapping AS acm ON courses.courseID = acm.courseID
JOIN accounts ON acm.accountID = accounts.accountID
LEFT JOIN homeworkAccountMapping as ham on homework.homeworkID=ham.homeworkID and accounts.accountID=ham.accountID
WHERE accounts.username=" . SQL::Safe($GLOBALS['username']) . " and
dueDate > " . $hiddenDate . " 
ORDER BY duedate ASC");

		$homework = array();

		while($row = mysql_fetch_assoc($result))
		{
			$homework[] = $row;
		}
		
		return $homework;
	}

	public static function Add($courseID, $title, $description, $dueDate)
	{	
		$courseID = SQL::SafeInt($courseID);
		
		if ($courseID === false)
		{
			return false;
		}
		
		$dateSplit = explode("/", $dueDate);
		$dueDate = mktime(23,59,59,$dateSplit[0], $dateSplit[1], $dateSplit[2]);

		SQL::SingleQuery("INSERT INTO homework
(courseID, title, description, dueDate)
VALUES ($courseID, " . SQL::Safe($title) . ", " . SQL::Safe($description) . ", $dueDate);");
	}
	
	public static function Status($accountID, $homeworkID)
	{
		$homeworkID = SQL::SafeInt($homeworkID);
		$accountID = SQL::SafeInt($accountID);
		
		if ($homeworkID === false || $accountID === false)
		{
			return false;
		}
		
		$result = SQL::SingleQuery("SELECT !ISNULL(ham.homeworkID) as finished
									FROM homework
									JOIN courses on homework.courseID=courses.courseID
									LEFT JOIN homeworkAccountMapping as ham on homework.homeworkID=ham.homeworkID
									WHERE ham.accountID=$accountID AND homework.homeworkID=$homeworkID");
		
		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			return $data["finished"];
		}
		return false;
	}
	
	public static function SetDone($accountID, $homeworkID)
	{
		$homeworkID = SQL::SafeInt($homeworkID);
		$accountID = SQL::SafeInt($accountID);
		
		if ($homeworkID === false || $accountID === false)
		{
			return false;
		}
		
		$result = SQL::SingleQuery("INSERT INTO homeworkAccountMapping
									VALUES ($homeworkID, $accountID)");
		return ($result !== false);
	}
	
	public static function SetNotDone($accountID, $homeworkID)
	{
		$homeworkID = SQL::SafeInt($homeworkID);
		$accountID = SQL::SafeInt($accountID);
		
		if ($homeworkID === false || $accountID === false)
		{
			return false;
		}
		$result = SQL::SingleQuery("DELETE FROM homeworkAccountMapping
									WHERE accountID=$accountID AND homeworkID=$homeworkID");
		return ($result !== false);
	}
}

?>