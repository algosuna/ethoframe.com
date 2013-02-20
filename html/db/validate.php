<?php
session_start();
require('db_config.php');
require_once('functions.php');

  //////////////////////
 ///////SIGN UP////////
//////////////////////

if($_POST['did_register']==1){
	$email=clean_input($_POST['email']);
	$username=clean_input($_POST['username']);
	$password=clean_input($_POST['password']);
	$repassword=clean_input($_POST['repassword']);
	$policy=clean_input($_POST['policy']);
	$sha_password=sha1($password);
	$valid=true;
	
	if($policy!=1){
		$valid=false;
		$policy_error='*You must agree to the Terms of Service and Privacy Policy before Signing up!';
	}
	if($password!=$repassword){
		$valid=false;
		$password_error='*The passwords provided do not match.';
	}
	if(strlen($username)>=5 AND strlen($password)>=5){
		$query_username="SELECT username
						 FROM users
						 WHERE username='$username'
						 LIMIT 1";
		$result_username=mysql_query($query_username);
		if(mysql_num_rows($result_username)==1){
			$valid=false;
			$username_error='*That username is already taken, try another.';
		}
	}else{
		$valid=false;
		$length='Username and Password must be at least 5 characters long.';
	}
	if(check_email_address($email)==true){
		$query_email="SELECT email
					  FROM users
					  WHERE email='$email'
					  LIMIT 1";
		$result_email=mysql_query($query_email);
		if(mysql_num_rows($result_email)==1){
			$valid=false;
			$email_error='*Looks like an account with that email already exists. <a href="login.php">Log In.</a>';
		}
	}else{
		$valid=false;
		$email_valid='*Please provide a valid email address.';
	}
	if($valid==true){
		$query_insert="INSERT INTO users
					   (username, password, email, join_date, is_admin)
					   VALUES
					   ('$username','$sha_password','$email',now(),0)";
		$result_insert=mysql_query($query_insert);
		if(mysql_affected_rows()==1){
			$_SESSION['logged_in']=true;			
			$_SESSION['user_id']=mysql_insert_id();
			$_SESSION['is_admin']=0;
			setcookie('logged_in','true',time()+60*60*24*14);
			setcookie('user_id',$_SESSION['user_id'],time()+60*60*24*14);
			setcookie('is_admin',$_SESSION['is_admin'],time()+60*60*24*14);
		
			header('location:home.php');
		}else{
			$db_error='Sorry, it appears we are having technical issues. Please try again later or fill a <a href="bugs.php">bug report</a>.';
		}
	}
}

  /////////////////////
 ///////LOG IN////////
/////////////////////

if($_POST['did_login']==1){
	$input_email=clean_input($_POST['email']);
	$input_password=clean_input($_POST['password']);
	$sha_password=sha1($input_password);
	
	if(strlen($input_password)>=5){
		$query_login="SELECT user_id, is_admin
					  FROM users
					  WHERE email='$input_email'
					  AND password='$sha_password'
					  LIMIT 1";
		$result_login=mysql_query($query_login);
	}
	if(mysql_num_rows($result_login)==1){
		$row_login=mysql_fetch_array($result_login);
		
		setcookie('logged_in','true',time()+60*60*24*14);
		setcookie('user_id',$row_login['user_id'],time()+60*60*24*14);
		setcookie('is_admin',$row_login['is_admin'],time()+60*60*24*14);
		
		$_SESSION['logged_in']=true;
		$_SESSION['user_id']=$row_login['user_id'];
		$_SESSION['is_admin']=$row_login['is_admin'];
		
		header('location:home.php');
	}else{
		$error=true;
	}
}

  /////////////////////
 ///////LOG OUT///////
/////////////////////

if($_GET['action']=='logout'){
	unset($_SESSION['logged_in']);
	unset($_SESSION['user_id']);
	unset($_SESSION['is_admin']);
	session_destroy();
	setcookie('logged_in','');
	setcookie('user_id','');
	setcookie('is_admin','');
}elseif($_COOKIE['logged_in'] == true){
		$_SESSION['logged_in'] = true;
		$_SESSION['user_id'] = $_COOKIE['user_id'];
		$_SESSION['is_admin'] = $_COOKIE['is_admin'];
}



///////////////////////////////////////////////////////////////////////////////////////
if( $_COOKIE['logged_in'] == true){
	$_SESSION['logged_in'] = true;
	$_SESSION['user_id'] = $_COOKIE['user_id'];
	$_SESSION['is_admin'] = $_COOKIE['is_admin'];	
		$user_id=$_SESSION['user_id'];
		$query_user="SELECT * FROM users
					 WHERE user_id=$user_id
					 LIMIT 1";
		$result_user=mysql_query($query_user);
		$row_user=mysql_fetch_array($result_user);

//this is going to be a handy variable to have on all pages
$user_id=$row_user['user_id'];
$current_user=$row_user['username'];

}

  ///////////////////
 //////CONTACT//////
///////////////////

if($_POST['did_send']=='true'){
	$name=clean_input($_POST['name']);
	$email=clean_input($_POST['email']);
	$phone=clean_input($_POST['phone']);
	$message=clean_input($_POST['message']);
	$news=clean_input($_POST['news']);
	
	//TO DO (email sending settings)
	$to='andyosuna@gmail.com';
	$subject='Contact';
	
	$body="Someone contacted you from your website! \n";
	$body.="Their name is: $name \n";
	$body.="Email Address: $email \n";
	$body.="Phone Number: $phone \n\n";
	$body.="Do they want the newsletter? $news \n";
	$body.="Message: $message \n";
	$headers="Reply-to: $email \r\n";
	$headers.="From: $email \r\n";
	$headers.="CC: andy@video-game-history.com";
		
	$valid=true;
	
	if(strlen($name)==0 OR strlen($message)==0){
		$valid=false;
		$_error='You cannot leave this blank.';
	}
	if(check_email_address($email)==false){
		$valid=false;
		$email_error='Valid email, if you don\'t mind!';
	}
	if($valid==true){
		$mail_sent=mail($to,$subject,$body,$headers);
		if($mail_sent==1){
			$smooth='Thank you for your feedback I, the webMaster, give my word to contact you back on your inquiry shorlty.';
		}else{
			$horrible_error='Sorry, something went wrong, mail was not sent.';
		}
	}
}