<?php
	$query_stream="SELECT posts.user_id, posts.title, posts.body, posts.date, posts.post_id, posts.is_published, posts.image_link, users.avatar_link, users.username
				   FROM posts, users
				   WHERE is_published=1
				   AND posts.user_id=users.user_id
				   ORDER BY date DESC";
	$result_stream=mysql_query($query_stream);
	while($row_stream=mysql_fetch_array($result_stream)){
?>
<div class="post">
    <img src="<?php echo $row_stream['image_link'] ?>" class="image-post" />
	<?php
    	if($row_stream['avatar_link']!=''){
			echo '<img src="'.$row_stream['avatar_link'].'" class="avatar" />';
		}else{
			echo '<img src="uploads/avatar/default.png" width="140" height="140" class="avatar" />';
		}?>
    <div class="buttons">
    <!--Commented out on purpose until features available!
        <a href="#" id="exp" class="e-tool">Exposure</a>
        <a href="#" id="bck" class="e-tool">Back</a>-->
        <?php
            if($row_stream['user_id']==$user_id){
                echo '<a class="edit" href="home.php?page=edit-single&amp;postid='.$row_stream['post_id'].'" title="Edit">Edit</a>';
            }else{
                echo '<div class="tools">
					  <a href="#" id="fol" class="tool" title="Follow">Follow</a>
                      <a href="#" id="fav" class="tool" title="Favorite">Fave</a>
                      <a href="#" id="mes" class="tool" title="Message">Message</a>
                      <a href="#" id="rep" class="tool" title="Report/Block">Report/Block</a>
					  </div>';
            }
        ?>
    </div>
    <div class="description">
        <h3><?php echo $row_stream['title']?></h3>
        <p><?php echo $row_stream['body']?></p>
        <h4><?php echo convert_date($row_stream['date'])?></h4>
    </div>
<div class="cf"></div>
</div>
<?php
	} ?>