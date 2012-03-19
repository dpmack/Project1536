<?php

function createUser($studentID, $firstName, $lastName, $email, $password)
{
	$password = generateHash($password);
	
	$sql = "INSERT INTO accounts
(firstName, lastName, username, password, email, emailConfirmed)
VALUES (\"" . mysql_real_escape_string($firstName) . "\", \"" . mysql_real_escape_string($lastName) . "\",
 \"" . mysql_real_escape_string($studentID) . "\", \"" . mysql_real_escape_string($password) . "\",
\"" . mysql_real_escape_string($email) . "\", 1)";
	sql_query($sql);

	$sql = "SELECT accountID FROM accounts WHERE username = \"" . mysql_real_escape_string($studentID) . "\"";
	$result = mysql_fetch_array(sql_query($sql), MYSQL_ASSOC);
	return $result['accountID'];
}

function doesStudentIDExist($studentID)
{
	$sql = "SELECT 1 FROM accounts WHERE username = \"" . mysql_real_escape_string($studentID) . "\"";
	return (mysql_num_rows(sql_query($sql)) > 0);
}

function cleanEmailConfirms()
{
	sql_query("DELETE FROM confirmationEmails
WHERE expire < " . time());
}

function deleteEmailConfirmFor($accountID)
{	
	sql_query("DELETE FROM confirmationEmails
WHERE accountID = " . $accountID);
}

function createNewEmailConfirm($accountID)
{
	$MAX_TIME_EMAIL_CONFIRM = 60*60*24;
	
	cleanEmailConfirms();

	deleteEmailConfirmFor($accountID);

	do
	{
		$hash = sha1(uniqid("",true));
	}
	while (mysql_num_rows(sql_query("SELECT 1 FROM confirmationEmails WHERE hash='" . $hash . "'")) > 0);

	$sql = "INSERT INTO confirmationEmails
(hash, accountID, expire)
VALUES (\"" . $hash . "\", " . $accountID . ", " . (time() + $MAX_EMAIL_CONFIRM) . ")";
	sql_query($sql);
	
	$sql = "SELECT email FROM accounts
WHERE accountID=" . $accountID;
	$result = mysql_fetch_array(sql_query($sql), MYSQL_ASSOC);
	
	return array($result["email"], $hash);
}

function createDepartment($deptName)
{
	$sql = "INSERT INTO departments
	(departmentName)
	VALUES (\"" . mysql_real_escape_string($deptName) . "\")";
	sql_query($sql);		
}

function renameDepartment($dept, $deptName)
{
	$sql = "UPDATE departments
	SET departmentName=\"". mysql_real_escape_string($deptName) . "\"
	WHERE departmentID=$dept";	
	sql_query($sql);		
} 


function getAccountForEmailConfirm($hash)
{
	cleanEmailConfirms();
	
	$sql = "SELECT accountID FROM confirmationEmails
WHERE hash=\"" . mysql_real_escape_string($hash) . "\"";
	$result = sql_query($sql);
	
	if (mysql_num_rows($result) == 1)
	{
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
		return $data["accountID"];
	}
	return -1;
}

function confirmAccount($accountID)
{
	sql_query("UPDATE accounts
SET emailConfirmed=1
WHERE accountID = " . $accountID);

	deleteEmailConfirmFor($accountID);
}

function getDepartments()
{
	$sql = "SELECT departmentID, departmentName FROM departments";
	$result = sql_query($sql);

	$departments = array();

	while($row = mysql_fetch_assoc($result))
	{
		$departments[] = $row;
	}
	return $departments;
}

function getSets()
{
	$sql = "SELECT setID, setName FROM sets";
	$result = sql_query($sql);

	$sets = array();

	while($row = mysql_fetch_assoc($result))
	{
		$sets[] = $row;
	}
	return $sets;
}

function getCourses($deptID)
{
	$sql = "SELECT courseID, courseCode FROM courses WHERE departmentID=$deptID";
	$result = sql_query($sql);

	$courses = array();

	while($row = mysql_fetch_assoc($result))
	{
		$courses[] = $row;
	}
	return $courses;
}


function addHomeworkAssignment($course, $title, $desc, $dueDate)
{	
	$dateSplit = split("/", $dueDate);
	$dueDate = mktime(23,59,59,$dateSplit[0], $dateSplit[1], $dateSplit[2]);

	$sql = "INSERT INTO homework
(courseID, title, description, dueDate)
VALUES ($course, \"" . mysql_real_escape_string($title) . "\", \"" . mysql_real_escape_string($desc) . "\", $dueDate);";
	sql_query($sql);
}

// Returns false on error
function getForums()
{
	$sql = "SELECT forumID, forumTitle FROM forums";
	$result = sql_query($sql);
	if ($result === false)
	{
		return false;
	}
	
	$return = array();
	
	while ($row = mysql_fetch_assoc($result))
	{		
		if ($row === false)
		{
			return false;
		}
		
		$return[] = $row;
	}
	
	return $return;
}

// Returns false on error
function getTopics($id)
{
	$id = filter_var($id, FILTER_VALIDATE_INT);
	if (!$id)
	{
		return false;
	}
	
	$sql = "SELECT topicID, accountID, title, isLocked, isSticky 
	FROM topics WHERE forumID = $id";
	$result = sql_query($sql);
	if ($result === false)
	{
		return false;
	}
	
	$return = array();
	
	while ($row = mysql_fetch_assoc($result))
	{
		if ($row === false)
		{
			return false;
		}
		
		$return[] = $row;
	}
	
	return $return;		
}

// returns false on error or if account does not exist
function getNamesByAccountID($id)
{
	$id = filter_var($id, FILTER_VALIDATE_INT);
	if (!$id)
	{
		return false;
	}
	
	$sql = "SELECT firstName, lastName FROM accounts WHERE accountID = $id";
	$result = sql_query($sql);
	if ($result === false)
	{
		return false;
	}
	
	return mysql_fetch_assoc($result);	
}

function getPosts($id)
{
	$id = filter_var($id, FILTER_VALIDATE_INT);
	if (!$id)
	{
		return false;
	}
	
	$sql = "SELECT postID, accountID, topicID, content, createdDate, modifiedDate 
	FROM posts WHERE topicID = $id";
	$result = sql_query($sql);
	if ($result === false)
	{
		return false;
	}
	
	$return = array();
	
	while ($row = mysql_fetch_assoc($result))
	{
		if ($row === false)
		{
			return false;
		}
		
		$return[] = $row;
	}
	
	return $return;	
}

function getNews()
{
	$NEWS_FORUM = "News";
	$sql = "SELECT * FROM (SELECT posts.topicID, topics.title, posts.content, posts.createdDate FROM posts
JOIN topics on posts.topicID = topics.topicID
JOIN forums on topics.forumID = forums.forumID
WHERE forums.forumTitle=\"$NEWS_FORUM\"
ORDER BY posts.createdDate ASC) as temp
GROUP BY temp.topicID
ORDER BY temp.createdDate DESC";
	$result = sql_query($sql);

	$news = array();

	while($row = mysql_fetch_assoc($result))
	{
		$news[] = $row;
	}
	return $news;
}

function getRecentActivity()
{
	$sql = "SELECT * FROM (SELECT topics.topicID, topics.title, posts.createdDate FROM posts
JOIN topics on posts.topicID = topics.topicID
ORDER BY posts.createdDate DESC) as temp
GROUP BY temp.topicID
ORDER BY temp.createdDate DESC
LIMIT 0, 5";
	$result = sql_query($sql);

	$recent = array();

	while($row = mysql_fetch_assoc($result))
	{
		$recent[] = $row;
	}
	return $recent;
}

function getTopicCount($forumID)
{
	$sql = "SELECT count(topicID) as topicCount FROM topics
WHERE topics.forumID=$forumID";
	$result = sql_query($sql);
	
	if (mysql_num_rows($result) == 1)
	{
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
		return $data["topicCount"];
	}
	return 0;
}

function getPostCount($forumID)
{
	$sql = "SELECT COUNT(postID) as postCount FROM posts
JOIN topics on posts.topicID=topics.topicID
WHERE topics.forumID=$forumID";
	$result = sql_query($sql);
	
	if (mysql_num_rows($result) == 1)
	{
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
		return $data["postCount"];
	}
	return 0;
}

function getPostCountFromTopic($topicID)
{
	$sql = "SELECT COUNT(postID) as postCount FROM posts
WHERE topicID=$topicID";
	$result = sql_query($sql);
	
	if (mysql_num_rows($result) == 1)
	{
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
		return $data["postCount"];
	}
	return 0;
}

function getForumInfo($forumID)
{
	$forumID = filter_var($forumID, FILTER_VALIDATE_INT);
	if (!$forumID)
	{
		return false;
	}
	
	$sql = "SELECT forumTitle FROM forums
WHERE forums.forumID=$forumID";
	$result = sql_query($sql);
	
	if (mysql_num_rows($result) == 1)
	{
		return mysql_fetch_array($result, MYSQL_ASSOC);
	}
	return false;
}

function getTopicInfo($topicID)
{
	$topicID = filter_var($topicID, FILTER_VALIDATE_INT);
	if (!$topicID)
	{
		return false;
	}
	
	$sql = "SELECT title, forumID FROM topics
WHERE topics.topicID=$topicID";
	$result = sql_query($sql);
	
	if (mysql_num_rows($result) == 1)
	{
		return mysql_fetch_array($result, MYSQL_ASSOC);
	}
	return false;
}

function createPost($topicID, $content)
{
	$safePost = str_replace(array("<",">"),array("&lt;","&gt;"), $content); 
	
	$topicID = filter_var($topicID, FILTER_VALIDATE_INT);
	$accountID = $GLOBALS['accountID'];
	$now = time();
	
	$sql = "INSERT INTO posts
(accountID, topicID, createdDate, content)
VALUES ($accountID, $topicID, $now, \"" . mysql_real_escape_string($safePost) . "\")";
	sql_query($sql);
}

function createTopic($forumID, $title)
{	

	$forumID = filter_var($forumID, FILTER_VALIDATE_INT);
	$forumData = getForumInfo($forumID);
	
	if ($forumData["forumTitle"] == "News")
	{
		return false;
	}
	
	$accountID = $GLOBALS['accountID'];
	
	sql_query("INSERT INTO topics
(accountID, forumID, title)
VALUES ($accountID, $forumID, \"" . mysql_real_escape_string($title) . "\")");
	$result = sql_query("SELECT LAST_INSERT_ID() as topicID");
	
	if (mysql_num_rows($result) == 1)
	{
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
		return $data["topicID"];
	}
	return false;
}

function getHomework()
{
	$hiddenDate = time() - 60*60*24*3;

	$sql = "SELECT homework.homeworkID as homeworkID, courseName, title, description, dueDate, !ISNULL(ham.homeworkID) as finished 
	FROM homework
	JOIN courses on homework.courseID=courses.courseID
	JOIN accounts
	LEFT JOIN homeworkaccountmapping as ham on homework.homeworkID=ham.homeworkID and accounts.accountID=ham.accountID
	WHERE accounts.username='" . $GLOBALS['username'] . "' and
	dueDate > " . $hiddenDate . " 
	ORDER BY duedate ASC";
	
	$result = sql_query($sql);

	$homework = array();

	while($row = mysql_fetch_assoc($result))
	{
		$homework[] = $row;
	}
	
	return $homework;
}

function getUserPosts($userID)
{
	$sql = "SELECT COUNT(postID) as postCount FROM posts
WHERE accountID=$userID";
	$result = sql_query($sql);
	
	if (mysql_num_rows($result) == 1)
	{
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
		return $data["postCount"];
	}
	return 0;
}

?>