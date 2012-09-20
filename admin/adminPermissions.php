<?php
include "helpers/auth.php";
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "errors/notloggedin.php";
	die();
}

if (!Permissions::Has("SITE_ADMINISTRATION"))
{
	include "errors/notauth.php";
	die();
}

$which = (isset($_POST['which'])) ? $_POST['which'] : false;

//Roles
if ($which == "roles")
{
	$role = filter_input(INPUT_POST,"role", FILTER_VALIDATE_INT);
	$roleName = (isset($_POST['roleName'])) ? $_POST['roleName'] : false;
	
	$statusIndex = 0;
	$permissions = array();
	while (isset($_POST["status_perm_$statusIndex"]))
	{
		$status = $_POST["status_perm_$statusIndex"];
		$permissionID = filter_input(INPUT_POST,"permissionID_perm_$statusIndex", FILTER_VALIDATE_INT);

		if ($permissionID === false)
		{
			continue;
		}
		
		if ($status != "gone")
		{
			$permissions[] = array("permissionID" => $permissionID, "status" => $status);
		}
		
		$statusIndex++;
	}
	
	if ($role === false && $roleName !== false)
	{
		Roles::Create($roleName, $permissions);
	}
	else if ($role !== false)
	{
		Roles::Update($role, $roleName, $permissions);
	}
}

//Users
if ($which == "users")
{
	$user = filter_input(INPUT_POST,"user", FILTER_VALIDATE_INT);
	$userRole = filter_input(INPUT_POST,"userRole", FILTER_VALIDATE_INT);
	
	if ($user && $userRole)
	{
		Roles::SetRole($user, $userRole);
	}
}

$users = Accounts::All();
$roles = Roles::All();

$headContent = "<script type='text/javascript' src='/script/admin.js'></script>"; //if needing to add extra css files
echo buildHead("Admin Permission",$headContent);
?>
<body>
<?php include "helpers/header.php"; ?>

<div>
	<form action="" method="post">
		<br />
		<h2>Roles</h2>
		
		<p>
			<select name="role" id="role" onchange="rolesChange()">
				<option>--New--</option>
				<?php
					foreach ($roles as $role)
					{
						echo "<option value='" . $role['roleID'] . "'>" . $role["roleName"] . "</option>\n";
					}
				?>
			</select>
		</p>
		
		<p>Role Info</p>
		
		<p>
			Role Name: <input type="text" name="roleName" id="roleName" />
		</p>
			
		
		<strong>Permissions</strong>
		<table id="rolePermissions">
				
		</table>
		
		<script type="text/javascript">
			rolesChange();
		</script>
		
		<p>
			<input type="hidden" name="which" value="roles" />
			<input type="submit" value="Save Role" />
		</p>
	</form>
</div>

<br />
<hr />
<br />

<div>
	<form action="" method="post">
		<h2>Users</h2>
		
		<p>
			<select name="user" id="user" onchange="userChange()">
				<option>--Select--</option>
				<?php
					$index = 0;
					foreach ($users as $user)
					{
						echo "<option index='$index' value='" . $user['accountID'] . "'>" . $user["username"] . " - " . $user["firstName"] . ", " . $user["lastName"] . "</option>\n";
						$index++;
					}
				?>
			</select>
		</p>
		
		<script type="text/javascript">
			users = jQuery.parseJSON('<?=str_replace(array("'"),array("\\'"), json_encode($users))?>');
		</script>
		
		<p>		
			Role
			
			<select name="userRole" id="userRole">
				<?php
					foreach ($roles as $role)
					{
						echo "<option value='" . $role['roleID'] . "'>" . $role["roleName"] . "</option>\n";
					}
				?>
			</select>
		</p>
		
		<p>
			<input type="hidden" name="which" value="users" />
			<input type="submit" value="Save User" />
		</p>
	</form>
</div>

<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>
</html>