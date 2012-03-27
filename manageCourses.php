<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"])
{
	include "error/notloggedin.php";
	die();
}

if (isset($_POST["posted"]))
{
	$newCourses = array();
	foreach ($_POST as $course)
	{
		if ($course !== "posted")
		{
			$newCourses[] = $course;
		}
	}

	updateMyCourses($newCourses);
}

$depts = getDepartments();

$sets = getSets();

$courses = getMyCourses();

$crumbs = array(array("href" => "myhub.php", "name" => "MYHub"),
				array("href" => "manageCourses.php", "name" => "Manage Your Courses"));

$headContent = '<script type="text/javascript" src="script/manageCourses.js"></script>';
echo buildHead("Manage Your Courses",$headContent);
?>
<body>
<?php
include "helpers/header.php";
?>

<form action="manageCourses.php" method="post">

<div class="groupableSections">
	<div class="section">
		<h2>Recomended Courses</h2>

		Recomended coures for
		<select id="set" onchange="setSelected()">
			<option>--Select--</option>
			<?php
				foreach ($sets as $set)
				{
					echo "<option value='" . $set["setID"] . "'>" . $set["setName"] . "</option>\n";
				}
			?>
		</select>
		
		<div id="recomended">
			
		</div>
		
		<br />
		<button type="button" onclick="selectAll()">Select All</button>
	</div>
	
	<div class="section">
		<h2>Chosen Courses</h2>
		
		<br />
		<div id="chosen">
			<?php
				foreach ($courses as $course)
				{
					$courseID = $course["courseID"];
					$courseName = $course["departmentName"] . " " . $course["courseCode"];
					if ($course["displayName"] !== "")
					{
						$courseName .= " - " . $course["displayName"];
					}
					echo "<div id='chosen_$courseID' onclick='removeCourse($courseID)'>\n";
					echo "<input type='checkbox' name='check_chosen_$courseID' id='check_chosen_$courseID' value='$courseID' checked='checked' />$courseName<br /></div>";
				}
			?>
		</div>
		<br />
		
		<div>
			<select id="dept" onchange="deptSelect()">
				<option>--Select--</option>
				<?php
					foreach ($depts as $dept)
					{
						echo "<option value='" . $dept['departmentID'] . "'>" . $dept["departmentName"] . "</option>\n";
					}
				?>
			</select>
			
			<select id="course">
				<option>--Select--</option>
			</select>
			
			<button type="button" onclick="clickedAddCourse()">Add Course</button>
		</div>
	</div>
</div>

<input type="hidden" name="posted" value="posted" />
<input type="submit" value="Save Courses" />

</form>

<script type="text/javascript">
	setSelected();
</script>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>