<?php 

$post_id=$_GET['postid'];

$query_post="SELECT title, body, post_id, is_published, image_link
			 FROM posts
			 WHERE user_id=$user_id
			 AND post_id=$post_id
			 LIMIT 1";
$result_post=mysql_query($query_post);
$row_post=mysql_fetch_array($result_post);
?>

<h2>Edit Post</h2>
<form action="home.php?page=edit" method="post" class="upload-form" id="edit" enctype="multipart/form-data">
    <h3>Your Photograph:</h3>
    <div id="image-container">
    	<img src="<?php echo $row_post['image_link'];?>" />
    </div>
    <div class="cf"></div>
	<label for="title">Title:</label>
	<input type="text" name="title" id="title" value="<?php echo $row_post['title'];?>" />

    <label for="body">Description:</label>
    <textarea name="body" id="body"><?php echo $row_post['body']?></textarea>
    
      	<?php if($row_post['is_published']==0){ ?>
    	<label>Publish?</label>
    	<input type="checkbox" name="is_published" id="is_published" value="1" />
        <?php }else{ ?>
        <input type="hidden" name="is_published" value="1" />
		<?php } ?>
    
    <input type="submit" class="post-button" value="Update Post" />
    <input type="hidden" name="did_edit" value="1" />
    <input type="hidden" name="post_id" value="<?php echo $post_id ?>" />
    <div class="cf"></div>
</form>