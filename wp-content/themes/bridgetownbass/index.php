<?php

include 'header.php';

date_default_timezone_set('UTC');

$curTime = time() - 28800; // UTC time Converted to PST

$querystr = "
	SELECT $wpdb->posts.* ,
	(UNIX_TIMESTAMP( wp_postmeta.meta_value ) + 97200) AS TIMESTAMP
	FROM $wpdb->postmeta, $wpdb->posts
	WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id
	AND $wpdb->postmeta.meta_key =  'date'
	AND (UNIX_TIMESTAMP( $wpdb->postmeta.meta_value ) + 97200) > $curTime
	AND $wpdb->posts.post_status =  'publish'
	AND $wpdb->posts.post_type =  'events'
	ORDER BY $wpdb->postmeta.meta_value ASC
";
$pageposts = $wpdb->get_results($querystr, OBJECT);
$lrgEventImgURLs = array();

if ($pageposts):
	global $post;
foreach ($pageposts as $post):
	setup_postdata($post);

	// Photo
	$photoMeta = get_field('photo');
	$photoURL = $photoMeta['sizes']['medium'];
	$photoAlt = $photoMeta['alt'];
	?>
		<img class="poster" src="<?php echo $photoURL; ?>" alt="<?php echo $photoAlt; ?>" />
	<?php

endforeach;
else :
endif;
?>
<?php include 'footer.php'; ?>