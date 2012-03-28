var LOGIN_TIMEOUT = 5000;
var LOGIN_PAGE_TIMEOUT = 5000;

/* NT - Not tried
   TA - Trying Auto
   TM - Trying Manual
   Y - Yes
   N - No
   F - Failed */
var loggedIn = {"D2L":"NT", "My.BCIT":"NT"};
var loginPage = {"D2L":"navigator/postD2L.html", "My.BCIT":"navigator/postMyBCIT.html"};
var siteImages = {"D2L":"https://learn.bcit.ca/d2l/common/viewprofileimage.d2l?oi=6605&ui=323410&s=40&lm=634618536809400000&v=11&t=",
				  "My.BCIT":"https://my.bcit.ca/tag.idempotent.worker.carRsrc.target.u11l1n9.uP?carRsrc=com/sct/pipeline/uportal/channels/email/media/chan_email.gif&t="};

/*
$(document).ready(function(){
	$("#navigatorFrame").attr("onload", "safeLoad()");
});

function safeLoad()
{
	if (loggedIn['My.BCIT'] in {TA:1, TM:1} || loggedIn['D2L'] in {TA:1, TM:1})
	{
		$('#navigatorFrame').attr('src','');
	}
}*/

function imageLoaded(site)
{
	loggedIn[site] = "Y";
	
	loadSite();
}
	
function imageErrored(site)
{
	if (loggedIn[site] in {TA:1, TM:1})
	{
		loggedIn[site] = "F";
	}
	else
	{
		loggedIn[site] = "N";
	}
	
	loadLoginPage(site);
}

function loadLoginPage(site)
{
	var iFrame = $("#navigatorFrame");
	
	iFrame.one("load", function() { login(site); });
	iFrame.attr("src", loginPage[site]);
}

function login(site)
{
	var frame = $("#navigatorFrame");
	var frameContents = frame.contents();
	var password = $("#password").val();
	
	username = $("#userID").val();
	frameContents.find("#username").val(username);
	
	document.getElementById("navigatorFrame").contentWindow.submitted = function()
	{
		frame.one("load", function() { frame.attr('src',''); });

		setTimeout('isLoggedIn("' + site + '")', 1000);
	};
	
	if (password == "" || loggedIn[site] == "F")
	{
		if (loggedIn[site] == "F")
		{
			frameContents.find("#error").show();
		}
		frameContents.find("#hide").show();
		loggedIn[site] = "TM";
	}
	else
	{
		frameContents.find("#hide").hide();
		frameContents.find("#password").val(password);
		frameContents.find("#processLogonForm").submit();
		
		loggedIn[site] = "TA";
	}
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
	frame.src = "navigator/share.html";
	frame.contents().find("#path").html($("#course").val());
}

/*
	iFrame = document.getElementById("frame");
	iFrame.src = "protopost.html";
	
	loginInterval = setTimeout("loginPageLoaded('doGoD2L()')",100);
}

function doGoD2L()
{
	iFrame = document.getElementById("frame");
	
	txtMyPassword = document.getElementById("pass");
	txtPassword = iFrame.contentDocument.getElementById("password");

	txtUsername = iFrame.contentDocument.getElementById("username");
	fmLogin = iFrame.contentDocument.getElementById("processLogonForm");
	
	txtUsername.value = "A00802872";
	txtPassword.value = txtMyPassword.value;
	
	fmLogin.submit();
	
	attemptingLoginD2L = true;
}

function goMYBCIT()
{
	iFrame = document.getElementById("frame");
	iFrame.src = "protopost2.html";
	
	loginMYBCITInterval = setTimeout("loginPageLoaded('doGoMYBCIT()')",100);
}

function doGoMYBCIT()
{
	iFrame = document.getElementById("frame");
	
	txtMyPassword = document.getElementById("pass");
	txtPassword = iFrame.contentDocument.getElementById("password");

	txtUsername = iFrame.contentDocument.getElementById("username");
	fmLogin = iFrame.contentDocument.getElementById("processLogonForm");
	
	txtUsername.value = "A00802872";
	txtPassword.value = txtMyPassword.value;
	
	iFrame.contentDocument.getElementById("uuid").value = (new Date()).getTime() - (-9000);
	
	fmLogin.submit();
	
	attemptingLoginMYBCIT = true;
}

function checkLoggedInD2L(startTime,dest)
{
	now = new Date().getTime();
	
	if (loggedInD2L && loggedInD2LWaiting == false)
	{
		iFrame = document.getElementById("frame");
		iFrame.src = dest;
		log("done in inter. start: " + startTime + " End: " + now + " Total: " + (now - startTime) + " A: " + attemptingLoginD2L + " L: " + loggedInD2L + " Q: " + loggedInD2LWaiting);
		clearInterval(gotoD2L);
		attemptingLoginD2L = false;
	}
	else
	{	
		log("not done in inter. start: " + startTime + " End: " + now + " Total: " + (now - startTime) + " A: " + attemptingLoginD2L + " L: " + loggedInD2L + " Q: " + loggedInD2LWaiting);
		if (attemptingLoginD2L == false)
		{
			goD2L();
		}
		if ((now - startTime) > LOGIN_TIMEOUT)
		{
			log("not done timed out in inter. start: " + startTime + " End: " + now + " Total: " + (now - startTime) + " A: " + attemptingLoginD2L + " L: " + loggedInD2L + " Q: " + loggedInD2LWaiting);
			clearInterval(gotoD2L);
			attemptingLoginD2L = false;
		}
		else if (loggedInD2LWaiting == false)
		{
			tryLoggedInD2L();
		}
	}
}

function checkLoggedInMYBCIT(startTime,dest)
{
	now = new Date().getTime();
	
	if (loggedInMYBCIT && loggedInMYBCITWaiting == false)
	{
		iFrame = document.getElementById("frame");
		iFrame.src = dest;
		log("done in inter. start: " + startTime + " End: " + now + " Total: " + (now - startTime) + " A: " + attemptingLoginMYBCIT + " L: " + loggedInMYBCIT + " Q: " + loggedInMYBCITWaiting);
		clearInterval(gotoMYBCIT);
		attemptingLoginMYBCIT = false;
	}
	else
	{	
		log("not done in inter. start: " + startTime + " End: " + now + " Total: " + (now - startTime) + " A: " + attemptingLoginMYBCIT + " L: " + loggedInMYBCIT + " Q: " + loggedInMYBCITWaiting);
		if (attemptingLoginMYBCIT == false)
		{
			goMYBCIT();
		}
		if ((now - startTime) > LOGIN_TIMEOUT)
		{
			log("not done timed out in inter. start: " + startTime + " End: " + now + " Total: " + (now - startTime) + " A: " + attemptingLoginMYBCIT + " L: " + loggedInMYBCIT + " Q: " + loggedInMYBCITWaiting);
			clearInterval(gotoMYBCIT);
			attemptingLoginMYBCIT = false;
		}
		else if (loggedInMYBCITWaiting == false)
		{
			tryLoggedInMYBCIT();
		}
	}
}

function gotoWhenLoggedInD2L(dest)
{
	startTime = new Date().getTime();
	log("start:" + startTime);
	tryLoggedInD2L();
	gotoD2L = setInterval('checkLoggedInD2L(' + startTime + ', "' + dest + '")', 1000);
}

function gotoWhenLoggedInMYBCIT(dest)
{
	startTime = new Date().getTime();
	log("start:" + startTime);
	tryLoggedInMYBCIT();
	gotoMYBCIT = setInterval('checkLoggedInMYBCIT(' + startTime + ', "' + dest + '")', 1000);
}

function goCourse()
{
	url = document.getElementById("course").value;
	if (url != "--Select--")
	{
		log("Attempting " + url + " ...");
		if (url.indexOf("learn.bcit.ca") != -1)
		{
			gotoWhenLoggedInD2L(url);
		}
		else if (url.indexOf("my.bcit.ca") != -1)
		{
			gotoWhenLoggedInMYBCIT(url);
		}
		else
		{
			alert("Url should be impossible: " + url);
		}
	}
}

function tryLoggedInD2L()
{
	loggedInD2LWaiting = true;
	var img = document.getElementById("loggedInD2L");
	img.src = "https://learn.bcit.ca/d2l/common/viewprofileimage.d2l?oi=6605&ui=323410&s=40&lm=634618536809400000&v=11&t=" + new Date().getTime();
}

function tryLoggedInMYBCIT()
{
	loggedInMYBCITWaiting = true;
	var img = document.getElementById("loggedInMYBCIT");
	img.src = "https://my.bcit.ca/tag.idempotent.worker.carRsrc.target.u11l1n9.uP?carRsrc=com/sct/pipeline/uportal/channels/email/media/chan_email.gif&t=" + new Date().getTime();
}*/