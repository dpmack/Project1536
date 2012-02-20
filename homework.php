<?php
include 'helpers/auth.php';
include "templates/head.php";
include "helpers/embededLogin.php";

$hiddenDate = time() - 60*60*24*3;

$sql = "SELECT homework.homeworkID as homeworkID, courseName, assignment, dueDate, !ISNULL(ham.homeworkID) as finished 
FROM homework
JOIN courses on homework.courseID=courses.courseID
JOIN accountscoursesmapping as acm on acm.courseID=courses.courseID
JOIN accounts on accounts.accountID = acm.accountID
LEFT JOIN homeworkaccountmapping as ham on homework.homeworkID=ham.homeworkID and accounts.accountID=ham.accountID
WHERE accounts.username='" . $GLOBALS['username'] . "' and accounts.ticket='" . $GLOBALS['ticket'] . "' and
dueDate > " . $hiddenDate . " 
ORDER BY duedate DESC";
$result = sql_query($sql);

$homework = array();

while($row = mysql_fetch_assoc($result))
{
	$homework[] = $row;
	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
$headContent = '<link rel="stylesheet" type="text/css" href="css/homework.css" />';
if (!$GLOBALS['loggedIn'])
{
	$headContent .= '<meta http-equiv="Refresh" content="0; URL=login.php" />';
}

echo buildHead("Homework Checklist",$headContent);
?>
<body>
<?php
include "templates/header.php";

if (!$GLOBALS['loggedIn'])
{	
	echo "To view this page you must be logged in";
	
	include "templates/footer.php";
	
	if ($GLOBALS['sql_debug'] != 0)
	{
		include "templates/sqlDebug.php";
	}
	echo "</body></html>";
	die();
}
?>

<h2 class="first">Homework checklist</h1>

<?php
foreach($homework as $piece)
{
	$timeTilDue = $piece["dueDate"] - time();
	$timeTilDue = round($timeTilDue / (60 * 60 * 24));
	echo "<div class='homeworkItem' ";
	if($piece["finished"])
	{
		echo "style = 'text-decoration: line-through' ";
	}
	echo "id='homeworkdiv_".$piece["homeworkID"]."'>"; 
	echo "<input type='checkbox' onclick='toggleStrikeOut(".$piece["homeworkID"].")'";
	if($piece["finished"])
	{
		echo " checked='checked'";
	}
	echo ">";
	echo "<span class='courseName'>" . $piece["courseName"] . " - </span>";
	echo "<span class='assignment'>" . $piece["assignment"] . "</span><br />";
	echo "<span class='dueDate'>" . date('Y-m-d', $piece["dueDate"]) . "</span>";
	echo "<span class='timeTilDue'>" . $timeTilDue . " day(s).</span></div>";
}
?>

<script type="text/javascript">
	function toggleStrikeOut(i)
	{
		ajaxHomework = XMLHttpRequest();
		homeworkDiv = document.getElementById("homeworkdiv_" + i);
		homeworkStatus = "";
		if(homeworkDiv.style.textDecoration == "line-through")
		{
			homeworkDiv.style.textDecoration = "";
			homeworkStatus = "todo";
		}
		else
		{
			homeworkDiv.style.textDecoration = "line-through";
			homeworkStatus = "done";
		}
		ajaxHomework.open("GET", "updatehomework.php?homeworkID=" + i + "&homeworkStatus=" + homeworkStatus);
		ajaxHomework.send();
	}
</script>

<?php include "templates/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "templates/sqlDebug.php";
}
?>
</body>	
</html>