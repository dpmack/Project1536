var tool = "line";
var canvas;
var context;

var clicks = new Array();
clicks["me"] = new Array();
clicks["me"]["color"] = "#df4b26";
clicks["me"]["cords"] = new Array();

clickRevision["me"] = -1;

var update;

 $(document).ready (function() {
	debug = $("#debug");
	canvas = $("#drawBoard");
	canvas.mousedown(down);
	canvas.mouseup(up);
	context = document.getElementById('drawBoard').getContext("2d");
	update = setTimeout("sendUpdateRemote()",100);
})

function sendUpdateRemote()
{
	if (clickRevision["me"] == -1)
	{
		jmessage = -1;
	}
	else
	{
		jmessage = new Array();
		jmessage["rev"] = clickRevision;
		newRev = clicks["me"]["cords"];
		jmessage["data"] = clicks["me"]["cords"].slice(clickRevision["me"],newRev);
		clickRevision["me"] = newRev;
	}
		
	$.ajax({
		url: "whiteboard_ajax.php",
		type: "POST",
		context: document.body,
		success: getUpdate,
		data: JSON.stringify(jmessage)
	})
}

function getUpdate(data, textStatus, jqXHR)
{
	newData = JSON.parse(data);
	if (newData["me"] != null && newData["me"]["cords"] != null)
	{
		clicks["me"].concat(newData["me"]["cords"]);
	}
	
	for (var i = 0; i < newData.length; i++)
	{
		if (clicks[i] == null)
		{
			clicks[i] = newData[i];
		}
		else
		{
			clicks[i]["cords"].concat(newData[i]["cords"]);
		}
	}
	update = setTimeout("sendUpdateRemote()",100);
	if (newData != [])
	{
		redraw();
	}
}

function lineTool()
{
	tool = "line";
}

function freeTool()
{
	tool = "free";
}

function down(e)
{
	canvas.mousemove(move);
	
	var mouseX = e.pageX - this.offsetLeft;
	var mouseY = e.pageY - this.offsetTop;

	addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
	redraw();
}

function up(e)
{
	canvas.unbind("mousemove");
}

function move(e)
{
	addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
	redraw();
}

function addClick(x, y, dragging)
{
	temp = new Array();
	temp.push(x);
	temp.push(y);
	temp.push(dragging);
	clicks["me"]["cords"].push(temp);
}

function redraw()
{
	canvas.width = canvas.width; // Clears the canvas
  
	draw(clicks["me"]);

	for (var person = 0; person < clicks.length; person++)
	{
		draw(clicks[person]);
	}
}

function draw(click)
{
	if (click["color"] == null || click["cords"] == null)
	{
		return;
	}
	
	context.strokeStyle = click["color"];
	context.lineJoin = "round";
	context.lineWidth = 2;
			
	for(var i=0; i < click["cords"].length; i++)
	{		
		context.beginPath();
		if(click["cords"][i][2] && i){
			context.moveTo(click["cords"][i-1][0], click["cords"][i-1][1]);
		}else{
			context.moveTo(click["cords"][i][0]-1, click["cords"][i][1]);
		}
		context.lineTo(click["cords"][i][0], click["cords"][i][1]);
		context.closePath();
		context.stroke();
	}
}