<?php
include "helpers/auth.php";
include "helpers/head.php";
include "helpers/embededLogin.php";
?>

<?php 
$headContent = '';
echo buildHead("Help", $headContent);
?>
<body>
<?php
include "helpers/header.php";
?>

<div class="groupableSections">
	<div class="section">
		<h2>FAQ</h2>
		<a id="topPage"></a>
		<ul id="faqTOC">
			<li><a href="#howTo" onclick="showHowToVid()">How does this site work?</a></li>
			<li><a href="#registeredAlready">What if my student ID is already registered?</a></li> <?php /*
			<li><a href="#forgotPassword">What if I forgot my password?</a></li>
			<li><a href="#blah">Fill me in later...</a></li> */ ?>
		</ul>
	</div>
</div>


<div class="groupableSections">
<!-- some class name might make semantic sense here, e.x. ungroupableSections - jake -->
	<div class="section">
		<h2><a id="howTo" class="faqHeading">How does this Site work?</a></h2>

		<?php //<p>The provided video below is a simple to follow guide on how to use this web site. It will provide you with the necessary tools to find exactly what you're looking for.</p>
		?>
		<p>This site is here to provide not only new CST students, but returning students alike, with a centralized access point.</p>
		<p>Run by CST students, for CST students, here you will find guides to each professor's used methods for transfering information.</p>
		<p>For example: Benjamin Yu (COMP 1536) favors the use of D2L. Under the class section of our site, you'll be able to see exactly where to go for each professor.</p>
		
		<?php /*
		<p id="tryThis">Try this now. </p>
		<p id="howToVidHid">
			<button onclick="showHowToVid()">Show video</button>
 		</p>

		<div id="howToVid" style="display:none">
			<iframe width="560" height="315" src="http://www.youtube.com/embed/Hx2jt0IyFxY" 
			frameborder="0"></iframe>
		</div> */ ?>
		
		<p><a href="#topPage">Top</a></p>
	</div>
</div>

<div class="groupableSections">
	<div class="section">
		<h2><a id="registeredAlready" class="faqHeading">What if my student ID is already registered?</a></h2>
		<p>
			Stealing and/or using another student's ID is identity theft and is against this site's terms and conditions.
			Any persons caught stealing, attempting to steal, or using another student's ID in a malicious manner will be reported to the authorities.
			Should this situation arise, please contact us at <a href="mailto:csthub@gmail.com">csthub@gmail.com</a>.
		</p>
		
		<p><a href="#topPage">Top</a></p>
	</div>
	
	<?php /*
	<div class="section">
		<h2><a id="forgotPassword" class="faqHeading">What if I forgot my password?</a></h2>
		<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In et tortor quis elit ullamcorper tincidunt. Pellentesque facilisis libero sed urna luctus blandit. Mauris nec dolor non dui tincidunt posuere ut sed erat. In ut nulla dui. Aenean non urna diam, a ullamcorper lectus. Donec ut elit sapien, sit amet commodo libero. Ut aliquam dapibus risus, id luctus lacus accumsan nec. Nullam sit amet ante nisi. Etiam ut enim ac nisi placerat ultrices. </p>
		<p> Nam lacinia iaculis quam, in egestas nisl vulputate in. Duis neque neque, adipiscing ut hendrerit a, porttitor at tortor. Donec porttitor lobortis aliquam. Morbi sodales neque sed nibh fringilla non volutpat turpis sollicitudin. Quisque id purus nisl, sed tincidunt nisl. Pellentesque pellentesque erat at elit fermentum sed facilisis lectus aliquet. Donec nisl arcu, iaculis vel facilisis scelerisque, consequat nec massa. Praesent ultricies magna id diam ultrices condimentum. Phasellus tempor nulla ac metus venenatis tincidunt. Nulla porta neque adipiscing tellus ullamcorper luctus. </p>
		<p> Curabitur tristique egestas tellus ut convallis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut varius elit sit amet orci congue a commodo sem semper. Pellentesque mattis odio a tellus sagittis tristique. In sed neque at dolor porttitor tempor. Suspendisse enim metus, ultrices vel viverra vel, scelerisque a ipsum. Ut pulvinar convallis malesuada. Curabitur molestie euismod ipsum vitae interdum. Fusce non eleifend justo. Aenean eget felis a risus sollicitudin tempus. Sed a ante magna, vitae tincidunt nulla. </p>
		<p> Vivamus ultricies nunc nec est tincidunt at mollis metus viverra. Maecenas et accumsan elit. Vestibulum nulla erat, eleifend non dapibus eu, gravida eu enim. Cras iaculis sodales tincidunt. Cras placerat risus ultricies leo venenatis rutrum hendrerit felis mattis. Fusce est nulla, sagittis ac convallis condimentum, placerat vel nisl. Suspendisse potenti. Integer faucibus vestibulum erat, in faucibus lorem dignissim at. Duis molestie iaculis tempor. Suspendisse lectus ligula, fermentum eget accumsan a, placerat et leo. Sed posuere congue turpis, eget egestas sapien vehicula sit amet. Maecenas consectetur sem sed dolor sodales ultricies. Donec molestie tincidunt sem, eget facilisis nisl pharetra at. Sed scelerisque, erat at varius porttitor, felis neque lacinia tortor, vitae tincidunt leo augue id nisl. Morbi sit amet ante sapien, non pharetra sem. </p>
		<p> Vivamus interdum viverra mattis. Donec felis metus, elementum at egestas vel, congue a sem. Maecenas laoreet faucibus semper. Proin consequat, erat ac pharetra ullamcorper, est augue adipiscing tortor, a euismod diam nibh sed erat. Sed tincidunt turpis et turpis posuere in commodo velit ullamcorper. Praesent varius lobortis leo, in aliquet mauris euismod vehicula. Nulla congue pellentesque urna auctor ullamcorper. Sed risus lorem, mollis eu ullamcorper non, posuere a nisi. Curabitur feugiat, massa in porta vulputate, odio nisi hendrerit lectus, sit amet auctor nulla tortor molestie magna. Nunc scelerisque, libero non gravida lobortis, libero arcu sodales erat, ac consequat ligula sem quis enim. Cras augue lacus, pellentesque at ultrices eu, tincidunt id lorem. Sed egestas commodo pulvinar. Nam ac risus erat, eget aliquet est. Aliquam nec ante elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
		<p><a href="#topPage">Top</a></p>
	</div> */ ?>
</div>


<script type="text/javascript">
	function showHowToVid()
	{
		document.getElementById("howToVid").style.display="";
		document.getElementById("tryThis").scrollIntoView(true);
		document.getElementById("howToVidHid").style.display="none";	
	}
</script>
	
	
<?php include "helpers/footer.php"; ?>

<?php
if ($GLOBALS['sql_debug'] != 0)
{
	include "helpers/sqlDebug.php";
}
?>	
</body>

</html>
