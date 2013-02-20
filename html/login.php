<?php require('db/validate.php');
	if($_SESSION['logged_in']==true){
	  header('location:home.php');
	}
  
  $page_title='Welcome Back! Log In to Ethoframe!';

  include('includes/head.php');?>
  
  <script type="text/javascript">
  var error="";
  function quickCheck(){
    var inputEmail=document.getElementById("email").value;
    var inputPassword=document.getElementById("password").value;
    if(inputEmail!=""||inputPassword!=""){
      document.getElementById("hidden_input").innerHTML="<input type='hidden' value='1' name='did_login' />";
    }else{
      document.getElementById("empty").innerHTML="<div class='error'>Please fill in the login form!</div>";
    }
  }
  </script>
</head>

<body id="enter">
<div class="header" align="center">
	<a href="index.php"><img src="images/logo-300.png" class="logo" /></a>
</div>
<div class="back"><a href="signup.php">Sign Up--></a></div>
<div class="form-container">
      
  <form name="login" class="login-form" method="post" onsubmit="return quickCheck();" id="login">
    <h2>Log In</h2>
    <hr/>
    <?php
    if($error==true){?>
    <div class="error">Sorry, your email and password combination are incorrect. Please try again.</div>
    <?php } ?>
    <div class="error" id="empty"></div>
    <input type="text" name="email" id="email" placeholder="Email" value="<?php if($error==true)echo $input_email ?>" />
    <input type="password" name="password" id="password" placeholder="Password" value="<?php if($error==true) echo $input_password?>" />
    <input type="submit" value="Enter!" class="enter-button" />
    <div id="hidden_input"></div>
  </form>
  
</div>
</body>
</html>