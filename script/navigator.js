var LOGIN_TIMEOUT = 1000;
var LOGIN_PAGE_TIMEOUT = 5000;

/* NT - Not tried
   TA - Trying Auto
   Y - Yes
   N - No
   F - Failed */
var loggedIn = {"D2L":"NT", "My.BCIT":"NT"};
var loginPage = {"D2L":"navigator/postD2L.html", "My.BCIT":"navigator/postMyBCIT.html"};
var siteImages = {"D2L":"https://learn.bcit.ca/d2l/common/viewprofileimage.d2l?oi=6605&ui=323751&s=100&lm=634685911407100000&v=11&t=",
				  "My.BCIT":"https://my.bcit.ca/tag.idempotent.worker.carRsrc.target.u11l1n9.uP?carRsrc=com/sct/pipeline/uportal/channels/email/media/chan_email.gif&t="};
var loginWindow = null;

function imageLoaded(site)
{
	$("#spanPassword").removeClass("error");
	
	loggedIn[site] = "Y";
	
	loadSite();
}
	
function imageErrored(site)
{	
	$("#spanPassword").removeClass("error");
	
	if (loggedIn[site] == "TA")
	{
		loggedIn[site] = "F";
		$("#spanPassword").addClass("error");
		$("#navigatorFrame").attr("src","");
	}
	else if (loggedIn[site] == "NT")
	{
		loadLoginPage(site);
	}
	else
	{
		loggedIn[site] = "N";
	}
}

function loadLoginPage(site)
{
	if (loginWindow && !loginWindow.closed)
	{
		loginWindow.close()
	}
	loginWindow = window.open(loginPage[site]);
	
	pollWindow = function()
	{
		if (loginWindow.document.readyState == "complete" && loginWindow.document.getElementById("username") != null)
		{
			login(site);
		}
		else
		{
			setTimeout("pollWindow()", 100);
		}
	}
	
	pollWindow();
}

function login(site)
{
	var frame = $("#navigatorFrame");
	var frameContents = loginWindow.document;
	var password = $("#password").val();
	
	username = $("#userID").val();
	frameContents.getElementById("username").value = username;
	
	closeWindow = function()
	{
		loginWindow.close();
		if (!loginWindow.closed)
		{
			setTimeout("closeWindow()", 100);
		}
	};
	
	oldLoc = loginWindow.location;
	pollWindowLoc = function()
	{
		try
		{
			if (loginWindow.location != oldLoc)
			{
				setTimeout("isLoggedIn('" + site + "');closeWindow();", LOGIN_TIMEOUT);
			}
			else
			{
				setTimeout("pollWindowLoc()", 100);
			}
		}
		catch(e)
		{
			setTimeout("isLoggedIn('" + site + "');closeWindow();", LOGIN_TIMEOUT);
		}
	};
	
	frameContents.getElementById("hide").style.display = "none";
	frameContents.getElementById("password").value = password;
	
	if (site == "My.BCIT")
	{
		frameContents.getElementById("uuid").value = ((new Date()).getTime() - delta);
	}
	frameContents.getElementById("processLogonForm").submit();
	
	loggedIn[site] = "TA";
	
	pollWindowLoc();
}

function isLoggedIn(site)
{
	image = $("#image");
	image.attr("onload","imageLoaded('" + site + "');");
	image.attr("onerror","imageErrored('" + site + "');");
	image.attr("src",siteImages[site] + new Date().getTime());
}

function goCourse()
{
	courseSelect = $("#course option:selected");
	
	if ($("#course").val() == "--Select--")
	{
		$("#navigatorFrame").attr("src","");
		return;
	}
	
	loc = courseSelect.attr("location");
	
	if (loc == "Share")
	{
		loadShare();
	}
	else
	{
		loggedIn = {"D2L":"NT", "My.BCIT":"NT"};
		isLoggedIn(loc);
	}
}

function loadSite()
{
	courseSelect = $("#course");
	
	$("#navigatorFrame").attr("src", courseSelect.val());
}

function loadShare()
{
	frame = $("#navigatorFrame");
	frame.attr("src","navigator/share.html");
	frame.one("load", function()
	{
		frame.contents().find("#path").html($("#course").val());
	});
}