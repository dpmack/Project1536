<?php
   /* This takes a multidimensional array $topics where 
	*  each sub array contains the keys:
	*  "topicURL"
	* 		URLs are assumed to already be properly escaped 
	*		and ready for input into an	anchor tag 
	*  "title"
	*  "subTopicCount"
	*  "postCount" 
	*  
	*  This will also take $type for topic group name
	*  Jake and Kevin
	*/
	
	?>

	<div class="groupableSections">
		<div class="section">

		<h2 class="first"><?=$type; ?></h2>
		<?php if ($type == "Topics" && $forumInfo["forumTitle"] != "News")
		{
			?>
			<p class="newTopic"><a href="/createTopic.php?forumID=<?=$forumID?>">Start New Topic</a></p>
			<?php
		}
		?>
		<ul id="topics">
		
		<?php foreach($topics as $topic): extract($topic); ?>

			<li>
				<dl>
					<dt>Title</dt>
					<dd><a href="<?=$topicURL; ?>"> <?=$title; ?> </a></dd>
					<?php if(isset($subTopicCount)): ?>
					<dt>Topics</dt>
					<dd> <?=$subTopicCount; ?> </dd>
					<?php endif; ?>
					<dt>Posts</dt>
					<dd> <?=$postCount; ?> </dd>
				</dl>
			</li>
			
		<?php endforeach; ?>
		
		</ul>
		</div><!-- /section-->
	</div><!-- /groupableSections-->
<?php

?>