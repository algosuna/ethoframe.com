<?php
require('db/validate.php');
$thispage='contact';
$page_title='Contact Us!';
include('includes/head.php');
?>
</head>

<body id="<?php echo $thispage;?>">
<?php include('includes/nav.php') ?>
<div id="enter">
  <div class="form-container">
    
   
    <form action="contact.php" method="post" class="contact-form" name="contact">
	<?php
   if($valid==true){
	   if($mail_sent==1){
		   echo '<div class="smooth_contact">'.$smooth.'</div>';
	   }else{
			echo '<div class="error" id="horrible">'.$horrible_error.'</div>
<div class="back" id="contact"><a href="contact.php"><--Try Again</a></div>';   
	   }
	   
   }else{
	   ?>
    <h2>Contact Us!</h2>
    <hr />
      <input type="text" name="name" id="name" value="<?php if($valid==false)echo $name?>"  placeholder="Your Name" />
	 <?php if($valid===false AND strlen($name)==0)echo'<div class="error">'.$_error.'</div>'?>
      
      <input type="text" name="email" id="email" value="<?php if($valid==false)echo $email?>"  placeholder="Your Email Address" />
      <?php if($valid===false AND check_email_address($email)==false)echo'<div class="error">'.$email_error.'</div>'?>
      
      <input type="text" name="phone" id="phone" value="<?php if($valid==false)echo$phone?>" placeholder="Your Phone Number" />
      
      <textarea name="message" id="message" cols="20" rows="5" placeholder="Your Message"><?php if($valid==false)echo $message?></textarea>
	  <?php if( $valid===false AND strlen($message)==0 )echo'<div class="error">'.$_error.'</div>'?>
      
      <input type="checkbox" name="news" id="checkbox" value="true" <?php
	  if($valid==false AND $news==true) echo 'checked="checked"'; ?> />
      <label for="news" class="checklabel">Subscribe to Newsletter?</label>
      
      <input type="submit" class="send-button" value="Send Message" />
      
      <input type="hidden" name="did_send" value="true" />
    <?php }
    ?>
    </form>
    
  </div>
  <?php include('includes/footer.php');?>
</div>
</body>
</html>