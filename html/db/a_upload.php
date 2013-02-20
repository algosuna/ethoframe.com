<?php 
	if($_POST['did_upload']==1){
		$target_path="uploads/avatar/";
		
		$uploadedfile=$_FILES['uploadedfile']['tmp_name'];
		list($width,$height)=getimagesize($uploadedfile);
		
		if($width>0 AND $height>0){
			if($width>=140){
				$newwidth=140;
				$newheight=($height/$width)*$newwidth;
			}else{
				$newwidth=$width;
				$newheight=$height;
			}
			$filetype=$_FILES['uploadedfile']['type'];
			switch($filetype){
				case'image/gif':
					$src=imagecreatefromgif($uploadedfile);
				break;
				case 'image/pjpeg':
				case 'image/jpg':
				case 'image/jpeg':
					$src = imagecreatefromjpeg($uploadedfile);
				break;
				case 'image/png':
					$required_memory = Round($width * $height * $size['bits']);
					$new_limit=memory_get_usage() + $required_memory;
					ini_set("memory_limit", $new_limit);
					$src = imagecreatefrompng($uploadedfile);
					ini_restore ("memory_limit");
				break;
				default:
			}
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			$randomsha=sha1(microtime());
			$filename=$target_path.'avatar_'.$randomsha.'.jpg';
			
			$didcreate=imagejpeg($tmp,$filename,70);
			
			imagedestroy($src);
			imagedestroy($tmp);
		}else{
			$didcreate=false;
		}
		if($didcreate){
			$query="UPDATE users
					SET avatar_link='$filename'
					WHERE user_id=$user_id";
			$result=mysql_query($query);
			
			if(mysql_affected_rows()==1){
				$statusmsg='Filepath added to DB.<br />';
			}
			$statusmsg.="The file ".basename($_FILES['uploadedfile']['name'])." has been uploaded.<br />";
		}else{
			$statusmsg.="There was an error uploading the file, please try again!<br />";
		}
	}
?>