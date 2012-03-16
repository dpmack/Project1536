<?php
include "./helpers/auth.php";
include "./helpers/head.php";
include "./helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "./error/notloggedin.php";
	die();
}

$dept = filter_input(INPUT_POST,"dept", FILTER_VALIDATE_INT);
$deptName = filter_input(INPUT_POST,"deptName", FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^.*$/")));
if($dept !== null && $deptName !== null)
{
	if($dept == -1)
	{
		createDepartment($deptName);
	}
	else
	{
		renameDepartment($dept, $deptName);
	}
}


$depts = getDepartments();

$sets = getSets();

?>

<?php
$headContent = ""; //if needing to add extra css files
echo buildHead("Admin",$headContent);
?>
<body>
<?php include "./helpers/header.php"; ?>

<div>
	<form action="admin.php" method="post">
		<p>
			Department
		</p>
		
		<p>
			<select name="dept" id="deptChange" onchange="deptChange()">
				<option value="-1">--New--</option>
				<?php
					foreach ($depts as $dept)
					{
						echo "<option value='" . $dept['departmentID'] . "'>" . $dept["departmentName"] . "</option>\n";
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
	<form action="http://webdevfoundations.net/scripts/formdemo.asp" method="post">
		<p>
			Courses
		</p>
		
		<p>
			<select name="dept" id="deptCourses" onchange="deptSelect()">
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
			<textarea name="description" rows="5" cols="50"></textarea>
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

<div>
	<form action="http://webdevfoundations.net/scripts/formdemo.asp" method="post">
		<p>
			Sets
		</p>
		
		<p>
			<select name="sets" id="setsChange" onchange="setsChange()">
				<option>--New--</option>
				<?php
					foreach ($sets as $set)
					{
						echo "<option value='" . $set['setID'] . "'>" . $set["name"] . "</option>\n";
					}
				?>
			</select>
		</p>
		
		<p>
			Set Info
		</p>
		
		<p>
			Set Name: <input type="text" name="setName" id="setName" />
		</p>
			
		
			<strong>Course</strong>
			<table>
				<tr>
					<th>Name</th>
				</tr>
				<tr>
					<td>COMP 1510</td>
					<td><button type="button">Remove</button></td>
				</tr>
				<tr>
					<td>COMP 1536</td>
					<td><button type="button">Remove</button></td>
				</tr>
				<tr>
					<td>
						<select name="dept" id="dept" onchange="deptSelect()">
							<option>--Select--</option>
							<?php
								foreach ($depts as $dept)
								{
									echo "<option value='" . $dept['deptID'] . "'>" . $dept["name"] . "</option>\n";
								}
							?>
						</select>
						
						<select name="course" id="courseAdd" onchange="courseSelect()">
							<option>--New--</option>
						</select>
					</td>
					<td><button type="button">Add</button></td>
				</tr>
			</table>
		
		
		<p>
			<input type="submit" name="which" value="Save Set" />
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