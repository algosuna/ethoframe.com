<?php
require('db/db_config.php');
function convTimestamp($date){
	$year	=	substr($date,0,4);
	$month	=	substr($date,5,2);
	$day	=	substr($date,8,2);
	$hour	=	substr($date,11,2);
	$minute	=	substr($date,14,2);
	$second	=	substr($date,17,2);
	$stamp	=	date('D, d M Y H:i:s O', mktime($hour, $min, $sec, $month, $day, $year));
	return $stamp;
}
echo '<?xml version="1.0" encoding="iso-8859-1"?>';?>
<rss version="2.0">
	<channel>
    	<title>Ethoframe</title>
        <link>
        http:/localhost/proyect/root/
        </link>
        <description>Upload and share your photographic expression.</description>
        <webMaster>alien@thealienandthevampire.com</webMaster>
        <managingEditor>vampire@thealienandthevampire.com</managingEditor>
        <category>File Sharing and Indirect Networking</category>
        <docs>http://blogs.law.harvard.edu/tech/rss</docs>
        <pubDate>
        	<?php date('r') ?>
        </pubDate>
        <lastBuildDate>
      		<?php date('r'); ?>
    	</lastBuildDate>
    	<language>en-us</language>
        <image>
        	<url>http://localhost/proyect/root/images/logo-300.png</url>
            <title>Ethoframe Logo</title>
            <link>
            http://localhost/proyect/root/
            </link>
        </image>
        <?php
			$query_stream="SELECT title, body, date, post_id, is_published, image_link
				           FROM posts
			       		   WHERE is_published = 1
						   ORDER BY date DESC
						   LIMIT 10";
			$result_stream=mysql_query($query_stream);
			while($row_stream=mysql_fetch_array($result_stream)){
		?>        
        <item>
        <title><?php echo htmlentities($row_stream['title']);?></title>
        
        <link>
        
        </link>
        
        <guid></guid>
        
        <pubDate><?php echo $row_stream['date'];?></pubDate>
        <description><![CDATA[<img src="<?php echo $row_stream['image_link']?>" />]]>
<?php echo htmlentities($row_sream['body']);?></description>
        </item>
        <?php } ?>
    </channel>
</rss>