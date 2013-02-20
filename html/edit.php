<?php require('db/edit.php');?>

<h2>Edit your Posts</h2>
<?php echo $status_msg ?>
<?php
$query_posts="SELECT title, body, post_id, is_published, image_link, date_taken, date
			  FROM posts
			  WHERE user_id=$user_id
			  ORDER BY date DESC";
$result_posts=mysql_query($query_posts);
if(mysql_num_rows($result_posts)>=1){
	while($row_posts=mysql_fetch_array($result_posts)){
?>
	<?php echo '<div class="post">
					<img src="'.$row_posts['image_link'].'" class="image-post" />
					<h3 class="edit-title">'.$row_posts['title'].'</h3>
					<p>'.$row_posts['body'].'</p>
					<h4 class="date">Taken on '.convert_date($row_posts['date_taken']).'</h4>
					<h4 class="date">Uploaded on '.convert_date($row_posts['date']).'</h4>
					<h3><a href="home.php?page=edit-single&amp;postid='.$row_posts['post_id'].'" title="Edit">Edit</a></h3>
					<div class="cf"></div>
				</div>'?>
    <?php
		if($row_posts['is_published']!=1){
			echo ' - Draft';
		}
	?>	
<?php
	}
}
?>
