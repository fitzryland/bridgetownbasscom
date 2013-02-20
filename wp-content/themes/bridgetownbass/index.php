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

// Date
$dateRaw = get_field('date');
$dateArray = explode('/',$dateRaw);
$year = $dateArray[0];
$monthNum = $dateArray[1];
$monthName = date("M", mktime(0, 0, 0, $monthNum, 10));
$day = date("j",strtotime($dateRaw));
$dayOfWeek = date("D",strtotime($dateRaw));
// Photo
$photoMeta = get_field('photo');
$photoURL = $photoMeta['sizes']['medium'];

$lrgEventImgURLs[] = $photoMeta['sizes']['large']; // TODO use for lightbox of large poster image

$photoAlt = $photoMeta['alt'];
// Venue & Musicians
$stdVen = get_the_terms($post->ID, 'venues');
$ven = get_object_vars($stdVen[0]);
$taxAndIDmusic = "artist_" . $ar['term_id'];
$taxAndVenID = "venues_" . $ven['term_id'];
$venCalendarURL = get_field('calendar_url', $taxAndVenID);
$venTwitterURL = get_field('twitter_url', $taxAndVenID);
$venFacebookURL = get_field('facebook_url', $taxAndVenID);
$venMapURL = get_field('map_url', $taxAndVenID);
$venName = $ven['name'];
$venImg = get_field('image', $taxAndVenID);
$highlight = get_field('highlight');
$rsvp = get_field('rsvp');
?>
<article <?php
if ($highlight == 'Yes') {
	echo "class=\"group highlight\"";
} else {
	echo "class=\"group\"";
}
?>>
	<!--<div class="readable">-->
		<?php
		
//		echo "Current Time: " . "</br>" . date("D M d, Y G:i a", $curTime) . "</br>" . "</br>";
		
//		echo "Expiration Time: " . "</br>" . date("D M d, Y G:i a", $post->TIMESTAMP) . "</br>" . "</br>";
		
		?>
	<!--</div>-->
	<div class="static">
		<div class="date">
			<span class="dw"><?php echo $dayOfWeek; ?></span>
			<span class="m"><?php echo $monthName; ?></span>
			<span class="d"><?php echo $day; ?></span>
			<span class="y"><?php echo $year; ?></span>
		</div>
		<h2 class="venue"><?php echo $venName; ?></h2>
		<?php
		foreach (get_the_terms($post->ID, 'artist') as $i=>$stdArt) {
			$ar = get_object_vars($stdArt);
			$artistName = $ar['name'];
			?>
			<h2 class="<?php echo "artistMeta" . $i; ?>"><?php echo $artistName; ?></h2>
			<?php
		}; 
		?>
		<ul class="meta">
			<li>
				<?php if (get_field('ticket_link')) { ?>
				<a href="<?php the_field('ticket_link'); ?>" target="_new">Tickets</a>
				<?php }; ?>
			</li>
			<li>
				<a href="<?php the_permalink(); ?>">permalink</a>
			</li>
		</ul>
	</div>
	<div class="flip">
		<img class="poster big" src="<?php echo $photoURL; ?>" alt="<?php echo $photoAlt; ?>"/>
		<div class="panelWrap">
			<div class="panel venue">
				<?php if ($venCalendarURL) { ?>
					<a href="<?php echo $venCalendarURL; ?>" target="_new" title="">
						<h1><?php echo $venName; ?></h1>
					</a>
				<?php } else { ?>
					<h1><?php echo $venName; ?></h1>
				<?php }; ?>
				<img class="venImg" src="<?php echo $venImg['sizes']['artist-img']; ?>">
				<div class="social">
					<?php if ($venTwitterURL) { ?>
						<div class="icon">
							<a href="<?php echo $venTwitterURL; ?>" target="_new" title="">
								<img src="<?php bloginfo('stylesheet_directory'); ?>/images/sprite3_3.png" width="336" height="96" class="t"/>
							</a>
						</div>
					<?php }; ?>
					<?php if ($venFacebookURL) { ?>
						<div class="icon">
							<a href="<?php echo $venFacebookURL; ?>" target="_new" title="">
								<img src="<?php bloginfo('stylesheet_directory'); ?>/images/sprite3_3.png" width="336" height="96" class="f"/>
							</a>
						</div>
					<?php }; ?>
					<?php if ($venMapURL) { ?>
						<div class="icon">
							<a href="<?php echo $venMapURL; ?>" target="_new" title="">
								<img src="<?php bloginfo('stylesheet_directory'); ?>/images/sprite3_3.png" width="336" height="96" class="ma"/>
							</a>
						</div>
					<?php }; ?>
				</div>
			</div>
			<?php
			foreach (get_the_terms($post->ID, 'artist') as $i=>$stdArt) {
				$ar = get_object_vars($stdArt);
				$artistName = $ar['name'];
				$taxAndIDmusic = "artist_" . $ar['term_id'];
				$artistMusicURL = get_field('music_url', $taxAndIDmusic);
				$artistTwitterURL = get_field('twitter_url', $taxAndIDmusic);
				$artistPhoto = get_field('artist_photo', $taxAndIDmusic);
				$artistFacebookURL = get_field('facebook_url', $taxAndIDmusic);
				$artistMyspaceURL = get_field('myspace_url', $taxAndIDmusic);
				?>
			<div class="panel artist <?php echo "artistMeta" . $i; ?>">
				<h1><?php echo $artistName; ?></h1>
				<img src="<?php echo $artistPhoto['sizes']['artist-img']; ?>" class="artistImg"/>
				<div class="social">
					<!--
					- Max Three
					
					-->
					<?php if ($artistMusicURL) { ?>
						<div class="icon">
							<a href="<?php echo $artistMusicURL; ?>" target="_new">
								<img src="<?php bloginfo('stylesheet_directory'); ?>/images/sprite3_3.png" width="336" height="96" class="s"/>
							</a>
						</div>
					<?php }; ?>
					<?php if ($artistTwitterURL) { ?>
						<div class="icon">
							<a href="<?php echo $artistTwitterURL; ?>" target="_new">
								<img src="<?php bloginfo('stylesheet_directory'); ?>/images/sprite3_3.png" width="336" height="96" class="t"/>
							</a>
						</div>
					<?php }; ?>
					<?php if ($artistFacebookURL) { ?>
						<div class="icon">
							<a href="<?php echo $artistFacebookURL; ?>" target="_new">
								<img src="<?php bloginfo('stylesheet_directory'); ?>/images/sprite3_3.png" width="336" height="96" class="f"/>
							</a>
						</div>
					<?php }; ?>
					<?php if ($artistMusicURL && $artistTwitterURL && $artistFacebookURL) {} elseif ($artistMyspaceURL) { ?>
						<div class="icon">
							<a href="<?php echo $artistMyspaceURL; ?>" target="_new">
								<img src="<?php bloginfo('stylesheet_directory'); ?>/images/sprite3_3.png" width="336" height="96" class="m"/>
							</a>
						</div>
					<?php }; ?>
				</div>
			</div>
				<?php
			}; 
			?>
		</div>
	</div>
	<div class="clear"></div>
</article>


<?php
endforeach;
else :
endif;
?>	
<div id="lrgEventImgURLs">
	<?php
	echo json_encode($lrgEventImgURLs);
	?>
</div>
<?php include 'footer.php'; ?>