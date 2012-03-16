function toggleStrikeOut(i)
{
	ajaxHomework = new XMLHttpRequest();
	homeworkDiv = document.getElementById("homeworkdiv_" + i);
	homeworkStatus = "";
	if(homeworkDiv.style.textDecoration == "line-through")
	{
		homeworkDiv.style.textDecoration = "";
		homeworkStatus = "todo";
	}
	else
	{
		homeworkDiv.style.textDecoration = "line-through";
		homeworkStatus = "done";
	}
	ajaxHomework.open("GET", "updatehomework.php?homeworkID=" + i + "&homeworkStatus=" + homeworkStatus);
	ajaxHomework.send();
}

function departmentChange()
{
	departmentID = $("#dept").val();
	$.ajax({
		url: "getCourses.php?departmentID=" + departmentID,
		type: "GET",
		context: document.body,
		success: updateCourses,
	});
}

function updateCourses(data, textStatus, jqXHR)
{
	$("#course").html(data);
}