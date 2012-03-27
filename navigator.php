<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

if (!$GLOBALS["loggedIn"]) // this protects the page from all non auth ppl
{
	include "error/notloggedin.php";
	die();
}
?>

<?php
$headContent = "<script type='text/javascript' src='script/navigator.js'></script>"; //if needing to add extra css files
echo buildHead("Navigator",$headContent);
?>
<body>


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
	
</script>

	Password: <input type="password" id="password" />
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
	<iframe id="frame" src="protopost.html" style="height:90%;width:100%;border:none;" onload="if (attemptingLoginMYBCIT) {document.getElementById('frame').src = '';}"></iframe>
	<img id="loggedInD2L" style="display: none" onload="d2lImageLoad();" onerror="d2lImageError();" src="" />
	<img id="loggedInMYBCIT" style="display: none" onload="mybcitImageLoad();" onerror="mybcitImageError();" src="" />
	<div id="log"> </div>
</body>
</html>