<?php
include "./helpers/auth.php";
include "./helpers/head.php";
include "./helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "./error/notloggedin.php";
	die();
}
?>

<?php
$headContent = "<script type='text/javascript' src='/script/jquery.ui.datepicker.js'></script>
<script type='text/javascript' src='/script/jquery.ui.core.js'></script>
<link rel='stylesheet' type='text/css' href='/css/datepicker.css' />
<link rel='stylesheet' type='text/css' href='/css/admin.css' />"; //if needing to add extra css files
echo buildHead("Add Homework",$headContent);
?>
<body>
<?php include "./helpers/header.php"; ?>

<form action="http://webdevfoundations.net/scripts/formdemo.asp" id="addHomework" method="post">
		<div id="contents">
			<label for="dept" id="labelDepartment">Department</label>
			<select name="dept" id="dept">
				<option>--Select--</option>
				<option>COMP</option>
				<option>COMM</option>
			</select>
			
			<label for="course" id="labelCourse">Course</label>
			<select name="course" id="course">
				<option>--Select--</option>
				<option>1510</option>
				<option>1538</option>
				<option>1113</option>
				<option>1116</option>
			</select>
			
			<label for="homeworkTitle" id="labelHomework">Homework Title</label>
			<input type="text" name="homeworkTitle" id="homeworkTitle"/>
		</div>
	
	<p>
		<textarea name="comment" rows="5" cols="50"></textarea>
	</p>
	
	<p>
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