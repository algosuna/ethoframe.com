<?php 
require('db/validate.php');
$thispage='about';
$page_title='About the Creator';
include('includes/head.php');?>
</head>

<body>
	<?php if($_SESSION['logged_in']==true){
		include('includes/nav.php');
	}?>
	<div id="container">
    	<h1>Ethoframe</h1>
        <h2>About the Creator and the Helping Hippie</h2>
        <h3>Andy</h3>
        <p>Blah</p>
        <h3>Laura</h3>
        <p>(Laura's Stuff)</p>
	</div>
<?php include('includes/footer.php');?>
</body>
</html>