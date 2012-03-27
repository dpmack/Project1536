<?php
include "./helpers/auth.php";
include "./helpers/head.php";
include "./helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "./error/notloggedin.php";
	die();
}

$which = (isset($_POST['which'])) ? $_POST['which'] : false;

//Depts
if ($which == "departments")
{
	$dept = filter_input(INPUT_POST,"dept", FILTER_VALIDATE_INT);
	$deptName = filter_input(INPUT_POST,"deptName", FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^.*$/")));
	if($deptName !== false)
	{
		if($dept === false)
		{
			createDepartment($deptName);
		}
		else
		{
			renameDepartment($dept, $deptName);
		}
	}
}

//Courses
if ($which == "courses")
{
	$dept = filter_input(INPUT_POST,"dept", FILTER_VALIDATE_INT);
	$course = filter_input(INPUT_POST,"course", FILTER_VALIDATE_INT);
	$courseCode = filter_input(INPUT_POST,"courseCode", FILTER_VALIDATE_INT);
	$courseName = (isset($_POST['courseName'])) ? $_POST['courseName'] : false;
	$courseDesc = (isset($_POST['description'])) ? $_POST['description'] : false;
	$location = (isset($_POST['location'])) ? $_POST['location'] : false;
	$url = (isset($_POST['url'])) ? $_POST['url'] : false;
	$displayName = (isset($_POST['displayName'])) ? $_POST['displayName'] : false;
	$parent = filter_input(INPUT_POST,"parentCourse", FILTER_VALIDATE_INT);
	$newDept = filter_input(INPUT_POST,"newDept", FILTER_VALIDATE_INT);
	
	if ($parent === false)
	{
		$parent = "NULL";
	}
	
	if ($course === false && $dept !== false)
	{
		//New Course
		createCourse($dept, $courseCode, $courseName, $courseDesc, $location, $url, $displayName, $parent);
	}
	else if ($course !== false && $dept !== false)
	{
		//Update Course
		if ($newDept !== false)
		{
			$dept = $newDept;
		}
		
		updateCourse($dept, $course, $courseCode, $courseName, $courseDesc, $location, $url, $displayName, $parent);
	}
}

//Sets
if ($which == "sets")
{
	$set = filter_input(INPUT_POST,"set", FILTER_VALIDATE_INT);
	$setName = (isset($_POST['setName'])) ? $_POST['setName'] : false;
	
	$statusIndex = 0;
	$courses = array();
	while (isset($_POST["status_$statusIndex"]))
	{
		$status = $_POST["status_$statusIndex"];
		$courseID = filter_input(INPUT_POST,"courseID_$statusIndex", FILTER_VALIDATE_INT);
		
		if ($courseID === false)
		{
			continue;
		}
		
		if ($status != "gone")
		{
			$courses[] = array("courseID" => $courseID, "status" => $status);
		}
		
		$statusIndex++;
	}
	
	if ($set === false && $setName !== false)
	{
		//new set
		createSet($setName, $courses);
	}
	else if ($set !== false)
	{
		updateSet($set, $setName, $courses);
	}
}

$depts = getDepartments();

$sets = getSets();

?>

<?php
$headContent = "<script type='text/javascript' src='script/admin.js'></script>"; //if needing to add extra css files
echo buildHead("Admin",$headContent);
?>
<body>
<?php include "./helpers/header.php"; ?>

<div>
	<form action="admin.php" method="post">
		<br />
		<h2>Departments</h2>
		
		<p>
			<select name="dept" id="deptChange" onchange="departmentsDeptChange();">
				<option>--New--</option>
				<?php
					foreach ($depts as $dept)
					{
						echo "<option value='" . $dept['departmentID'] . "'>" . $dept["departmentName"] . "</option>\n";
					}
				?>
			</select>
			
			Choose Name
			
			<input type="text" name="deptName" id="deptName" />
			<input type="hidden" name="which" value="departments" />
			<input type="submit" id="saveDept" value="Create Department" />
		</p>
	</form>
</div>

<br />
<hr />
<br />

<div>
	<form action="admin.php" method="post">
		<h2>Courses</h2>
		
		<p>
			<select name="dept" id="deptCourses" onchange="departmentChange()">
				<option>--Select--</option>
				<?php
					foreach ($depts as $dept)
					{
						echo "<option value='" . $dept['departmentID'] . "'>" . $dept["departmentName"] . "</option>\n";
					}
				?>
			</select>
			
			<select name="course" id="course" onchange="courseSelect()">
				<option>--New--</option>
			</select>
		</p>
		
		<p>
			<span id="courseEntry">Course Info</span>
		</p>
		
		<p>		
			Course Code
			
			<input type="text" name="courseCode" id="courseCode" />
			
			Course Name
			
			<input type="text" name="courseName" id="courseName" />
		</p>
		
		<p>
			Description:
			<textarea name="description" id="description" rows="5" cols="50"></textarea>
		</p>
		
		<p>
			Course Data<br />
			<select name="location" id="location">
				<option>--Select--</option>
				<option>D2L</option>
				<option>My.BCIT</option>
				<option>Share</option>
			</select>
			<br />
			URL: <input type="text" name="url" id="url" /><br />
			Display Name: <input type="text" name="displayName" id="displayName" /><br />
		</p>
		
		<p>
			Parent Course: (Use to associate lab courses with their lecture course)
			<br />
			<select name="parentCourse" id="parentCourse">
				<option>--No-Parent--</option>
			</select>
		</p>
			
		<p>
			Change Course Department
			<br />
			<select name="newDept" id="newDept">
				<option>--Select--</option>
				<?php
					foreach ($depts as $dept)
					{
						echo "<option value='" . $dept['departmentID'] . "'>" . $dept["departmentName"] . "</option>\n";
					}
				?>
			</select>
		</p>
		
		<p>
			<input type="hidden" name="which" value="courses" />
			<input type="submit" value="Save Course" />
		</p>
	</form>
</div>

<br />
<hr />
<br />

<div>
	<form action="admin.php" method="post">
		<p>Sets</p>
		
		<p>
			<select name="set" id="set" onchange="setsChange()">
				<option>--New--</option>
				<?php
					foreach ($sets as $set)
					{
						echo "<option value='" . $set['setID'] . "'>" . $set["setName"] . "</option>\n";
					}
				?>
			</select>
		</p>
		
		<p>Set Info</p>
		
		<p>
			Set Name: <input type="text" name="setName" id="setName" />
		</p>
			
		
		<strong>Courses</strong>
		<table id="setCourses">
				
		</table>
		
		<script type="text/javascript">
			setsChange();
		</script>
		
		<p>
			<input type="hidden" name="which" value="sets" />
			<input type="submit" value="Save Set" />
		</p>
	</form>
</div>

<?php include "./helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "./helpers/sqlDebug.php";
}
?>
</body>
</html>