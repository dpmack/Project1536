<?
class Topics
{
	public static function InForum($forumID, $first, $length)
	{
		$forumID = SQL::SafeInt($forumID);
		$first = SQL::SafeInt($first);
		$length = SQL::SafeInt($length);
		
		if ($forumID === false || $first === false || $length === false)
		{
			return false;
		}
		
		$end = $first + $length;
		
		$result = SQL::SingleQuery("SELECT * FROM (SELECT topics.topicID, topics.accountID, title, isLocked, isSticky, posts.createdDate
FROM topics 
JOIN posts on topics.topicID = posts.topicID
WHERE forumID = $forumID
ORDER BY posts.createdDate DESC) as temp
GROUP BY temp.topicID
ORDER BY temp.createdDate DESC
LIMIT $end");
		
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
	
	public static function CountInForum($forumID)
	{
		$forumID = SQL::SafeInt($forumID);
		
		if ($forumID === false)
		{
			return false;
		}
	
		$result = SQL::SingleQuery("SELECT count(topicID) as topicCount FROM topics
WHERE topics.forumID=$forumID");
		
		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			return $data["topicCount"];
		}
		return 0;
	}

	public static function CountPosts($topicID)
	{
		$topicID = SQL::SafeInt($topicID);
		
		if ($topicID === false)
		{
			return false;
		}
	
		$result = SQL::SingleQuery("SELECT COUNT(postID) as postCount FROM posts
WHERE topicID=$topicID");
		
		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			return $data["postCount"];
		}
		return 0;
	}
	
	public static function Info($topicID)
	{
		$topicID = SQL::SafeInt($topicID);
		
		if ($topicID === false)
		{
			return false;
		}
		
		$result = SQL::SingleQuery("SELECT title, forumID FROM topics
WHERE topics.topicID=$topicID");
		
		if (mysql_num_rows($result) == 1)
		{
			return mysql_fetch_assoc($result);
		}
		return false;
	}

	public static function Create($forumID, $title)
	{	
		$forumID = SQL::SafeInt($forumID);
		
		$forumData = Forums::Info($forumID);
		
		if ($forumData["forumTitle"] == "News" && !Permissions::Has("START_TOPIC_NEWS"))
		{
			return false;
		}
		
		$accountID = $GLOBALS['accountID'];
		
		$sql = new SQL();
		
		$sql->query("INSERT INTO topics
(accountID, forumID, title)
VALUES ($accountID, $forumID, " . SQL::Safe($title) . ")");
	
		$result = $sql->query("SELECT LAST_INSERT_ID() as topicID");
		
		if (mysql_num_rows($result) == 1)
		{
			$sql->save();
			$data = mysql_fetch_assoc($result);
			return $data["topicID"];
		}
		
		$sql->cancel();
		return false;
	}
	
	public static function RecentActivity()
	{
		$result = SQL::SingleQuery("SELECT * FROM (SELECT topics.topicID, topics.title, posts.createdDate FROM posts
JOIN topics on posts.topicID = topics.topicID
ORDER BY posts.createdDate DESC) as temp
GROUP BY temp.topicID
ORDER BY temp.createdDate DESC
LIMIT 0, 5");

		$recent = array();

		while($row = mysql_fetch_assoc($result))
		{
			$recent[] = $row;
		}
		return $recent;
	}
}
?>