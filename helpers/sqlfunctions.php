<?php

function createUser($studentID, $firstName, $lastName, $email, $password)
{
	$password = generateHash($password);
	
	$sql = "INSERT INTO accounts
(firstName, lastName, username, password, email, emailConfirmed)
VALUES (\"" . mysql_real_escape_string($firstName) . "\", \"" . mysql_real_escape_string($lastName) . "\",
 \"" . strtoupper(mysql_real_escape_string($studentID)) . "\", \"" . mysql_real_escape_string($password) . "\",
\"" . mysql_real_escape_string($email) . "\", 1)";
	sql_query($sql);

	$sql = "SELECT accountID FROM accounts WHERE username = \"" . strtoupper(mysql_real_escape_string($studentID)) . "\"";
	$result = mysql_fetch_array(sql_query($sql), MYSQL_ASSOC);
	$accountID = $result['accountID'];
	
	$sql = "SELECT roleID FROM roles
WHERE roleName = 'Student'";
	$result = mysql_fetch_array(sql_query($sql), MYSQL_ASSOC);
	setRole($accountID, $result['roleID']);
	return $accountID;
}

function doesStudentIDExist($studentID)
{
	$sql = "SELECT 1 FROM accounts WHERE username = \"" . mysql_real_escape_string(strtoupper($studentID)) . "\"";
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
	$sql = "SELECT courseID, courseCode, displayName FROM courses
WHERE departmentID=$deptID
ORDER BY courseCode";
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
	$dateSplit = explode("/", $dueDate);
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
function getTopics($forumID, $first, $length)
{
	$forumID = filter_var($forumID, FILTER_VALIDATE_INT);
	if (!$forumID)
	{
		return false;
	}
	
	$end = $first + $length;
	
	$sql = "SELECT * FROM (SELECT topics.topicID, topics.accountID, title, isLocked, isSticky, posts.createdDate
FROM topics 
JOIN posts on topics.topicID = posts.topicID
WHERE forumID = $forumID
ORDER BY posts.createdDate DESC) as temp
GROUP BY temp.topicID
ORDER BY temp.createdDate DESC
LIMIT $end";
	$result = sql_query($sql);
	if ($result === false)
	{
		return false;
	}
	
	$return = array();
	$index = 0;
	while ($row = mysql_fetch_assoc($result))
	{
		if ($index >= $first)
		{
			$return[] = $row;
		}
		$index += 1;
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

function getPosts($id, $first, $length)
{
	$id = filter_var($id, FILTER_VALIDATE_INT);
	if (!$id)
	{
		return false;
	}
	
	$end = $first + $length;
	
	$sql = "SELECT postID, accountID, topicID, content, createdDate, modifiedDate 
FROM posts WHERE topicID = $id
ORDER BY createdDate ASC
LIMIT $end";
	$result = sql_query($sql);
	if ($result === false)
	{
		return false;
	}
	
	$return = array();
	$index = 0;
	while ($row = mysql_fetch_assoc($result))
	{
		if ($index >= $first)
		{
			$return[] = $row;
		}
		$index += 1;
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
	$safePost = str_replace(array("<",">","\n"),array("&lt;","&gt;","<br />"), $content); 
	
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

	$sql = "SELECT homework.homeworkID as homeworkID, courseName, title, homework.description, dueDate, !ISNULL(ham.homeworkID) as finished 
	FROM homework
	JOIN courses on homework.courseID=courses.courseID
	JOIN accountsCoursesMapping AS acm ON courses.courseID = acm.courseID
	JOIN accounts ON acm.accountID = accounts.accountID
	LEFT JOIN homeworkAccountMapping as ham on homework.homeworkID=ham.homeworkID and accounts.accountID=ham.accountID
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

function checkPassword($accountID, $currentPass)
{
	$sql = "SELECT password FROM accounts WHERE accountID = $accountID";
	$result = sql_query($sql);
	
	if (mysql_num_rows($result) == 1)
	{
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
		return checkHash($currentPass, $data["password"]);
	}
	return false;
}

function getCourseInfo($courseID)
{
	$sql = "SELECT courseID, courseCode, courseName, parentCourse, courseURL, displayName, description, location FROM courses
	WHERE courseID=$courseID";
	$result = sql_query($sql);
	
	if (mysql_num_rows($result) == 1)
	{
		return mysql_fetch_array($result, MYSQL_ASSOC);
	}
	return true;
}

function changePassword($accountID, $newPass)
{
	$password = generateHash($newPass);
	
	$sql = "UPDATE accounts 
SET password = '$password'
WHERE accountID = $accountID";

	return (boolean)sql_query($sql);
}

function createCourse($dept, $courseCode, $courseName, $courseDesc, $location, $url, $displayName, $parentCourse)
{
	$sql = "INSERT INTO courses
(departmentID, courseCode, courseName, description, location, courseUrl, displayName, parentCourse)
VALUES ($dept, $courseCode, \"" . mysql_real_escape_string($courseName) . 
"\", \"" . mysql_real_escape_string($courseDesc) . 
"\", \"" . mysql_real_escape_string($location) . 
"\", \"" . mysql_real_escape_string($url) . 
"\", \"" . mysql_real_escape_string($displayName) . 
"\", $parentCourse)";
	
	return (boolean)sql_query($sql);
}

function updateCourse($dept, $course, $courseCode, $courseName, $courseDesc, $location, $url, $displayName, $parentCourse)
{
	$sql = "UPDATE courses
SET departmentID=$dept, 
courseCode=$courseCode,
courseName=\"" . mysql_real_escape_string($courseName) . "\",
description=\"" . mysql_real_escape_string($courseDesc) . "\",
location=\"" . mysql_real_escape_string($location) . "\",
courseUrl=\"" . mysql_real_escape_string($url) . "\",
displayName=\"" . mysql_real_escape_string($displayName) . "\",
parentCourse=$parentCourse
WHERE courseID=$course";

	return (boolean)sql_query($sql);
}

function updateSetCourseMappings($setID, $courses)
{
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
		$sql = "DELETE FROM setsCoursesMapping
WHERE setID=$setID and courseID=$courseID";
		sql_query($sql);
	}
	
	foreach ($inserts as $courseID)
	{
		$sql = "INSERT INTO setsCoursesMapping
(setID, courseID)
VALUES ($setID, $courseID)";
		sql_query($sql);
	}
}

function createSet($setName, $courses)
{
	$sql = "INSERT INTO `sets`
(setName)
VALUES (\"" . mysql_real_escape_string($setName) . "\")";
	sql_query($sql);
	
	$result = sql_query("SELECT LAST_INSERT_ID() as setID");
	
	if (mysql_num_rows($result) == 1)
	{
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
		$setID = $data["setID"];
		
		updateSetCourseMappings($setID, $courses);
	}
}

function updateSet($setID, $setName, $courses)
{
	$sql = "UPDATE `sets`
SET setName=\"" . mysql_real_escape_string($setName) . "\"
WHERE setID=$setID";
	sql_query($sql);
	
	updateSetCourseMappings($setID, $courses);
}

function getSetName($setID)
{
	$sql = "SELECT setName FROM `sets`
WHERE setID=$setID";
	$result = sql_query($sql);
	
	if (mysql_num_rows($result) == 1)
	{
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
		return $data["setName"];
	}
	return false;
}

function getCoursesInSet($setID)
{
	$sql = "SELECT courses.courseID, departmentName, courseCode, displayName FROM courses
JOIN departments ON courses.departmentID = departments.departmentID
JOIN setsCoursesMapping as scm ON courses.courseID = scm.courseID
WHERE scm.setID=$setID";
	$result = sql_query($sql);
	
	$courses = array();

	while($row = mysql_fetch_assoc($result))
	{
		$courses[] = $row;
	}
	return $courses;
}

function getMyCourses()
{
	$accountID = $GLOBALS["accountID"];
	
	$sql = "SELECT departmentName, courses.courseID, courseCode, displayName, location, courseURL FROM courses
JOIN accountsCoursesMapping AS acm ON acm.courseID = courses.courseID
JOIN departments ON departments.departmentID = courses.departmentID
WHERE accountID=$accountID";
	$result = sql_query($sql);
	
	$courses = array();

	while($row = mysql_fetch_assoc($result))
	{
		$courses[] = $row;
	}
	return $courses;
}

function hasCourses($accountID)
{
	$sql = "SELECT 1 FROM accountsCoursesMapping
WHERE accountID=$accountID";
	return mysql_num_rows(sql_query($sql)) > 0;
}

function updateMyCourses($courses)
{
	$accountID = $GLOBALS['accountID'];

	$rawCurCourses = getMyCourses();
	$curCourses = array();
	for ($i = 0; $i < count($rawCurCourses); $i++)
	{
		$curCourses[] = $rawCurCourses[$i]["courseID"];
	}
	
	if (count($courses) == 0)
	{
		//delete all
		$sql = "DELETE FROM accountsCoursesMapping
WHERE accountID=$accountID";
		sql_query($sql);
		return;
	}
	
	for ($i = 0; $i < count($curCourses); $i++)
	{	
		$courseID = $curCourses[$i];
		
		if (!in_array($courseID, $courses))
		{
			//delete
			$sql = "DELETE FROM accountsCoursesMapping
WHERE accountID=$accountID AND courseID=$courseID";
			sql_query($sql);
		}
	}
	
	for ($i = 0; $i < count($courses); $i++)
	{
		$courseID = intval($courses[$i]);
		if ($courseID == 0)
		{
			continue;
		}
		
		if (!in_array($courseID, $curCourses))
		{
			//insert
			$sql = "INSERT INTO accountsCoursesMapping
(accountID, courseID)
VALUES ($accountID, $courseID)";
			sql_query($sql);
		}
	}
}

function getRoles()
{
	$sql = "SELECT roleID, roleName from roles";
	$result = sql_query($sql);
	
	$roles = array();

	while($row = mysql_fetch_assoc($result))
	{
		$roles[] = $row;
	}
	return $roles;
}

function getUsers()
{
	$sql = "SELECT roleID, accounts.accountID, firstName, lastName, username from accounts
LEFT JOIN accountsRolesMapping as arm on arm.accountID = accounts.accountID";
	$result = sql_query($sql);
	
	$users = array();

	while($row = mysql_fetch_assoc($result))
	{
		$users[] = $row;
	}
	return $users;
}

function getPermissions()
{
	$sql = "SELECT permissionID, permissionName FROM permissions";
	$result = sql_query($sql);
	
	$permissions = array();

	while($row = mysql_fetch_assoc($result))
	{
		$permissions[] = $row;
	}
	return $permissions;
}

function getPermissionsInRole($roleID)
{
	$sql = "SELECT permissions.permissionID, permissionName FROM permissions
JOIN rolesPermissionsMapping as rpm on permissions.permissionID = rpm.permissionID
WHERE rpm.roleID=$roleID";
	$result = sql_query($sql);
	
	$permissions = array();

	while($row = mysql_fetch_assoc($result))
	{
		$permissions[] = $row;
	}
	return $permissions;
}

function setRole($accountID, $roleID)
{
	$sql = "DELETE FROM accountsRolesMapping
WHERE accountID=$accountID";
	sql_query($sql);
	
	$sql = "INSERT accountsRolesMapping
(accountID, roleID)
VALUES ($accountID, $roleID)";
	sql_query($sql);
}

function updatePermissions($roleID, $permissions)
{
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
		$sql = "DELETE FROM rolesPermissionsMapping
WHERE roleID=$roleID and permissionID=$permissionID";
		sql_query($sql);
	}
	
	foreach ($inserts as $permissionID)
	{
		$sql = "INSERT INTO rolesPermissionsMapping
(roleID, permissionID)
VALUES ($roleID, $permissionID)";
		sql_query($sql);
	}
}

function createRole($roleName, $permissions)
{
	$sql = "INSERT INTO `roles`
(roleName)
VALUES (\"" . mysql_real_escape_string($roleName) . "\")";
	sql_query($sql);
	
	$result = sql_query("SELECT LAST_INSERT_ID() as roleID");
	
	if (mysql_num_rows($result) == 1)
	{
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
		$roleID = $data["roleID"];
		
		updatePermissions($roleID, $permissions);
	}
}

function updateRole($roleID, $roleName, $permissions)
{
	$sql = "UPDATE `roles`
SET roleName=\"" . mysql_real_escape_string($roleName) . "\"
WHERE roleID=$roleID";
	sql_query($sql);
	
	updatePermissions($roleID, $permissions);
}

function addAuthError()
{
	$sql = "INSERT INTO authErrors
(accountID, url, time)
VALUES (" . $GLOBALS['accountID'] . ", \"" . $_SERVER["PHP_SELF"] . "\", " . time() . ")";
	sql_query($sql);
}

function getUsersName()
{
	$sql = "SELECT firstName, lastName FROM accounts
WHERE accountID=" . $GLOBALS["accountID"];
	$result = sql_query($sql);

	if (mysql_num_rows($result) == 1)
	{
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
		return $data["firstName"] . " " . $data["lastName"];
	}
	return "";
}

function deletePost($postID)
{
	$postID = filter_var($postID, FILTER_VALIDATE_INT);
	
	if ($postID !== false)
	{
		$message = "DELETED by " . getUsersName() . " on " . date("d/m/Y - g:ia");
		
		$sql = "UPDATE posts
	SET content=\"" . mysql_real_escape_string($message) . "\"
	WHERE postID=$postID";
		$result = sql_query($sql);
		
		if ($result !== false)
		{
			return true;
		}
	}
	return false;
}

function getMyWhiteboards()
{
	$sql = "SELECT whiteboards.whiteboardID as whiteboardID, title, CONCAT(owner.firstName, ', ', owner.lastName) as authorName FROM whiteboards
	JOIN accounts as owner on owner.accountID = whiteboards.accountID
	JOIN whiteboardsaccountsmapping as wbam on wbam.whiteboardID = whiteboards.whiteboardID
	JOIN accounts on accounts.accountID = wbam.accountID
	WHERE accounts.username='" . $GLOBALS["username"] . "'";
	$result = sql_query($sql);

	$whiteboards = array();

	while($row = mysql_fetch_assoc($result))
	{
		$whiteboards[] = $row;
	}
	
	return $whiteboards;
}

function addUserToWhiteboard($whiteboardID, $userID)
{
	$sql = "INSERT INTO whiteboardsAccountsMapping (whiteboardID, accountID)
VALUES ($whiteboardID, $userID)";
	sql_query($sql);
}

function createWhiteboard($title)
{
	$sql = "INSERT INTO whiteboards (title, accountID)
VALUES ('" . mysql_real_escape_string($title) . "', " . $GLOBALS["accountID"] . ");";
	sql_query($sql);
	
	$result = sql_query("SELECT LAST_INSERT_ID() as whiteboardID");
	
	if (mysql_num_rows($result) == 1)
	{
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
		$whiteboardID = $data["whiteboardID"];
		
		addUserToWhiteboard($whiteboardID, $GLOBALS["accountID"]);
		
		mkdir("whiteboards\\boards\\" . $whiteboardID);
		file_put_contents("whiteboards\\boards\\" . $whiteboardID . "\\pages.json", '["Default"]');
	}
}

function getAccountIDOf($username)
{
	$sql = "SELECT accountID from accounts
WHERE username=\"" . strtoupper(mysql_real_escape_string($username)) . "\"";
	$result = sql_query($sql);
	
	if (mysql_num_rows($result) == 1)
	{
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
		return $data["accountID"];
	}
	return false;
}

function isOwnerOfWhiteboard($whiteboardID, $accountID)
{
	$sql = "SELECT 1 from whiteboards
WHERE accountID=$accountID and whiteboardID=$whiteboardID";
	$result = sql_query($sql);
	
	if (mysql_num_rows($result) == 1)
	{
		return true;
	}
	return false;
}

?>