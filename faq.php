<?php
include "helpers/auth.php";
include "templates/head.php";
include "helpers/embededLogin.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php 
$headContent = "<link rel='stylesheet' type='text/css' href='css/faq.css' />";
echo buildHead("FAQ", $headContent);
?>
<body>

<?php include "templates/header.php"; ?>

	<div id="bodyWrap">
		<a id="topPage"></a>
		<p id="faqTitle">FAQs</p>
		<ul id="faqTOC">
			<li><a href="#howTo" onclick="showHowToVid()">How does this site work?</a></li>
			<li><a href="#registeredAlready">What if my student ID is already registered?</a></li>
			<li><a href="#forgotPassword">What if I forgot my password?</a></li>
			<li><a href="#blah">Fill me in later...</a></li>
		</ul>
		<hr />
		<a id="howTo" class="faqHeading">&nbsp;How does this Site work?</a>
		<!--<div align="center">
			<a id="howTo" class="faqHeading">&nbsp;How does this Site work?</a>
		</div>-->
		<p>&nbsp;The provided video below is a simple to follow guide on how to use this web site. It will provide you with the necessary tools to find exactly what you're looking for.</p>
		<p>&nbsp;This site is here to provide not only new CST students, but returning students alike, with a centralized access point.</p>
		<p>&nbsp;Run by CST students, for CST students, here you will find guides to each professor's used methods for transfering information.</p>
		<p>&nbsp;For example: Benjamin Yu (COMP 1536) favors the use of D2L. Under the class section of our site, you'll be able to see exactly where to go for each professor.</p>
		
		<!--
		<p>&nbsp;The provided video below is a simple to follow guide on how to use this web site. It will provide you with the necessary tools to find exactly what you're looking for.
		&nbsp;This site is here to provide not only new CST students, but returning students alike, with a centralized access point.
		&nbsp;Run by CST students, for CST students, here you will find guides to each professor's used methods for transfering information.
		&nbsp;For example: Benjamin Yu (COMP 1536) favors the use of D2L. Under the class section of our site, you'll be able to see exactly where to go for each professor.</p>
		-->
		<!--
		<ul>
			<li>The provided video below is a simple to follow guide on how to use this web site. It will provide you with the necessary tools to find exactly what you're looking for.</li>
			<li>This site is here to provide not only new CST students, but returning students alike, with a centralized access point.</li>
			<li>Run by CST students, for CST students, here you will find guides to each professor's used methods for transfering information.</li>
			<li>For example: Benjamin Yu (COMP 1536) favors the use of D2L. Under the class section of our site, you'll be able to see exactly where to go for each professor.</li>
		</ul>
		-->
		<p>Try this now. </p>
		<div>
			<span id="howToVidHid" style="border:1px solid; padding: 5px;">
			<span onclick="showHowToVid()">Show video</span>
			</span>
			
			<br />
		
			<div id="howToVid" style="display:none">
				<iframe width="560" height="315" src="http://www.youtube.com/embed/Hx2jt0IyFxY" 
				frameborder="0"></iframe>
			</div>
		</div>
		<br />
		
		<a href="#topPage">Top</a>
		
		<br /><br />
		
		<a id="registeredAlready" class="faqHeading">&nbsp;What if my student ID is already registered?</a>
		<!--<div align="center">
			<a id="#registeredAlready" class="faqHeading">&nbsp;What if my student ID is already registered?</a>
		</div>-->
		<p>
			Stealing and/or using another student's ID is identity theft and is against this site's terms and conditions.
			Any persons caught stealing, attempting to steal, or using another student's ID in a malicious manner will be reported to the authorities.
			Should this situation arise, please fill out the form below and a meeting can be arranged for in person verification of ID.
		</p>
		<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In et tortor quis elit ullamcorper tincidunt. Pellentesque facilisis libero sed urna luctus blandit. Mauris nec dolor non dui tincidunt posuere ut sed erat. In ut nulla dui. Aenean non urna diam, a ullamcorper lectus. Donec ut elit sapien, sit amet commodo libero. Ut aliquam dapibus risus, id luctus lacus accumsan nec. Nullam sit amet ante nisi. Etiam ut enim ac nisi placerat ultrices. </p>
<p> Nam lacinia iaculis quam, in egestas nisl vulputate in. Duis neque neque, adipiscing ut hendrerit a, porttitor at tortor. Donec porttitor lobortis aliquam. Morbi sodales neque sed nibh fringilla non volutpat turpis sollicitudin. Quisque id purus nisl, sed tincidunt nisl. Pellentesque pellentesque erat at elit fermentum sed facilisis lectus aliquet. Donec nisl arcu, iaculis vel facilisis scelerisque, consequat nec massa. Praesent ultricies magna id diam ultrices condimentum. Phasellus tempor nulla ac metus venenatis tincidunt. Nulla porta neque adipiscing tellus ullamcorper luctus. </p>
<p> Curabitur tristique egestas tellus ut convallis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut varius elit sit amet orci congue a commodo sem semper. Pellentesque mattis odio a tellus sagittis tristique. In sed neque at dolor porttitor tempor. Suspendisse enim metus, ultrices vel viverra vel, scelerisque a ipsum. Ut pulvinar convallis malesuada. Curabitur molestie euismod ipsum vitae interdum. Fusce non eleifend justo. Aenean eget felis a risus sollicitudin tempus. Sed a ante magna, vitae tincidunt nulla. </p>
<p> Vivamus ultricies nunc nec est tincidunt at mollis metus viverra. Maecenas et accumsan elit. Vestibulum nulla erat, eleifend non dapibus eu, gravida eu enim. Cras iaculis sodales tincidunt. Cras placerat risus ultricies leo venenatis rutrum hendrerit felis mattis. Fusce est nulla, sagittis ac convallis condimentum, placerat vel nisl. Suspendisse potenti. Integer faucibus vestibulum erat, in faucibus lorem dignissim at. Duis molestie iaculis tempor. Suspendisse lectus ligula, fermentum eget accumsan a, placerat et leo. Sed posuere congue turpis, eget egestas sapien vehicula sit amet. Maecenas consectetur sem sed dolor sodales ultricies. Donec molestie tincidunt sem, eget facilisis nisl pharetra at. Sed scelerisque, erat at varius porttitor, felis neque lacinia tortor, vitae tincidunt leo augue id nisl. Morbi sit amet ante sapien, non pharetra sem. </p>
<p> Vivamus interdum viverra mattis. Donec felis metus, elementum at egestas vel, congue a sem. Maecenas laoreet faucibus semper. Proin consequat, erat ac pharetra ullamcorper, est augue adipiscing tortor, a euismod diam nibh sed erat. Sed tincidunt turpis et turpis posuere in commodo velit ullamcorper. Praesent varius lobortis leo, in aliquet mauris euismod vehicula. Nulla congue pellentesque urna auctor ullamcorper. Sed risus lorem, mollis eu ullamcorper non, posuere a nisi. Curabitur feugiat, massa in porta vulputate, odio nisi hendrerit lectus, sit amet auctor nulla tortor molestie magna. Nunc scelerisque, libero non gravida lobortis, libero arcu sodales erat, ac consequat ligula sem quis enim. Cras augue lacus, pellentesque at ultrices eu, tincidunt id lorem. Sed egestas commodo pulvinar. Nam ac risus erat, eget aliquet est. Aliquam nec ante elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
		
		<a href="#topPage">Top</a>
		
		<br /><br />
		
		<a id="forgotPassword" class="faqHeading">&nbsp;What if I forgot my password?</a>
		<!--<div align="center">
			<a id="#forgotPassword" class="faqHeading">&nbsp;What if I forgot my password?</a>
		</div>-->
		<br />
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In et tortor quis elit ullamcorper tincidunt. Pellentesque facilisis libero sed urna luctus blandit. Mauris nec dolor non dui tincidunt posuere ut sed erat. In ut nulla dui. Aenean non urna diam, a ullamcorper lectus. Donec ut elit sapien, sit amet commodo libero. Ut aliquam dapibus risus, id luctus lacus accumsan nec. Nullam sit amet ante nisi. Etiam ut enim ac nisi placerat ultrices. </p>
			<p> Nam lacinia iaculis quam, in egestas nisl vulputate in. Duis neque neque, adipiscing ut hendrerit a, porttitor at tortor. Donec porttitor lobortis aliquam. Morbi sodales neque sed nibh fringilla non volutpat turpis sollicitudin. Quisque id purus nisl, sed tincidunt nisl. Pellentesque pellentesque erat at elit fermentum sed facilisis lectus aliquet. Donec nisl arcu, iaculis vel facilisis scelerisque, consequat nec massa. Praesent ultricies magna id diam ultrices condimentum. Phasellus tempor nulla ac metus venenatis tincidunt. Nulla porta neque adipiscing tellus ullamcorper luctus. </p>
			<p> Curabitur tristique egestas tellus ut convallis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut varius elit sit amet orci congue a commodo sem semper. Pellentesque mattis odio a tellus sagittis tristique. In sed neque at dolor porttitor tempor. Suspendisse enim metus, ultrices vel viverra vel, scelerisque a ipsum. Ut pulvinar convallis malesuada. Curabitur molestie euismod ipsum vitae interdum. Fusce non eleifend justo. Aenean eget felis a risus sollicitudin tempus. Sed a ante magna, vitae tincidunt nulla. </p>
			<p> Vivamus ultricies nunc nec est tincidunt at mollis metus viverra. Maecenas et accumsan elit. Vestibulum nulla erat, eleifend non dapibus eu, gravida eu enim. Cras iaculis sodales tincidunt. Cras placerat risus ultricies leo venenatis rutrum hendrerit felis mattis. Fusce est nulla, sagittis ac convallis condimentum, placerat vel nisl. Suspendisse potenti. Integer faucibus vestibulum erat, in faucibus lorem dignissim at. Duis molestie iaculis tempor. Suspendisse lectus ligula, fermentum eget accumsan a, placerat et leo. Sed posuere congue turpis, eget egestas sapien vehicula sit amet. Maecenas consectetur sem sed dolor sodales ultricies. Donec molestie tincidunt sem, eget facilisis nisl pharetra at. Sed scelerisque, erat at varius porttitor, felis neque lacinia tortor, vitae tincidunt leo augue id nisl. Morbi sit amet ante sapien, non pharetra sem. </p>
			<p> Vivamus interdum viverra mattis. Donec felis metus, elementum at egestas vel, congue a sem. Maecenas laoreet faucibus semper. Proin consequat, erat ac pharetra ullamcorper, est augue adipiscing tortor, a euismod diam nibh sed erat. Sed tincidunt turpis et turpis posuere in commodo velit ullamcorper. Praesent varius lobortis leo, in aliquet mauris euismod vehicula. Nulla congue pellentesque urna auctor ullamcorper. Sed risus lorem, mollis eu ullamcorper non, posuere a nisi. Curabitur feugiat, massa in porta vulputate, odio nisi hendrerit lectus, sit amet auctor nulla tortor molestie magna. Nunc scelerisque, libero non gravida lobortis, libero arcu sodales erat, ac consequat ligula sem quis enim. Cras augue lacus, pellentesque at ultrices eu, tincidunt id lorem. Sed egestas commodo pulvinar. Nam ac risus erat, eget aliquet est. Aliquam nec ante elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
		<br />
		
		<a href="#topPage">Top</a>
		
		<br /><br />
		
		<script type="text/javascript">
			function showHowToVid()
			{
				document.getElementById("howToVid").style.display="";
				document.getElementById("howToVid").scrollIntoView(true);
				document.getElementById("howToVidHid").style.display="none";	
			}
		</script>
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