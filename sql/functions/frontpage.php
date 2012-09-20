<?
class FrontPage
{
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