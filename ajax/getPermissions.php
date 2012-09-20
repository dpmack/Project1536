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

$roleID = filter_input(INPUT_GET,"roleID", FILTER_VALIDATE_INT);

if ($roleID !== null):
	if ($roleID == -1)
	{
		$permissions = array();
	}
	else
	{
		$permissions = Permissions::InRole($roleID);
	}
	
	$allPermissions = Permissions::All();
	$numPermissions = 0;
?>
<tr>
	<th>Name</th>
</tr>
<?php
	foreach ($permissions as $permission)
	{
		echo "<tr id='tr_perm_$numPermissions'>\n";
		echo "<td>" . $permission["permissionName"] . "</td>\n";
		echo "<td><input type='hidden' name='status_perm_$numPermissions' id='status_perm_$numPermissions' value='exists' />";
		echo "<input type='hidden' id='permissionID_perm_$numPermissions' name='permissionID_perm_$numPermissions' value='" . $permission["permissionID"] . "' />";
		echo "<button type='button' onclick='removePermissionFromRole($numPermissions);'>Remove</button></td>\n";
		echo "</tr>\n";
		
		$numPermissions++;
	}
?>
<tr id="tr_perm_end">
	<td>
		<input type="hidden" id="numPermissions" value="<?= $numPermissions ?>" />
		
		<select id="permission">
			<option>--Select--</option>
			<?php
				foreach ($allPermissions as $permission)
				{
					echo "<option value='" . $permission['permissionID'] . "'>" . $permission["permissionName"] . "</option>\n";
				}
			?>
		</select>
	</td>
	<td><button type="button" onclick="addPermissionToRole();">Add</button></td>
</tr>
<?php else: ?>
Parameters not set
<?php endif; ?>