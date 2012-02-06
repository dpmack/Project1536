<?php
include "helpers/opensql.php";
$sql = "SELECT courseName, assignment, dueDate, finished 
FROM `homework` 
join courses on homework.courseID=courses.courseID";
$result = sql_query($sql);

$homework = array();

while($row = mysql_fetch_assoc($result))
{
	$homework[] = $row;
	
}

/*replace with info taken from database
$homework[0]["courseName"] = "Web Development";
$homework[0]["assignment"] = "Milestone 2";
$homework[0]["dueDate"] = 1328342400 + 113854;
$homework[0]["finished"] = true;
$homework[1] = array();
$homework[1]["courseName"] = "Java";
$homework[1]["assignment"] = "Assignment 1";
$homework[1]["dueDate"] = 1328342400 + 221864;
$homework[1]["finished"] = false;
$homework[2] = array();
$homework[2]["courseName"] = "Learning Skills";
$homework[2]["assignment"] = "Weekly Journal";
$homework[2]["dueDate"] = 1328342400 + 331841;
$homework[2]["finished"] = false;
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Homework Checklist</title>
	<link rel=StyleSheet href="" type="text/css">
	</head>
	
	<body>
		<?php
		$i = 0;
		foreach($homework as $piece)
		{
			$timeTilDue = $piece["dueDate"] - time();
			$timeTilDue = round($timeTilDue / (60 * 60 * 24));
			echo " <div class='homeworkItem' ";
			if($piece["finished"])
			{
				echo "style = 'text-decoration: line-through' ";
			}
			echo "id='homeworkdiv_".$i."'>"; 
			echo " <input type='checkbox' onclick='toggleStrikeOut(".$i.")'";
			if($piece["finished"])
			{
				echo " checked='checked'";
			}
			echo ">";
			echo " <span class='courseName'>" . $piece["courseName"] . "</span>";
			echo " <span class='assignment'>" . $piece["assignment"] . "</span>";
			echo " <span class='dueDate'>" . date('Y-m-d', $piece["dueDate"]) . "</span>";
			echo " <span class='timeTilDue'>" . $timeTilDue . " in day(s).</span></div>";
			$i++;
		}
		
		?>
		<script type="text/javascript">
			function toggleStrikeOut(i)
			{
				homeworkDiv = document.getElementById("homeworkdiv_" + i);
				if(homeworkDiv.style.textDecoration == "line-through")
				{
					homeworkDiv.style.textDecoration = "";
				}
				else
				{
					homeworkDiv.style.textDecoration = "line-through";
				}
			}
		</script>
	</body>
	
</html>