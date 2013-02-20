<?php 
require('db/validate.php');
$page_title='Welcome to Ethoframe! Sign Up';
include('includes/head.php');
?>
</head>

<body id="enter">
<div class="header" align="center">
	<a href="index.php"><img src="images/logo-300.png" class="logo" /></a>
</div>
<div class="back"><a href="login.php"><--Log In</a></div>
<div class="form-container">
  <form name="signup" class="signup-form" method="post" action="signup.php">
    <h2> Sign Up </h2>
    <hr />
	<?php if($valid==false) echo '<div class="error">'.$length.'</div>'; ?>
    
    <input type="text" name="email" id="email" placeholder="Email" />    
	<?php if($valid==false) echo '<div class="error">'.$email_error.'</div>' ?><?php echo '<div class="error">'.$email_valid.'</div>' ?> 
    
    <input type="text" name="username" id="username" placeholder="Username" />    
	<?php if($valid==false) echo '<div class="error">'.$username_error.'</div>' ?>
    
    <input type="password" name="password" id="password" placeholder="Password" />
    <input type="password" name="repassword" id="repassword" placeholder="Password Again" />   
	<?php if($valid==false) echo '<div class="error">'.$password_error.'</div>' ?>
    
    <input type="checkbox" name="policy" id="checkbox" value="1" />
    <label for="policy" class="checklabel">Yes, I have read the <a href="terms.php" target="_blank">Terms of Service and Privacy Policy.</a></label>
   	<?php if($valid==false) echo '<div class="error">'.$policy_error.'</div>' ?>
    
    <input type="submit" value="Enter!" class="enter-button" />
   	<?php if($valid==false) echo '<div class="error" id="lasterror">'.$db_error.'</div>' ?>
    <input type="hidden" value="1" name="did_register" />
  </form>
</div>
</body>
</html>