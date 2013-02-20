<?php
$post_id=$_POST['post_id'];

if($_POST['did_edit']==1){
	$title=clean_input($_POST['title']);
	$body=clean_input($_POST['body']);
	$is_published=clean_input($_POST['is_published']);
	
	if($is_published==''){
		$is_published=0;
	}
	
	$query_update="UPDATE posts
				   SET title='$title',
					   body='$body',
					   is_published=$is_published
				   WHERE post_id=$post_id";
	$result_update=mysql_query($query_update);
	if(mysql_affected_rows()==1){
		$status_msg='Your post was successfully edited.';
	}else{
		$status_msg='No changes were made to your post.';
	}
}

?>