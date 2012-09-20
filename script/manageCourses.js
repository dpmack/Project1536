var courses = {};

function updateCourses(data, textStatus, jqXHR)
{
	course = $("#course");
	course.html("<option>--Select--</option>\n" + data);
	course.val("--Select--");
}

function deptSelect()
{
	departmentID = $("#dept").val();
	$.ajax({
		url: "/ajax/getCourses.php?departmentID=" + departmentID,
		type: "GET",
		context: document.body,
		success: updateCourses,
	});
}


function updateSetCourses(data, textStatus, jqXHR)
{
	courses = jQuery.parseJSON(data);
	
	rec = $("#recomended");
	rec.html("");
	
	for (courseIndex in courses)
	{
		course = courses[courseIndex];
		courseName = course["departmentName"] + " " + course["courseCode"];
		if (course["displayName"] !== "")
		{
			courseName += " - " + course["displayName"];
		}
		div = $("<div id='rec_" + course["courseID"] + "' onclick='clickedRecCourse(" + course["courseID"] + ")'>");
		div.html("<input type='checkbox' id='check_rec_" + course["courseID"] + "' value='" + courseName + "' />" + courseName);
		
		check = $("#check_chosen_" + course["courseID"]);
		if (check.length == 1 && check.attr("checked"))
		{
			div.hide();
		}
		
		rec.append(div);
	}
}

function setSelected()
{
	setID = $("#set").val();
	
	if (setID === "--Select--")
	{
		$("#recomended").html("<u>Select a Set</u>");
		return;
	}
	$.ajax({
		url: "/ajax/getSetCourses.php?setID=" + setID,
		type: "GET",
		context: document.body,
		success: updateSetCourses,
	});
}


function clickedAddCourse()
{
	course = $("#course");
	if (course.val() == "--Select--")
	{
		return;
	}
	
	addCourse(course.val(), $("#dept option:selected").text() + " " + $("#course option:selected").text());
}

function clickedRecCourse(courseID)
{
	course = $("#rec_" + courseID);
	course.hide();
	
	check = $("#check_rec_" + courseID);

	addCourse(courseID, check.val());
}

function selectAll()
{
	for (courseIndex in courses)
	{
		clickedRecCourse(courses[courseIndex]["courseID"]);
	}
}

function addCourse(courseID,courseName)
{	
	chosen = $("#chosen_" + courseID);
	
	if (chosen.length == 1)
	{
		chosen.show();
		check = $("#check_chosen_" + courseID);
		check.attr("checked",true);
		check.attr("name", "" + courseID);
	}
	else
	{
		chosen = $("<div id='chosen_" + courseID + "' onclick='removeCourse(" + courseID + ")'>\n" +
				   "<input type='checkbox' name='check_chosen_" + courseID + "' value='" + courseID + "' id='check_chosen_" + courseID + "' checked='checked' />" +
				   courseName + "</div>");
		$("#chosen").append(chosen);
	}
}

function removeCourse(courseID)
{
	chosen = $("#chosen_" + courseID);
	
	chosen.hide();
	check = $("#check_chosen_" + courseID);
	check.attr("checked",false);
	check.removeAttr("name");
	
	rec = $("#rec_" + courseID);
	
	if (rec.length == 1)
	{
		rec.show();
		check = $("#check_rec_" + courseID);
		check.attr("checked",false);
	}
}
