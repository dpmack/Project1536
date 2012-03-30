<?php
include "./helpers/auth.php";
include "./helpers/head.php";
include "./helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "./error/notloggedin.php";
	die();
}

if (!hasPermission("CREATE_HOMEWORK"))
{
	include "./error/notauth.php";
	die();
}


$depts = getDepartments();

$courseID = filter_input(INPUT_POST,"course", FILTER_VALIDATE_INT);
$dueDate = filter_input(INPUT_POST,"date", FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^([0]?\d\/|1[0-2]\/)([0-2]?\d\/|3[0-1]\/)2(0[1-9]|[1-9]\d)\d$/")));
$homeworkTitle = filter_input(INPUT_POST,"homeworkTitle", FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^.*$/")));
$description = filter_input(INPUT_POST,"comment", FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^.*$/")));

if ($courseID !== null && $dueDate !== null && $homeworkTitle !== null && $description !== null)
{
	addHomeworkAssignment($courseID, $homeworkTitle, $description, $dueDate);
}
?>

<?php
$headContent = "<script type='text/javascript' src='/script/jquery.ui.datepicker.js'></script>
<script type='text/javascript' src='/script/jquery.ui.core.js'></script>
<script type='text/javascript' src='/script/homework.js'></script>
<link rel='stylesheet' type='text/css' href='/css/datepicker.css' />
<link rel='stylesheet' type='text/css' href='/css/admin.css' />"; //if needing to add extra css files
echo buildHead("Add Homework",$headContent);
?>
<body>
<?php include "./helpers/header.php"; ?>

<form action="addHomework.php" id="addHomework" method="post">
		<div id="contents">
			<label for="dept" id="labelDepartment">Department</label>
			<select id="dept" onchange="departmentChange()">
				<option value="-1">--Select--</option>
				<?php
					foreach ($depts as $dept)
					{
						echo "<option value='" . $dept['departmentID'] . "'>" . $dept["departmentName"] . "</option>\n";
					}
				?>
			</select>
			
			<label for="course" id="labelCourse">Course</label>
			<select name="course" id="course">
				<option>--Select--</option>
				
			</select>
			
			<label for="homeworkTitle" id="labelHomework">Homework Title</label>
			<input type="text" name="homeworkTitle" id="homeworkTitle"/>
		</div>
	
	<p>
		Description
		<textarea name="comment" rows="5" cols="50"></textarea>
	</p>
	
	<p>
		Due Date : 
		<input type="text" name="date" id="datePicker" />
		<input type="submit" value="Add Homework" />
	</p>
</form>
<script type="text/javascript">
	$(function() {
		$( "#datePicker" ).datepicker();
	});
</script>

<?php include "./helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "./helpers/sqlDebug.php";
}
?>
</body>
</html>