<?php

include 'header.php';

date_default_timezone_set('UTC');

$curTime = time() - 28800; // UTC time Converted to PST

$querystr = "
SELECT *
FROM wp_posts
";
$pageposts = $wpdb->get_results($querystr);

print_r($pageposts);


include 'footer.php'; ?>