<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"])
{
	include "error/notloggedin.php";
	die();
}

$hiddenDate = time() - 60*60*24*3;

$sql = "SELECT homework.homeworkID as homeworkID, courseName, title, description, dueDate, !ISNULL(ham.homeworkID) as finished 
FROM homework
JOIN courses on homework.courseID=courses.courseID
JOIN accountscoursesmapping as acm on acm.courseID=courses.courseID
JOIN accounts on accounts.accountID = acm.accountID
LEFT JOIN homeworkaccountmapping as ham on homework.homeworkID=ham.homeworkID and accounts.accountID=ham.accountID
WHERE accounts.username='" . $GLOBALS['username'] . "' and
dueDate > " . $hiddenDate . " 
ORDER BY duedate ASC";
$result = sql_query($sql);

$homework = array();

while($row = mysql_fetch_assoc($result))
{
	$homework[] = $row;
}

?>

<?php
$headContent = '<link rel="stylesheet" type="text/css" href="/css/homework.css" />
<script type="text/javascript" src="script/homework.js"></script>';
echo buildHead("Homework Checklist",$headContent);
?>
<body>
<?php
include "helpers/header.php";
?>

<h2 class="first">Homework checklist</h2>

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
	echo "id='homeworkdiv_".$piece["homeworkID"]."' title=\"" . $piece["description"] . "\">"; 
	echo "<input type='checkbox' onclick='toggleStrikeOut(".$piece["homeworkID"].")'";
	if($piece["finished"])
	{
		echo " checked='checked'";
	}
	echo " />";
	echo "<span class='courseName'>" . $piece["courseName"] . " - </span>";
	echo "<span class='assignment'>" . $piece["title"] . "</span><br />";
	echo "<span class='dueDate'>" . date('Y-m-d', $piece["dueDate"]) . "</span>";
	echo "<span class='timeTilDue'>" . $timeTilDue . " day(s).</span></div>";
}
?>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>