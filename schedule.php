<?php
include 'helpers/auth.php';
include "templates/head.php";
include "helpers/embededLogin.php";
?>

<?php
$headContent = '<link rel="stylesheet" type="text/css" href="css/schedule.css" />';
if (!$GLOBALS['loggedIn'])
{
	$headContent .= '<meta http-equiv="Refresh" content="0; URL=login.php" />';
}

echo buildHead("Schedule",$headContent);
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

<!-- !-->
<div id="body">
	<form id="scheduleForm">
	
		<select id="year">
			<option selected value="default">Select Year </option>
			<option value="Year1">Year 1</option>
			<option value="Year2">Year 2</option>
			<option value="Year3">Year 3</option>
			<option value="Year4">Year 4</option>
		</select> 
		
		<select id="term">
			<option selected value="default">Select Term </option>
			<option value="Year1">Term 1</option>
			<option value="Year2">Term 2</option>
		</select> 

		<select id="Set">
			<option selected value="default">Select Set </option>
			<option value="Year1">Set A</option>
			<option value="Year2">Set B</option>
			<option value="Year1">Set C</option>
			<option value="Year2">Set D</option>
		</select>
		
		<input id="submit" type="submit" name="mysubmit" value="Update Schedule!"/>

	</form>
	

	<table>
	<tr>
		<td></td>
		<th>Monday</th>
		<th>Tuesday</th>
		<th>Wednesday</th>
		<th>Thursday</th>
		<th>Friday</th>
	</tr>
	<tr>
		<th>8:30am</th>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<th>9:30am</th>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<th>10:30am</th>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<th>11:30am</th>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<th>12:30pm</th>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<th>1:30pm</th>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<th>2:30pm</th>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<th>3:30pm</th>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<th>4:30pm</th>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<th>5:30pm</th>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	</table>
	
</div>

<!-- !-->
<?php include "templates/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "templates/sqlDebug.php";
}
?>
</body>	
</html>