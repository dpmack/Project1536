<?php
include $_SERVER["DOCUMENT_ROOT"] . "/helpers/auth.php";
include $_SERVER["DOCUMENT_ROOT"] . "/helpers/head.php";
include $_SERVER["DOCUMENT_ROOT"] . "/helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include $_SERVER["DOCUMENT_ROOT"] . "/error/notloggedin.php";
	die();
}
?>

<?php
$headContent = ""; //if needing to add extra css files
echo buildHead("Page name here",$headContent);
?>
<body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/helpers/header.php"; ?>

<form action="addHomework.php" method="post">
	<p>
		<label for="dept">Department</label>
		<select name="dept">
			<option>--Select--</option>
			<option>COMP</option>
			<option>COMM</option>
		<select>
		
		<label for="course">Course</label>
		<select name="course">
			<option>--Select--</option>
			<option>1510</option>
			<option>1538</option>
			<option>1113</option>
			<option>1116</option>
		</select>
		
		<label for="homeworkTitle">Homework Title</label>
		<input type="text" name="homeworkTitle" />
	</p>
	
	<p>
		<textarea name="comment"></textarea>
	</p>
	
	<p>
		<input type="text" name="date" />
		<input type="submit" value="Add Homework" />
	</p>
</form>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include $_SERVER["DOCUMENT_ROOT"] . "/helpers/sqlDebug.php";
}
?>
</body>
</html>