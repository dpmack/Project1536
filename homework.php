<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"])
{
	include "error/notloggedin.php";
	die();
}

$homework = getHomework();
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

<div class="groupableSections">
	<div class="section">
	<h2>Homework checklist</h2>

<?php
foreach($homework as $piece)
{
	$overDue = false;
	$timeTilDue = (($piece["dueDate"] - time()) / (60 * 60 * 24));
	if ($timeTilDue >= 1)
	{
		$timeTilDue = round($timeTilDue);
		if ($timeTilDue >= 2)
		{
			$timeTilDue .= " days";
		}
		else
		{
			$timeTilDue .= " day";
		}
	}
	else if ($timeTilDue >= 0)
	{
		$timeTilDue = "Today";
	}
	else if ($timeTilDue > -1)
	{
		$timeTilDue = "Due Yesterday";
		$overDue = true;
	}
	else if ($timeTilDue > -2)
	{
		$timeTilDue = "Overdue 2 Days";
		$overDue = true;
	}
	else
	{
		$timeTilDue = "Overdue " . -(round($timeTilDue + 1)) . " Days";
		$overDue = true;
	}
	
	echo "<div class='homeworkItem' ";
	if ($piece["finished"] && $overDue)
	{
		echo "style='text-decoration: line-through;display:none;' ";
	}
	else if ($piece["finished"])
	{
		echo "style='text-decoration: line-through;' ";
	}
	echo "id='homeworkdiv_" . $piece["homeworkID"] . "' title=\"" . $piece["description"] . "\">"; 
	echo "<input type='checkbox' onclick='toggleStrikeOut(".$piece["homeworkID"].")'";
	if ($piece["finished"])
	{
		echo " checked='checked'";
	}
	echo " />";
	echo "<span class='courseName'>" . $piece["courseName"] . " - </span>";
	echo "<span class='assignment'>" . $piece["title"] . "</span><br />";
	echo "<span class='dueDate'>" . date('Y-m-d', $piece["dueDate"]) . "</span>";
	echo "<span class='timeTilDue'";
	
	if ($overDue)
	{
		echo " style='color: red'";
	}
	
	echo ">" . $timeTilDue . "</span></div>";
}
?>
	</div>
</div>


<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>