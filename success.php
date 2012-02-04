<?php
include 'helpers/auth.php';
?>

<html>
<head>
<title>Login</title>
<?php
if (!$loggedin)
{
	echo "<META HTTP-EQUIV=Refresh CONTENT='0; URL=login.php'>";
}
?>
</head>
<body>
<?php
if ($loggedin)
{
	echo "Logged in.";
}
else
{
	echo "Not logged in.";
}
?>
</body>
</html>