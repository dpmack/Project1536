<?php
include "config/current.config";

$GLOBALS["sql_debug"] = (isset($_GET["vancerocks"])? $_GET["vancerocks"] : $sqlDebugMode);
$GLOBALS["sql_debug_buffer"] = "";

class SQL
{
	private $live = false;
	public $transactionLink = false;
	public static $Link = false;
	
	public function __construct()
	{
		if ($this->transactionLink === false)
		{
			$this->transactionLink = SQL::Connect();
		}
		
		if ($this->transactionLink)
		{
			$this->live = true;
			$this->begin();
		}
	}
	
	public function __destruct()
	{
		$this->cancel();
	}
	
	private function close()
	{
		$this->live = false;
		if ($this->transactionLink)
		{
			mysql_close($this->transactionLink);
		}
		$this->transactionLink = false;
	}
	
	private static function Connect()
	{
		global $sqlHost;
		global $sqlUser;
		global $sqlPassword;
		global $sqlDB;
		
		$link = mysql_connect($sqlHost, $sqlUser, $sqlPassword, true);
		if (!$link) {
			$error = ($GLOBALS["sql_debug"] > 0)? "<br /><br />Not connected : " . mysql_error($link) : "";
			include "errors/somethingwentwrong.php";
			die();
		}

		$db_selected = mysql_select_db($sqlDB, $link);
		if (!$db_selected) {
			$link = false;
			$error = ($GLOBALS["sql_debug"] > 0)? "Can't use $sqlDB : " . mysql_error($link) : "";
			include "errors/somethingwentwrong.php";
			die();
		}
		return $link;
	}
	
	public function query($query)
	{
		if ($this->live)
		{
			return SQL::DoQuery($query, $this->transactionLink, $this);
		}
	}

	public static function SingleQuery($query)
	{
		if (self::$Link === false)
		{
			self::$Link = SQL::Connect();
		}
		return SQL::DoQuery($query, self::$Link);
	}
	
	private static function Error($query, $errorLink, $sqlInstance)
	{
		$linkErrorMessage = mysql_error($errorLink);
		
		$link = SQL::Connect();
		$result = mysql_query("INSERT INTO errors
(time,message,comment)
VALUES(NOW(), " . SQL::Safe($linkErrorMessage) . ", " . SQL::Safe($query) . ")", $link);
		mysql_close($link);
		
		if (!$result)
		{
			if ($GLOBALS["sql_debug"] > 0)
			{
				$error  = "Error saving error: <br />\n";
				$error .= "Invalid query: " . mysql_error($link) . "<br />\n";
				$error .= "Whole query: " . $query . "<br />\n<br />\n";
				$error .= "First error: <br />\n";
				$error .= "Invalid query: <br />\n . $linkErrorMessage . <br />\n<br />\n";
				$error .= "Whole query: <br />\n" . str_replace("\n","<br />\n",$query);
			}
			else
			{
				$error = "";
			}
			include "errors/somethingwentwrong.php";
		}
		else
		{
			$error = "Something went wrong. Please try again, if the problem persists contact the site administrator.";
			if ($GLOBALS['sql_debug'] >= 1)
			{
				$error .= "<br />\nInvalid query: <br />\n$linkErrorMessage<br />\n<br />\n";
				$error .= "Whole query: <br />\n" . str_replace("\n","<br />\n",$query);
			}
			include "errors/somethingwentwrong.php";
		}
		
		if ($sqlInstance !== false)
		{
			$sqlInstance->cancel();
		}
		die();
	}
	
	private static function DoQuery($query, $link, $sqlInstance = false)
	{	
		if ($GLOBALS['sql_debug'] >= 2)
		{	
			$GLOBALS['sql_debug_buffer'] .= "Executing sql statement:<br />" . $query . "<br /><br />";
		}
		
		$result = mysql_query($query, $link);
		if ($result === false)
		{
			SQL::Error($query, $link, $sqlInstance);
		}
		return $result;
	}
	
	private function begin()
	{
		if ($this->live)
		{
			mysql_query("START TRANSACTION", $this->transactionLink);
		}
	}
	
	public function cancel()
	{
		if ($this->live)
		{
			mysql_query("ROLLBACK", $this->transactionLink);
			$this->close();
		}
	}
	
	public function save()
	{
		if ($this->live)
		{
			mysql_query("COMMIT", $this->transactionLink);
			$this->close();
		}
	}

	public static function SafeInt($content)
	{
		return filter_var($content, FILTER_VALIDATE_INT);
	}
	
	public static function SafeFloat($content)
	{
		return filter_var($content, FILTER_VALIDATE_FLOAT);
	}
	
	public static function Safe($content, $addQuotes=true)
	{
		if (self::$Link === false)
		{
			self::$Link = SQL::Connect();
		}
		
		if (get_magic_quotes_gpc())
		{
			$content = stripslashes($content);
		}
		
		$output = mysql_real_escape_string($content, self::$Link);
		if ($addQuotes)
		{
			$output = '"' . $output . '"';
		}
		return $output;
	}
}

include "sql/functions/init.php";
?>