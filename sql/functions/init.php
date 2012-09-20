<?php

class HTML
{
	public static function Safe($content)
	{
		return str_replace(array("<",">","\n"),array("&lt;","&gt;","<br />"), $content);
	}
	
	public static function SafeEdit($content)
	{
		return str_replace(array("&lt;","&gt;","<br />"), array("<",">","\n"), $content);
	}
}

include "sql/functions/admin.php";
include "sql/functions/accounts.php";
include "sql/functions/courses.php";
include "sql/functions/departments.php";
include "sql/functions/email.php";
include "sql/functions/forums.php";
include "sql/functions/homework.php";
include "sql/functions/permissions.php";
include "sql/functions/posts.php";
include "sql/functions/roles.php";
include "sql/functions/sets.php";
include "sql/functions/topics.php";
include "sql/functions/whiteboards.php";
include "sql/functions/frontpage.php";

?>