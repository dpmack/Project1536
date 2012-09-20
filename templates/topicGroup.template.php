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

		<?php if ($type == "Topics" && $forumInfo["forumTitle"] != "News")
		{
			drawTopicPages($forumID, $numPages, $currentPage, $TOPIC_PAGES_TO_SHOW);
		}
		?>
		<ul id="topics">
		
		<?php foreach($topics as $topic): extract($topic); ?>

			<li>
				<dl>
					<dt>Title</dt>
					<dd><a href="<?=$topicURL; ?>"> <?=$title; ?> </a></dd>
					<!--< ?php if(isset($subTopicCount)): ?>
					<dt>Topics</dt>
					<dd> < ?=$subTopicCount; ?> </dd>
					< ?php endif; ?>!-->
					<?php if ($postCount): ?>
					<dt>Posts</dt>
					<dd> <?=$postCount; ?> </dd>
					<?php endif; ?>
				</dl>
			</li>
			
		<?php endforeach; ?>
		
		</ul>
		</div><!-- /section-->
	</div><!-- /groupableSections-->
<?php

?>