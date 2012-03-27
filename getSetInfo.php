<?php
include 'helpers/auth.php';

if (!$GLOBALS['loggedIn'])
{
	die("Not logged in");
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
		$setName = getSetName($setID);
		$courses = getCoursesInSet($setID);
	}
	
	$depts = getDepartments();
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
		echo "<td><input type='hidden' name='status_$numCourses' id='status_$numCourses' value='exists' />
<button type='button' onclick='removeCourseFromSet($numCourses);'>Remove</button></td>\n";
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