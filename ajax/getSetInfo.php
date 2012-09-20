<?php
include 'helpers/auth.php';

if (!$GLOBALS['loggedIn'])
{
	die("Not logged in");
}

if (!Permissions::Has("SITE_ADMINISTRATION"))
{
	include "errors/notauth.php";
	die();
}

$setID = filter_input(INPUT_GET,"setID", FILTER_VALIDATE_INT);

if ($setID !== null):
	if ($setID == -1)
	{
		$setName = "";
		$courses = array();
	}
	else
	{
		$setName = Sets::Name($setID);
		$courses = Courses::InSet($setID);
	}
	
	$depts = Departments::All();
	$numCourses = 0;
?>
<tr>
	<th>Name</th>
</tr>
<?php
	foreach ($courses as $course)
	{
		echo "<tr id='tr_$numCourses'>\n";
		$courseTitle = $course["courseCode"];
		if ($course["displayName"] !== "")
		{
			$courseTitle .= " - " . $course["displayName"];
		}
		echo "<td>" . $course["departmentName"] . " $courseTitle </td>\n";
		echo "<td><input type='hidden' name='status_$numCourses' id='status_$numCourses' value='exists' />";
		echo "<input type='hidden' id='courseID_$numCourses' name='courseID_$numCourses' value='" . $course["courseID"] . "' />";
		echo "<button type='button' onclick='removeCourseFromSet($numCourses);'>Remove</button></td>\n";
		echo "</tr>\n";
		
		$numCourses++;
	}
?>
<tr id="tr_end">
	<td>
		<input type="hidden" id="getSetName" value="<?= $setName ?>" />
		<input type="hidden" id="numCourses" value="<?= $numCourses ?>" />
		
		<select id="setDept" onchange="setDeptSelect()">
			<option>--Select--</option>
			<?php
				foreach ($depts as $dept)
				{
					echo "<option value='" . $dept['departmentID'] . "'>" . $dept["departmentName"] . "</option>\n";
				}
			?>
		</select>
		
		<select id="courseAdd">
			<option>--Select--</option>
		</select>
	</td>
	<td><button type="button" onclick="addCourseToSet();">Add</button></td>
</tr>
<?php else: ?>
Parameters not set
<?php endif; ?>