<div id="sqlDebugToggle" style="position: fixed; top: 0; right: 0; color: red; width: auto;" onclick="toggleSQLDebug()">SQL</div>
<div id="sqlDebugDisplay" style="display:none; border: solid 1px; position: fixed; 
	top:20px; right:10px; background: white; padding: 10px; width: auto"><?php 
if ($GLOBALS['sql_debug_buffer'])
{
	echo str_replace("\n","<br />", $GLOBALS['sql_debug_buffer']);
}
else
{
	echo "No SQL executed";
}
?></div>

<script type="text/javascript">
	function toggleSQLDebug()
	{
		var sqlDiv = document.getElementById("sqlDebugDisplay");
		if (sqlDiv.style.display == "none")
		{
			sqlDiv.style.display = "";
		}
		else
		{
			sqlDiv.style.display = "none";
		}
	}
</script>
