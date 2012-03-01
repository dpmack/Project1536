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
echo buildHead("Admin",$headContent);
?>
<body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/helpers/header.php"; ?>

<div>
	<form action="admin.php" method="post">
		<p>
			Department
		</p>
		
		<p>
			<select name="dept" id="deptChange" onchange="deptChange()">
				<option>--New--</option>
				<?php
					foreach ($depts as $dept)
					{
						echo "<option value='" . $dept['deptID'] . "'>" . $dept["name"] . "</option>\n";
					}
				?>
			</select>
			
			<span id="deptEntry">Choose Name</span>
			
			<input type="text" name="deptName" id="deptName" />
			
			<input type="submit" name="which" value="Save Department" />
		</p>
	</form>
</div>

<div>
	<form action="admin.php" method="post">
		<p>
			Courses
		</p>
		
		<p>
			<select name="dept" id="dept" onchange="deptSelect()">
				<option>--Select--</option>
				<?php
					foreach ($depts as $dept)
					{
						echo "<option value='" . $dept['deptID'] . "'>" . $dept["name"] . "</option>\n";
					}
				?>
			</select>
			
			<select name="course" id="course" onchange="courseSelect()">
				<option>--New--</option>
			</select>
		</p>
		
		<p>
			<span id="courseEntry">Create Course</span>
		</p>
		
		<p>
			<select name="newDept" id="newDept" onchange="newDeptSelect()">
				<option>--Select--</option>
				<?php
					foreach ($depts as $dept)
					{
						echo "<option value='" . $dept['deptID'] . "'>" . $dept["name"] . "</option>\n";
					}
				?>
			</select>
			
			<input type="text" name="newCourse" id="newCourse" />
			
			<input type="text" name="newName" id="newName" />
		</p>
		
		<p>
			Description:
			<textarea name="description"></textarea>
		</p>
		
		<p>
			<input type="checkbox" name="share" /> Share
			<input type="text" name="shareURL" />
			Display Name: <input type="text" name="shareDisplay" /><br />
			
			<input type="checkbox" name="mybcit" /> My.Bcit
			<input type="text" name="mybcitURL" />
			Display Name: <input type="text" name="mybcitDisplay" /><br />
			
			<input type="checkbox" name="d2l" /> Desire 2 Learn
			<input type="text" name="d2lURL" />
			Display Name: <input type="text" name="d2lDisplay" /><br />
		</p>
		
		<p>
			Parent Course: (Use to associate lab courses with their lecture course)
			<select name="parentDept" id="parentDept" onchange="parentDeptSelect()">
				<option>--No-Parent--</option>
				<?php
					foreach ($depts as $dept)
					{
						echo "<option value='" . $dept['deptID'] . "'>" . $dept["name"] . "</option>\n";
					}
				?>
			</select>
			
			<select name="parentCourse" id="parentCourse" onchange="parentCourseSelect()">
				<option>--No-Parent--</option>
			</select>
		</p>
		
		<p>
			<input type="submit" name="which" value="Save Course" />
		</p>
	</form>
</div>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include $_SERVER["DOCUMENT_ROOT"] . "/helpers/sqlDebug.php";
}
?>
</body>
</html>