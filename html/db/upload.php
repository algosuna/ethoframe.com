<?php
if($_POST['did_post']==1){	
	
	$target_path="uploads/";
	$valid=true;	
	
	$uploadedfile=$_FILES['uploadedfile']['tmp_name'];
	
	if(!$uploadedfile){
		$valid=false;
		$file_error='*You cannot leave this blank!';
	}
	
	$filetype=$_FILES['uploadedfile']['type'];
	
	switch($filetype){
		case 'image/pjpeg':
		case 'image/jpg':
		case 'image/jpeg': 
			$src = imagecreatefromjpeg($uploadedfile);
		break;
		default:
			$valid=false;
			$filetype_error = 'Invalid file type. Only JPGs accepted.';
	}
	
	//image format is valid, so check for exif
	
	if($valid==true){
		$exif_ifd0=exif_read_data($uploadedfile,'IFD0');
		$exif_exif=exif_read_data($uploadedfile,'EXIF');
		
		if(!$exif_ifd0 OR !$exif_exif){
			$valid=false;
			$exif_error= 'Your image contains no exif data, it cannot be processed. To learn how to add exif data <a href="http://www.labnol.org/software/exif-data-editors/14210/" target="_blank">go here.</a>';
		}else{
			
			$make=$exif_ifd0['Make'];
			$model=$exif_ifd0['Model'];
			$exposure=$exif_ifd0['ExposureTime'];
			$aperture=$exif_ifd0['COMPUTED']['ApertureFNumber'];
			$date_taken=$exif_ifd0['DateTime'];
			$iso=$exif_ifd0['ISOSpeedRatings'];
		}
	}
		
	//exif is valid! go!	
	if($valid==true){
		list($width,$height)=getimagesize($uploadedfile);
		if($width>0 AND $height>0){
			if($width>=620){
				$newwidth=620;
				$newheight=($height/$width)*$newwidth;
			}else{
				$newwidth=$width;
				$newheight=$height;
			}
		
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$randomsha=sha1(microtime());
		$filename=$target_path.'photo_'.$randomsha.'.jpg';
		$didcreate=imagejpeg($tmp,$filename,70);
	
		imagedestroy($src);
		imagedestroy($tmp);
			
		}else{
			$didcreate=false;
		}
		
		if($didcreate){
			$title=clean_input($_POST['title']);
			$body=clean_input($_POST['body']);
			$name=clean_input($_POST['name']);
			$is_published=clean_input($_POST['is_published']);
			if($is_published==''){
				$is_published=0;
			}
			$query_insert="INSERT INTO posts
						   (title,body,date,user_id,is_published,image_link,
						   make,model,exposure,aperture,iso,date_taken)
						   VALUES
						   ('$title','$body',now(),$user_id,$is_published,'$filename',
						   '$make','$model','$exposure','$aperture','$iso','$date_taken')";
			$result_insert=mysql_query($query_insert);
			
			if(mysql_affected_rows()==1){
				$db_msg='Post added to DB<br />';
			}else{
				$db_msg='not added to DB.';	
			}
			$success_msg="The file ".basename($_FILES['uploadedfile']['name'])." has been uploaded and the post has been saved.<br />";
		}else{
			$horrible_msg.="There was an error uploading the file/saving the post. Please try again.<br />";
		}
	}
}//end if valid
?>