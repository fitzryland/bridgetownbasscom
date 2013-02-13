<?php
/*
Template Name: Past Events
*/
?>
<?php include 'header.php'; ?>
<?php
$querystr = "
	SELECT $wpdb->posts.* 
	FROM $wpdb->posts, $wpdb->postmeta
	WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
	AND $wpdb->postmeta.meta_key = 'date'
	AND $wpdb->postmeta.meta_value < NOW()
	AND $wpdb->posts.post_status = 'publish' 
	AND $wpdb->posts.post_type = 'events'
	AND $wpdb->posts.post_date < NOW() + INTERVAL 1 DAY
	ORDER BY $wpdb->postmeta.meta_value ASC
";

$pageposts = $wpdb->get_results($querystr, OBJECT);
//print_a($pageposts);
?>
<?php if ($pageposts): ?>
<?php global $post; ?>
<?php foreach ($pageposts as $post): ?>
<?php setup_postdata($post); ?>
<?php

//
// Variables
//
// Date
$dateRaw = get_field('date');
$dateArray = explode('/',$dateRaw);
$year = $dateArray[0];
$monthNum = $dateArray[1];
$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
$day = $dateArray[2];
$dayOfWeek = date("D",strtotime($dateRaw));
// Photo
$photoMeta = get_field('photo');
$photoURL = $photoMeta['sizes']['medium'];
$photoAlt = $photoMeta['alt'];




?>
<article class="event">
<div class="eventHead">
	<img src="<?php echo $photoURL; ?>" alt="<?php echo $photoAlt; ?>"/>
	<h2><?php the_title(); ?></h2>
	<div class="date">
		<?php echo "<span class=\"dw\">" . $dayOfWeek . "</span><span class=\"m\">" . $monthName . "</span><span class=\"d\">" . $day . "</span><span class=\"y\">" . $year . "</span>"; ?>
	</div>
	<?php
	foreach (get_the_terms($post->ID, 'artist') as $stdArt) {
		$ar = get_object_vars($stdArt);
		$artistName = $ar['name'];
		if (function_exists('get_all_terms_meta')) {
			$linkArray = get_all_terms_meta($ar['term_id']);
			$artistLink = $linkArray['link'][0];
		}
		?>
		<h3><a href="<?php echo $artistLink; ?>" target="_new"><?php echo $artistName; ?></a></h3>
		<?php
	}; 
	?>
</div>
<div class="eventMeta">
	<a href="<?php the_field('venue_link'); ?>" target="_new"><?php the_field('venue'); ?></a> &#126;
	<a href="<?php the_field('ticket_link'); ?>" target="_new">Tickets</a>
</div>
</article>


<?php endforeach; ?>
<?php else : ?>
<?php endif; ?>	
<?php include 'footer.php'; ?>