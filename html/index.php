<?php
require('db/validate.php');

  ///////////////////////////
 ///////WELCOME BACK////////
///////////////////////////

if($_COOKIE['logged_in']==true){
	$_SESSION['logged_in']=true;
	$_SESSION['user_id']=$_COOKIE['user_id'];
	$_SESSION['is_admin']=$_COOKIE['is_admin'];
}
if($_SESSION['logged_in']==true){
	header('location:home.php');
}
$thispage='index';
$page_title='Welcome to Ethoframe!';
include('includes/head.php');
?>
</head>

<body id="<?php echo $thispage;?>">
<div align="center" class="header"><img src="images/banner_01.jpg" />
<a href="index.php"><img src="images/logo-300.png" class="logo" /></a></div>
<div id="buttons"><a href="login.php" class="login">Log In</a><a href="signup.php" class="signup">Sign Up</a></div>
</body>
</html>