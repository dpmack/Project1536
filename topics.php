<?php
include 'helpers/auth.php';
include "helpers/head.php";
include "helpers/embededLogin.php";

// to create example data before db is set up
$topics = array();
$topics[0] = array();
$topics[0]["title"] = "Thread about how awesome CST is";
$topics[0]["postCount"] = "16";
$topics[0]["topicURL"] = "/viewtopic.php";

$topics[1] = array();
$topics[1]["title"] = "Thread about student get together lan party at lunch";
$topics[1]["postCount"] = "67";
$topics[1]["topicURL"] = "/viewtopic.php";

$topics[2] = array();
$topics[2]["title"] = "Various other thread";
$topics[2]["postCount"] = "145";
$topics[2]["topicURL"] = "/viewtopic.php";

$topics[3] = array();
$topics[3]["title"] = "David is awesome thread";
$topics[3]["postCount"] = "42";
$topics[3]["topicURL"] = "/viewtopic.php";
?>

<?php
$headContent = "<link rel='stylesheet' type='text/css' href='css/forums.css' />";
echo buildHead("Topics",$headContent);
?>
<body>
<?php
include "helpers/header.php";
$type = "Topics";
include "templates/topicGroup.template.php";
include "helpers/footer.php";

if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>
</body>	
</html>