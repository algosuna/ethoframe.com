<?php
require('db/validate.php');
if($_SESSION['logged_in']!=true){
	header('location:login.php');
}
$thispage='home';
$page_title='Command Center!';
include('includes/head.php');?>
</head>

<body id="<?php echo $thispage;?>">
	<?php include('includes/nav.php');?>
		<?php include('includes/header.php');?>
	<div id="container">
  
		<div id="content">
		  <?php
            $page=$_GET['page'];
            switch($page){
                case 'upload':
                    include('upload.php');
                break;
				case 'edit':
					include('edit.php');
				break;
				case 'single':
					include('single.php');
				break;
				case 'edit-single':
					include('edit-single.php');
				break;
				case 'settings':
					include('settings.php');
				break;
                default:
                    include('latest.php');
            }
          ?>
		</div>
	</div>
	<?php include('includes/footer.php');?>
</body>
</html>