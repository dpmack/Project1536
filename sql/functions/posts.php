<?
class Posts
{
	public static function Delete($postID)
	{
		$postID = SQL::SafeInt($postID);
		
		if ($postID === false)
		{
			return false;
		}
		
		$message = "DELETED by " . Accounts::CurrentUsersName() . " on " . date("d/m/Y - g:ia");
			
		return SQL::SingleQuery("UPDATE posts
SET content=" . SQL::Safe($message) . "
WHERE postID=$postID");
	}

	public static function FromAccount($accountID)
	{
		$accountID = SQL::SafeInt($accountID);
		
		if ($accountID === false)
		{
			return false;
		}
		
		$result = SQL::SingleQuery("SELECT COUNT(postID) as postCount FROM posts
WHERE accountID=$accountID");
		
		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			return $data["postCount"];
		}
		return 0;
	}
	
	public static function Create($topicID, $content)
	{
		$topicID = SQL::SafeInt($topicID);
		
		if ($topicID === false)
		{
			return false;
		}
	
		$safePost = (Permissions::Has("POST_HTML"))? $content : HTML::Safe($content);
		
		$accountID = $GLOBALS['accountID'];
		$now = time();
		
		SQL::SingleQuery("INSERT INTO posts
(accountID, topicID, createdDate, content)
VALUES ($accountID, $topicID, $now, " . SQL::Safe($safePost) . ")");
	}

	public static function Single($postID)
	{
		$postID = SQL::SafeInt($postID);
		
		if ($postID === false)
		{
			return false;
		}
		
		$result = SQL::SingleQuery("SELECT content FROM posts
WHERE postID=$postID");

		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			return $data["content"];
		}
		return false;
	}

	public static function Edit($postID, $content)
	{
		$postID = SQL::SafeInt($postID);
		
		if ($postID === false)
		{
			return false;
		}
		
		$sql = new SQL();
		
		if (!Permissions::Has("ADMIN_EDIT_POST"))
		{
			if (!Permissions::Has("EDIT_POST"))
			{
				return false;
			}
			
			$result = $sql->query("SELECT accountID FROM posts
WHERE postID=$postID");
		
			if (mysql_num_rows($result) == 1)
			{
				$data = mysql_fetch_assoc($result);
				if ($data["accountID"] != $GLOBALS["accountID"])
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
	
		$safePost = (Permissions::Has("POST_HTML"))? $content : HTML::Safe($content);
		
		$now = time();
		
		$sql->query("UPDATE posts
SET modifiedDate=$now, content=\"" . SQL::Safe($safePost) . "\"
WHERE postID=$postID");
		$sql->save();
	}

	public static function CountInForum($forumID)
	{
		$forumID = SQL::SafeInt($forumID);
		
		if ($forumID === false)
		{
			return false;
		}
	
		$result = SQL::SingleQuery("SELECT COUNT(postID) as postCount FROM posts
JOIN topics on posts.topicID=topics.topicID
WHERE topics.forumID=$forumID");
		
		if (mysql_num_rows($result) == 1)
		{
			$data = mysql_fetch_assoc($result);
			return $data["postCount"];
		}
		return 0;
	}

	public static function InTopic($topicID, $first, $length)
	{
		$topicID = SQL::SafeInt($topicID);
		$first = SQL::SafeInt($first);
		$length = SQL::SafeInt($length);
		
		if ($topicID === false || $first === false || $length === false)
		{
			return false;
		}
		
		$end = $first + $length;
		
		$result = SQL::SingleQuery("SELECT postID, accountID, topicID, content, createdDate, modifiedDate 
FROM posts WHERE topicID = $topicID
ORDER BY createdDate ASC
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
}
?>