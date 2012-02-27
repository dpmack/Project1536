<?php

function buildHead($title, $content="")
{
	return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<title>CSTHub - ' . $title . '</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<link rel="stylesheet" type="text/css" href="css/reset.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/color.css" />
		<link rel="stylesheet" type="text/css" href="css/font.css" />
		<script type="text/javascript" src="script/jquery.js"></script>
		' . $content . '
</head>';
}
?>


