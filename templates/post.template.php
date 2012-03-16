<?php
	/* 
	*  $postNumber - Number of post (position)
	*  $postContent - Content Posted
	*  		it is assumed that post content requires no
	*		processing to be displayed to the page.
	*  $postDateCreated - Date Created
	*  $postDateEdited - Date last modified
	*  $userName - User Name
	*  $userPostCount - User # posts
	*/
?>

<dl class="postInfo">
	<dt>Post Number</dt>
		<dd class="postNum"><?=$postNumber; ?></dd>
	<dt>Date Created</dt>
		<dd class="postCreated"><?=$postDateCreated?></dd>
	<? if($postDateEdited != ""): ?>
	<dt class="dateEdited">Date Edited</dt>
		<dd class="postEdit"><?=$postDateEdited?></dd>
	<? endif; ?>
</dl>
<dl class="userInfo">
	<dt>Username</dt>
		<dd class="postUsername"><?=$userName?></dd>
	<dt>User post count</dt>
		<dd class="postUserCount"><?=$userPostCount?></dd>
</dl>
<div class="postContent"><div class="wrapper"><?=$postContent?></div></div>