<?php

function buildHeader($title, $content="")
{
	return '
	<head>
		<title>CSTHub - ' . $title . '</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<link rel="stylesheet" type="text/css" href="css/reset.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/color.css" />
		' . $content . '
</head>';
}
?>


