var paths = {};
var debug;
var socket;
var wsURL = "ws://localhost:9000";
var loggedIn = false;
var whiteboard;
var pages = {};
var accountID;
var lastPath = -1;

$(document).ready(function(){
	debug = $("#debug");
	
	whiteboard = 2; //$("#whiteboardID").value;
	accountID = $("#accountID").val();
	paths[accountID] = {}
	
	if ("WebSocket" in window) {
		socket = new WebSocket(wsURL);
    } else if ("MozWebSocket" in window) {
        socket = new MozWebSocket(wsURL);
    } else {
        log("Browser does not support WebSocket!");
    }
		
	socket.onopen = function()
	{
		log("Connected.");
		send("LOGIN " + readCookie("ticket"));
	};
	
	socket.onclose = function()
	{
		log("Closed.");
		loggedIn = false;
	};
		
	socket.onerror = function(error)
	{
		log("Error: " + error);
	};
		
	socket.onmessage = function(msg)
	{
		msg.data += " ";
		log(">>> " + msg.data);
		if (loggedIn == false)
		{
			if (msg.data == "OK")
			{
				send("SELECT " + whiteboard);
				loggedIn = true;
			}
			else
			{
				log(msg.data);
			}
		}
		else
		{
			index = msg.data.indexOf(" ");
			cmd = msg.data.slice(0,index);
			data = msg.data.slice(index+1);
			
			if (cmd == "CLEAR")
			{
				for (i = 0; i < lastPath; i++)
				{
					paths[i].removeSegments();
				}
				paths[accountID] = {}
				lastPath = -1;
			}
			else if (cmd == "PAGES")
			{
				//load pages
			}
			else if (cmd  == "UPDATE")
			{
				//get page data
			}
			else if (cmd  == "JOINED")
			{
				//person joined whiteboard
				personData = data.split(" ");
				if (typeof(paths[personData[0]]) == "undefined")
				{
					paths[personData[0]] = {};
				}
			}
			else if (cmd  == "MOVED")
			{
				//persom moved
			}
			else if (cmd  == "PNT")
			{
				pntData = data.split(" ");
				if (typeof(paths[pntData[0]][pntData[1]]) == "undefined")
				{
					paths[pntData[0]][pntData[1]] = new Path();
					paths[pntData[0]][pntData[1]].strokeColor = 'black';
				}
				paths[pntData[0]][pntData[1]].add(new Point(pntData[2], pntData[3]));
				paper.view.draw();
			}
			else if (cmd == "END")
			{
				pntData = data.split(" ");
				log("B" + paths[pntData[0]][pntData[1]].segments);
				paths[pntData[0]][pntData[1]].simplify(10);
				log("A" + paths[pntData[0]][pntData[1]].segments);
				paper.view.draw();
			}
			else
			{
				log("Error unknown command '" + cmd + "'.");
			}
		}
	};
});

//http://www.quirksmode.org/js/cookies.html
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function log(msg)
{
	debug.html(debug.html() + msg + "<br />");
}

function send(msg)
{
	log("<<< " + msg);
	socket.send(msg);
}

/*var textItem = new PointText(new Point(20, 55));
textItem.fillColor = 'black';
textItem.content = 'Click and drag to draw a line.';*/

function onMouseDown(event) {
    // If we produced a path before, deselect it:
    //if (path) {
    //    path.selected = false;
    //}

    // Create a new path and set its stroke color to black:
	lastPath += 1;
    paths[accountID][lastPath] = new Path();
    paths[accountID][lastPath].add(event.point);
    paths[accountID][lastPath].strokeColor = 'black';
	
	send("PNT " + lastPath + " " + event.point.x + " " + event.point.y);

    // Select the path, so we can see its segment points:
    //path.fullySelected = true;
}

// While the user drags the mouse, points are added to the path
// at the position of the mouse:
function onMouseDrag(event) {
    paths[accountID][lastPath].add(event.point);
	
	send("PNT " + lastPath + " " + event.point.x + " " + event.point.y);
	log("PNTDATA " + event.point);

    // Update the content of the text item to show how many
    // segments it has:
    //textItem.content = 'Segment count: ' + path.segments.length;
}

// When the mouse is released, we simplify the path:
function onMouseUp(event) {
    // When the mouse is released, simplify it:
    paths[accountID][lastPath].simplify(10);

    // Select the path, so we can see its segments:
    //path.fullySelected = true;

	send("END " + lastPath + " " + paths[accountID][lastPath].segments);

    //var newSegmentCount = path.segments.length;
    //var difference = segmentCount - newSegmentCount;
    //var percentage = 100 - Math.round(newSegmentCount / segmentCount * 100);
    //textItem.content = difference + ' of the ' + segmentCount + ' segments were removed. Saving ' + percentage + '%';
}

/*var tool = "line";
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
}*/