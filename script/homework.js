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
		timeTilDue = $("#homeworkdiv_" + i + " .timeTilDue");
		if (timeTilDue.css("color") == "rgb(255, 0, 0)")
		{
			homeworkDiv.style.display = "none";
		}
	}
	ajaxHomework.open("GET", "/ajax/updatehomework.php?homeworkID=" + i + "&homeworkStatus=" + homeworkStatus);
	ajaxHomework.send();
}

function departmentChange()
{
	departmentID = $("#dept").val();
	$.ajax({
		url: "/ajax/getCourses.php?departmentID=" + departmentID,
		type: "GET",
		context: document.body,
		success: updateCourses,
	});
}

function updateCourses(data, textStatus, jqXHR)
{
	$("#course").html("<option>--Select--</option>\n" + data);
}