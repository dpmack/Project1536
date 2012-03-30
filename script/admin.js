function departmentsDeptChange()
{
	if ($("#deptChange").val() != "--New--")
	{
		$("#saveDept").val("Rename Department");
	}
	else
	{
		$("#saveDept").val("Create Department");
	}
}

function updateCourses(data, textStatus, jqXHR)
{
	course = $("#course");
	course.html("<option>--New--</option>\n" + data);
	course.val("--New--");
	
	parentCourse = $("#parentCourse");
	parentCourse.html("<option>--No-Parent--</option>\n" + data);
	parentCourse.val("--No-Parent--");
	
	courseSelect();
}

function departmentChange()
{
	departmentID = $("#deptCourses").val();
	$.ajax({
		url: "getCourses.php?departmentID=" + departmentID,
		type: "GET",
		context: document.body,
		success: updateCourses,
	});
}

function updateCourseData(data, textStatus, jqXHR)
{
	jsonData = jQuery.parseJSON(data);
	$("#courseCode").val(jsonData["courseCode"]);
	$("#courseName").val(jsonData["courseName"]);
	$("#description").val(jsonData["description"]);
	$("#location").val(jsonData["location"]);
	$("#url").val(jsonData["courseURL"]);
	$("#displayName").val(jsonData["displayName"]);
	$("#parentCourse").val(jsonData["parentCourse"]);
	$("#newDept").val("--Select--");
}

function courseSelect()
{
	courseID = $("#course").val();
	
	if (courseID == "--New--")
	{
		$("#courseCode").val("");
		$("#courseName").val("");
		$("#description").val("");
		$("#location").val("--Select--");
		$("#url").val("");
		$("#displayName").val("");
		$("#parentCourse").val("--No-Parent--");
		$("#newDept").val("--Select--");
	}
	else
	{
		$.ajax({
			url: "getCourseInfo.php?courseID=" + courseID,
			type: "GET",
			context: document.body,
			success: updateCourseData,
		});
	}
}

function setsChange()
{
	setID = $("#set").val();
	
	if (setID == "--New--")
	{
		setID = -1;
	}
	
	$.ajax({
		url: "getSetInfo.php?setID=" + setID,
		type: "GET",
		context: document.body,
		success: updateSetData,
	});
}

function updateSetData(data, textStatus, jqXHR) 
{
	$("#setCourses").html(data);
	
	$("#setName").val($("#getSetName").val());
}

function updateSetCourses(data, textStatus, jqXHR)
{
	courseAdd = $("#courseAdd");
	courseAdd.html("<option>--Select--</option>\n" + data);
}

function setDeptSelect()
{
	departmentID = $("#setDept").val();
	$.ajax({
		url: "getCourses.php?departmentID=" + departmentID,
		type: "GET",
		context: document.body,
		success: updateSetCourses,
	});
}

function addCourseToSet()
{
	var numCourses = parseInt($("#numCourses").val());
	
	var course = $("#courseAdd");
	var courseSelected = $("#courseAdd option:selected");
	
	var dept = $("#setDept");
	var deptSelected = $("#setDept option:selected");
	
	if (deptSelected.text() == "--Select--" || courseSelected.text() == "--Select--")
	{
		return;
	}
	
	courseTR = $("<tr id='tr_" + numCourses + "'>");
	courseTR.append($("<td>" + deptSelected.text() + " " + courseSelected.text() + "</td>"));
	
	dataTD = $("<td>");
	dataTD.append($("<input type='hidden' id='status_" + numCourses + "' name='status_" + numCourses + "' value='new' />"));
	dataTD.append($("<input type='hidden' id='courseID_" + numCourses + "' name='courseID_" + numCourses + "' value='" + course.val() + "' />"));
	dataTD.append($("<button type='button' onclick='removeCourseFromSet(" + numCourses + ");'>Remove</button>"));
	courseTR.append(dataTD);
	
	$("#tr_end").before(courseTR);
	
	dept.val("--Select--");
	
	course.html("<option>--Select--</option>");
	course.val("--Select--");
	
	$("#numCourses").val(numCourses + 1);
}

function removeCourseFromSet(courseRowIndex)
{	
	var status = $("#status_" + courseRowIndex);
	if (status.val() == "exists")
	{
		status.val("deleted");
	}
	else
	{
		status.val("gone");
	}
	$("#tr_" + courseRowIndex).hide();
}

function userChange()
{
	var user = $("#user option:selected");
	
	$("#userRole").val(users[user.attr("index")]["roleID"]);
}

function updateRolePermissions(data, textStatus, jqXHR) 
{
	$("#rolePermissions").html(data);
}

function rolesChange()
{
	roleID = $("#role").val();
	
	if (roleID == "--New--")
	{
		roleID = -1;
		$("#roleName").val("");
	}
	else
	{
		$("#roleName").val($("#role option:selected").text());
	}
	
	$.ajax({
		url: "getPermissions.php?roleID=" + roleID,
		type: "GET",
		context: document.body,
		success: updateRolePermissions,
	});
}

function addPermissionToRole()
{
	var numPermissions = parseInt($("#numPermissions").val());
	
	var permission = $("#permission");
	var permissionSelected = $("#permission option:selected");
	
	if (permissionSelected.text() == "--Select--")
	{
		return;
	}
	
	permissionTR = $("<tr id='tr_perm_" + numPermissions + "'>");
	permissionTR.append($("<td>" + permissionSelected.text() + "</td>"));
	
	dataTD = $("<td>");
	dataTD.append($("<input type='hidden' id='status_perm_" + numPermissions + "' name='status_perm_" + numPermissions + "' value='new' />"));
	dataTD.append($("<input type='hidden' id='permissionID_perm_" + numPermissions + "' name='permissionID_perm_" + numPermissions + "' value='" + permission.val() + "' />"));
	dataTD.append($("<button type='button' onclick='removePermissionFromRole(" + numPermissions + ");'>Remove</button>"));
	permissionTR.append(dataTD);
	
	$("#tr_perm_end").before(permissionTR);
	
	permission.val("--Select--");
	
	$("#numPermissions").val(numPermissions + 1);
}

function removePermissionFromRole(permissionRowIndex)
{	
	var status = $("#status_perm_" + permissionRowIndex);
	if (status.val() == "exists")
	{
		status.val("deleted");
	}
	else
	{
		status.val("gone");
	}
	$("#tr_perm_" + permissionRowIndex).hide();
}
