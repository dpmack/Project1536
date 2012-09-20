<?
class Admin
{
	public static function AddError()
	{
		return (SQL::SingleQuery("INSERT INTO authErrors
(accountID, url, time)
VALUES (" . SQL::Safe($GLOBALS['accountID']) . ", " . SQL::Safe($_SERVER["PHP_SELF"]) . ", " . time() . ")") !== false);
	}
}
?>