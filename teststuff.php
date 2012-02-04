<html>
<body>
<form action="teststuff.php" method="POST">
<input name="pimpDoc" type="text" />+
<input name="seaWeed" type="text" />
<input type="submit" />
</form>
<?php
echo "Sea Weeeeeeeeeeed is gooooood for David!";
if (isset($_POST["pimpDoc"])&& isset($_POST["seaWeed"]))
{
	echo (float)($_POST["pimpDoc"]) + (float)($_POST["seaWeed"]);
	echo "<br/>";
	
	
}
?>

</body>
</html>