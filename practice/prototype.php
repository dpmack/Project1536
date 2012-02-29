<?php
$courses = array();
$obj = array();
$obj['name'] = "COMP 1536 Lecture";
$obj['url'] = "https://learn.bcit.ca/d2l/lp/homepage/home.d2l?ou=60690";
$courses[] = $obj;

$obj = array();
$obj['name'] = "COMP 1536 Lab";
$obj['url'] = "https://learn.bcit.ca/d2l/lp/homepage/home.d2l?ou=66644";
$courses[] = $obj;

$obj = array();
$obj['name'] = "COMP 1100";
$obj['url'] = "https://learn.bcit.ca/d2l/lp/homepage/home.d2l?ou=58260";
$courses[] = $obj;

$obj = array();
$obj['name'] = "BUSA 2720 Lecture";
$obj['url'] = "https://learn.bcit.ca/d2l/lp/homepage/home.d2l?ou=66632";
$courses[] = $obj;

$obj = array();
$obj['name'] = "COMP 1113 Lecture";
$obj['url'] = "https://my.bcit.ca/jsp/grouptools/home/HomePage.jsp?groupID=45760";
$courses[] = $obj;
?>
<html>
<body>
<script type="text/javascript">
	var LOGIN_TIMEOUT = 5000;
	var loggedInD2L = true;
	var loggedInD2LWaiting = true;
	var gotoD2L = null;
	var loginInterval = null;
	var attemptingLoginD2L = false;
	
	var loggedInMYBCIT = true;
	var loggedInMYBCITWaiting = true;
	var gotoMYBCIT = null;
	var loginMYBCITInterval = null;
	var attemptingLoginMYBCIT = false;
	
	function log(m)
	{
		var logDiv = document.getElementById("log");
		logDiv.innerHTML += m + "<br />";
	}
	
	function d2lImageLoad()
	{
		loggedInD2L = true;
		loggedInD2LWaiting = false;
	}
		
	function d2lImageError()
	{
		loggedInD2L = false;
		loggedInD2LWaiting = true;
	}
	
	function mybcitImageLoad()
	{
		loggedInMYBCIT = true;
		loggedInMYBCITWaiting = false;
	}
	
	function mybcitImageError()
	{
		loggedInMYBCIT = false;
		loggedInMYBCITWaiting = true;
	}
	
	function loginPageLoaded(callback)
	{
		iFrame = document.getElementById("frame");
		
		while (true)
		{
			try
			{
				txtPassword = iFrame.contentDocument.getElementById("password");
				break;
			}
			catch(e)
			{
				//hi jake
			}
		}
		
		setTimeout(callback,0);
		clearInterval(loginInterval);
	}
	
	function goD2L()
	{
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
		
		loginMYBCITInterval = setInterval("loginPageLoaded('doGoMYBCIT()')",100);
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
		
		iFrame.src = "";
		
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
	}
</script>

	Password: <input type="password" id="pass" />
	<select id="course" onchange="goCourse()">
		<option>--Select--</option>
	<?php
		foreach ($courses as $option)
		{
			echo "		<option value='" . $option["url"] . "'>" . $option["name"] . "</option>\n";
		}
	?>
	</select>
	<br />
	<iframe id="frame" src="protopost.html" style="height:90%;width:100%;border:none;"></iframe>
	<img id="loggedInD2L" style="display: none" onload="d2lImageLoad();" onerror="d2lImageError();" src="" />
	<img id="loggedInMYBCIT" style="display: none" onload="mybcitImageLoad();" onerror="mybcitImageError();" src="" />
	<div id="log"> </div>
	
	<iframe id="_top" name="_top"></iframe>
</body>
</html>