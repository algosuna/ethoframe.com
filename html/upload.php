<?php
require_once('db/upload.php');?>
<h2>Upload a Photograph</h2>

<form action="home.php?page=upload" class="upload-form" method="post" id="upload" enctype="multipart/form-data">
    <?php if($valid==false) echo '<div class="error">'.$exif_error.'</div>';
		   if($valid==false) echo '<div class="error">'.$filetype_error.'</div>';?>
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" />
    
    <label for="body">Description:</label>
    <textarea name="body" id="body"></textarea>
    
    <!--<label for="name">Category:</label>
    <input type="text" name="name" id="name" />-->
    
	<label for="uploadedfile">Choose a Photograph:</label>
	<input type="file" name="uploadedfile" id="uploadedfile" />
		  <?php if($valid==false) echo '<div class="error">'.$file_error.'</div>' ?>
    
    <label for="checkbox" class="checkbox">Publish?</label>
    <input type="checkbox" value="1" name="is_published" id="is_published" />
    
    <input type="submit" class="post-button" value="Post!" align="middle" />
   	<input type="hidden" name="did_post" value="1" />
    <div class="cf"></div>
</form>
<h2>Your Latest Post:</h2>
<?php
	$query_lpost="SELECT post_id, title, date, image_link, make, model, exposure, aperture, iso, date_taken
				  FROM posts
				  WHERE user_id=$user_id
				  ORDER BY date DESC
				  LIMIT 1";
	$result_lpost=mysql_query($query_lpost);
	if(mysql_num_rows($result_lpost)==1){
		$row_lpost=mysql_fetch_array($result_lpost);
		if($row_lpost['image_link']!=''){
			echo'<div class="post">
					<img src="'.$row_lpost['image_link'].'" class="image-post" />
					<h3 class="latest">'.$row_lpost['title'].'</h3>
					<p>'.$row_lpost['body'].'</p>
					<ul id="exposure">
						<li><b>Camera:</b><br />'.$row_lpost['make'].' '.$row_lpost['model'].'</li>
						<li><b>Sutter Speed:</b><br />'.$row_lpost['exposure'].'</li>
						<li><b>Aperture:</b><br />'.$row_lpost['aperture'].'</li>
						<li><b>ISO:</b><br />'.$row_lpost['iso'].'</li>
						<li><b>Taken On:</b><br />'.convert_date($row_lpost['date_taken']).'</li>
					</ul>
					<h4>'.convert_date($row_lpost['date']).'</h4>
					<a href="home.php?page=edit-single&amp;postid='.$row_lpost['post_id'].'">Edit</a>
				<div class="cf"></div>
				</div>';
		}else{
			echo 'You don\'t appear to have any posts yet.';
		}
	
	}
?>