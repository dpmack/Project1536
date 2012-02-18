<?php
include "helpers/auth.php";
include "templates/head.php";
include "helpers/embededLogin.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 

$headContent = "<link rel='stylesheet' type='text/css' href='css/terms.css' />";
echo buildHead("Terms & Conditions", $headContent);

?>
<body>

<?php include "templates/header.php"; ?>

	<div id="bodyWrap">
		<div id="termsConditions">
			<h2>Terms &amp; Conditions</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus bibendum pharetra. 
			Donec sodales aliquam mi, et lacinia risus adipiscing eu. Aliquam erat volutpat. 
			Mauris in odio nec ligula accumsan faucibus. Donec ullamcorper libero vitae neque blandit rhoncus. 
			Duis ac diam ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. 
			Donec a orci lectus, in ornare est. Nulla magna urna, sollicitudin id porta vitae, hendrerit non justo. 
			Vestibulum lacinia, libero fermentum rhoncus scelerisque, lacus eros posuere risus, viverra cursus nunc neque ac massa. 
			Donec vel odio libero, sit amet elementum augue. Curabitur aliquet accumsan erat, congue dignissim risus accumsan ut. 
			Aliquam mollis, est et congue dignissim, eros magna ornare magna, quis rhoncus neque quam non sem. 
			Fusce sit amet accumsan ipsum. Donec luctus cursus pellentesque. Quisque vel bibendum orci. Nullam vel tincidunt erat.
			Nullam eleifend porttitor nisi nec hendrerit. Sed eget lorem nec ipsum imperdiet consequat non quis orci. 
			Aliquam imperdiet turpis eu ipsum egestas faucibus. Nam enim arcu, interdum sed faucibus at, suscipit nec felis. 
			Morbi ut augue tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
			Nulla varius, urna et dapibus aliquet, massa mi bibendum dolor, at fringilla massa ante vel orci.
			Phasellus scelerisque, nunc vel tincidunt commodo, nunc magna iaculis neque, et iaculis tortor urna sit amet lorem. 
			Praesent eros elit, pellentesque a aliquam a, aliquet congue sem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
			Sed at elit mauris, et vehicula ipsum. Donec rutrum ipsum ac elit ornare non ornare purus ultricies. 
			Mauris volutpat enim quis felis suscipit sit amet suscipit urna pretium. Vestibulum tincidunt neque a nisi venenatis sollicitudin. 
			Nullam est leo, sagittis in gravida vitae, vestibulum a nulla. Pellentesque quis est ante. Mauris suscipit elementum lectus, vehicula interdum dui lobortis facilisis.
			Vestibulum placerat risus dapibus mi dignissim convallis. Curabitur vulputate convallis metus vitae dignissim. 
			Quisque quis vulputate nunc. Sed elementum commodo est adipiscing sollicitudin. Sed mattis tellus eget libero fringilla vel tempor elit consequat. Maecenas quam magna, venenatis et mattis quis, feugiat ut lectus. Phasellus magna tortor, volutpat a euismod et, sollicitudin feugiat tortor. Suspendisse lacinia sem sed metus semper vitae luctus ipsum pharetra. Curabitur fringilla, velit vitae viverra malesuada, ante lacus tincidunt justo, et adipiscing elit magna a nisi. Duis quis libero ac felis lacinia vestibulum eget tempus risus. Aliquam ac risus id lacus accumsan consectetur eget vel metus. Mauris a tincidunt leo.
			</p>
			<form action="http://webdevfoundations.net/scripts/formdemo.asp">
				<input type="submit" value="I Agree"/>
			</form>
		</div>
	</div>
<?php include "templates/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "templates/sqlDebug.php";
}
?>	
</body>

</html>