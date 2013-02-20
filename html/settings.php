<?php require('db/a_upload.php'); ?>
<h2>Settings</h2>
<h3>Edit your Avatar</h3>
<div id="avatar-form">
	<form action="home.php?page=settings" method="post" enctype="multipart/form-data">
    	<label for="uploadedfile">Choose a file:</label>
        <input type="file" name="uploadedfile" id="uploadedfile" />
        
        <input type="submit" value="Upload File" />
        <input type="hidden" name="did_upload" value="1" />
    </form>
</div>
<div id="current"><h4>Your Current Avatar</h4>
<?php
	$query_pic="SELECT username, avatar_link
				FROM users
				WHERE user_id=$user_id
				LIMIT 1";
	$result_pic=mysql_query($query_pic);
	if(mysql_num_rows($result_pic)==1){
		$row_pic=mysql_fetch_array($result_pic);
		if($row_pic['avatar_link']!=''){
			echo '<img class="avatar" src="'.$row_pic['avatar_link'].'" title="User\'s Picture" />';
		}else{
			echo '<img class="avatar" src="uploads/avatar/default.png" width="140" height="140" />';
		}
	}
?>
</div>