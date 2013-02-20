<?php
require('db/validate.php');

$thispage='search';
$page_title='Search Categories';
include('includes/head.php');?>
</head>

<body id="<?php echo $thispage;?>">
<?php
if($_SESSION['logged_in']==true){
	include('includes/nav.php');
}
include('includes/header.php');
?>
    <div id="container">
        <?php 
        $phrase=$_GET['phrase'];
        $query_search="SELECT distinct *
                       FROM posts
                       WHERE is_published = 1
                       AND ( title LIKE '%".$phrase."%'
                       OR body LIKE '%".$phrase."%')
                       ORDER BY date DESC";	   
        $result_search=mysql_query($query_search);
        if(mysql_num_rows($result_search)>=1){
        ?>
        
        <h2>Search Results </h2>
        <div class="" id="search_results_list">
        <?php
            while($row=mysql_fetch_array($result_search)){
                $postid=$row['post_id'];
                $query_count=mysql_query("SELECT COUNT(*)
                                          AS numcomments
                                          FROM comments
                                          WHERE post_id=$postid");
                $row_count = mysql_fetch_array($query_count);
                $numcomments = $row_count['numcomments'];
                if($numcomments==1){
                    $commenttext='1 Comment';
                }elseif($numcomments>1){
                    $commenttext=$numcomments.' Comments';
                }else{
                    $commenttext='No Comments';
                }?>
            <div class="post">
                <h3>
                    <a href="#"><?php echo $row['title']; ?></a>
                </h3>
                <div class="metadata">Posted on <?php echo convert_date($row['date']); ?> | <?php echo $commenttext; ?></div>
            </div>
        <?php
            } ?>
        </div>
        <?php 
        }else{
            echo '<div class="comment_message"><span class="search_message">No Matches Found</span><p>Try your search with a different category. This one turned up no results.</p></div>';
        }
        ?>
    </div>
<?php include('includes/footer.php');?>
</body>
</html>