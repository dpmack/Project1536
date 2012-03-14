<?php
include "./config/current.config";
include "sqlfunctions.php";

$GLOBALS['sql_debug_buffer'] = "";
$GLOBALS['sql_debug'] = $sqlDebugMode;

if($GLOBALS['sql_debug'] != -1 && isset($_GET["sqldebug"]))
{
	$GLOBALS['sql_debug'] = floor($_GET["sqldebug"]);
}

$link = mysql_connect($sqlHost, $sqlUser, $sqlPassword);
if (!$link) {
    die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db($sqlDB);
if (!$db_selected) {
    die ('Can\'t use ' . $sqlDB . ' : ' . mysql_error());
}

function sql_error($query,$error)
{
	return mysql_query("INSERT INTO errors (time,message,comment) VALUES(NOW(), \"" . mysql_real_escape_string($error) . "\", \"" . mysql_real_escape_string($query) . "\")");
}

function sql_query($query)
{
	if ($GLOBALS['sql_debug'] >= 2)
	{	
		$GLOBALS['sql_debug_buffer'] .= "Executing sql statement:<br />" . $query . "<br /><br />";
	}
	$result = mysql_query($query);
	if (!$result)
	{
		$error = mysql_error();
		if (!sql_error($query,$error))
		{
			//failed to add error to db
			$err  = 'Invalid query: ' . mysql_error() . "\n<br />";
			$err .= 'Whole query: ' . $query;
			die($err);
		}
		else
		{	
			$err = "Something went wrong. Please try again, if the problem persists contact the site administrator.";
			if ($GLOBALS['sql_debug'] >= 1)
			{
				$err .= '<br />Invalid query: <br />' . $error . "\n<br /><br />";
				$err .= 'Whole query: <br />' . $query;
			}
			die($err);
		}
	}
	return $result;
}

function sql_insert($table_name,$columns,$data)
{
	$sql_cols = "";
	$sql_values = "";
	$index = 0;
	foreach ($columns as &$col)
	{
		if ($index != 0)
		{
			$sql_cols .= ",";
			$sql_values .= ",";
		}
		$sql_cols .= mysql_real_escape_string($col);
		if (gettype($data[$col]) == "string" or $data[$col] == "")
		{
			$sql_values .= '"'.mysql_real_escape_string($data[$col]).'"';
		}
		else
		{
			$sql_values .= mysql_real_escape_string($data[$col]);
		}
		$index += 1;
	}
	
	return sql_query("INSERT INTO `".$table_name."` (".$sql_cols.") VALUES (".$sql_values.")");
}

function sql_update($table_name,$columns,$data)
{
	$sql_updates = "";
	$index = 0;
	foreach ($columns as &$col)
	{
		if ($index != 0)
		{
			$sql_updates .= ", ";
		}
		$sql_updates .= $col."=";
		if (gettype($data[$col]) == "string" or $data[$col] == "")
		{
			$sql_updates .= '"'.mysql_real_escape_string($data[$col]).'"';
		}
		else
		{
			$sql_updates .= mysql_real_escape_string($data[$col]);
		}
		$index += 1;
	}
	
	return sql_query("UPDATE `".$table_name."` SET ".$sql_updates." where memberID=".$data["memberID"]);
}

////rewrite
function sql_get($tablename,$colname,$colvalue)
{
	return sql_query("SELECT * FROM `" . $tablename . "`WHERE `" . $colname . "`=" . $colvalue);
};

function sql_get_single($tablename,$colname,$colvalue)
{	
	if (gettype($colvalue) == "string" or $colvalue == "")
	{
		$colvalue = '"'.mysql_real_escape_string($colvalue).'"';
	}
	$value = mysql_fetch_array(sql_get($tablename,$colname,$colvalue), MYSQL_ASSOC);
	
	if ($GLOBALS['sql_debug'] >= 3)
	{
		$GLOBALS['sql_debug_buffer'] .= print_r($value, true)."<br /><br />";
	}
	return $value;
};

function sql_set($tablename,$colname,$colvalue,$changecol,$changeval)
{
	if (gettype($colvalue) == "string" or $colvalue == "")
	{
		$colvalue = '"'.mysql_real_escape_string($colvalue).'"';
	}
	if (gettype($changeval) == "string" or $changeval == "")
	{
		$changeval = '"'.mysql_real_escape_string($changeval).'"';
	}
	return sql_query("UPDATE `" . $tablename . "` SET `" . $changecol . "`=" . $changeval . " WHERE `" . $colname . "`=" . $colvalue);
};

?>