<?
class Forums
{
	public static function All()
	{
		$result = SQL::SingleQuery("SELECT forumID, forumTitle
									FROM forums
									ORDER BY `order` ASC");
		
		$fourms = array();
		
		while ($row = mysql_fetch_assoc($result))
		{
			$fourms[] = $row;
		}
		
		return $fourms;
	}
	
	public static function AllTopLevel()
	{
		$result = SQL::SingleQuery("SELECT forumID, forumTitle, (SELECT count(1)
																 FROM forums AS forumsCount
																 JOIN forums AS subForums ON forumsCount.forumID = subForums.parentForumID
																 WHERE forumsCount.forumID = forums.forumID) AS hasSubForum
									FROM forums
									WHERE parentForumID IS NULL
									ORDER BY `order` ASC");
		
		$fourms = array();
		
		while ($row = mysql_fetch_assoc($result))
		{
			$fourms[] = $row;
		}
		
		return $fourms;
	}
	
	public static function ForumsOF($forumID)
	{
		$forumID = SQL::SafeInt($forumID);
		
		if ($forumID === false)
		{
			return false;
		}
		
		$result = SQL::SingleQuery("SELECT subForums.forumID, subForums.forumTitle, (SELECT count(1)
																 FROM forums AS forumsCount
																 JOIN forums AS subForums ON forumsCount.forumID = subForums.parentForumID
																 WHERE forumsCount.forumID = subForums.forumID) AS hasSubForum
									FROM forums
									LEFT JOIN forums AS subForums ON forums.forumID = subForums.parentForumID
									WHERE forums.forumID = $forumID
									ORDER BY subForums.`order` ASC");
		
		$fourms = array();
		while ($row = mysql_fetch_assoc($result))
		{
			$fourms[] = $row;
		}
		
		return $fourms;
	}

	public static function Info($forumID)
	{
		$forumID = SQL::SafeInt($forumID);
		
		if ($forumID === false)
		{
			return false;
		}
		
		$result = SQL::SingleQuery("SELECT forums.forumTitle, parentForumID, (SELECT count(1)
														FROM forums AS forumsCount
														JOIN forums AS subForums ON forumsCount.forumID = subForums.parentForumID
														WHERE forumsCount.forumID = subForums.forumID) AS hasSubForum
									FROM forums
									WHERE forums.forumID=$forumID");
		
		if (mysql_num_rows($result) == 1)
		{
			return mysql_fetch_assoc($result);
		}
		return false;
	}
	
	public static function News()
	{
		$NEWS_FORUM = "News";
		$result = SQL::SingleQuery("SELECT * FROM (SELECT posts.topicID, topics.title, posts.content, posts.createdDate FROM posts
JOIN topics on posts.topicID = topics.topicID
JOIN forums on topics.forumID = forums.forumID
WHERE forums.forumTitle=" . SQL::Safe($NEWS_FORUM) . "
ORDER BY posts.createdDate ASC) as temp
GROUP BY temp.topicID
ORDER BY temp.createdDate DESC");

		$news = array();

		while($row = mysql_fetch_assoc($result))
		{
			$news[] = $row;
		}
		return $news;
	}
}
?>