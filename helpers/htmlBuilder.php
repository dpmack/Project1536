<?php

class HTML
{
	public static function title($titleName)
	{
		return "<title>" . $titleName . "</title>";
	}

	public static function html($content)
	{
		return "<html>" . $content . "</html>";
	}

	public static function head($content)
	{
		return "<head>" . $content . "</head>";
	}

	public static function meta($attr)
	{
		return "<meta " . $attr . " />";
	}
	
	public static function link($rel, $type, $href)
	{
		return "<link rel='" . $rel . "' type='" . $type . "' href='" . $href . " />";
	}
}
?>