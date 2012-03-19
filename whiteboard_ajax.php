<?php
include "helpers/auth.php";

if (!$GLOBALS['loggedIn'])
{
	die("[]");
}

//"#df4b26"
$dir = "whiteboards/";
$session = $dir . "test";
$list = ".list";
$me = "." . $GLOBALS['username'] . "." . $GLOBALS['ticket'];

if (file_exists($session . $list))
{
	$theList = file_get_contents($session . $list);
	if (!strpos($theList, $me))
	{
		file_put_contents($session . $me, "");
		file_put_contents($session . $list,file_get_contents($session . $list) . "," . $GLOBALS['username'] . " - " . $GLOBALS['ticket']);
	}
}
else
{
	file_put_contents($session . $me, "");
	file_put_contents($session . $list, $GLOBALS['username'] . " - " . $GLOBALS['ticket']);
	$theList = $GLOBALS['username'];
}

file_put_contents($session . "." . $GLOBALS['username'], file_get_contents("php://input"));

$clicks = array();

$users = explode(",",$theList);

for ($i = 0; $i < count($users); $i++)
{
	if ($users[$i] != $GLOBALS['username'])
	{
		$click = array();
		$click["color"] = "#000000";
		$click["cords"] = json_decode(file_get_contents($session . "." . $users[$i]));
		$clicks[] = $click;
	}
}

echo json_encode($clicks);
?>