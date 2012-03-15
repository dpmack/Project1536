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
		<dd><?=$postNumber; ?></dd>
	<dt>Date Created</dt>
		<dd><?=$postDateCreated?></dd>
	<? if(isset($postDateEdited)): ?>
	<dt>Date Edited</dt>
		<dd><?=$postDateEdited?></dd>
	<? endif; ?>
</dl>
<dl class="userInfo">
	<dt>Username</dt>
		<dd><?=$userName?></dd>
	<dt>User post count</dt>
		<dd><?=$userPostCount?></dd>
</dl>
<div class="postContent"><?=$postContent?></div>