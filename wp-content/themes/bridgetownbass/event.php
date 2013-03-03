<?php
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

$lrgEventImgURLs[] = $photoMeta['sizes']['large'];

$photoAlt = $photoMeta['alt'];

// NEW ARTIST INFO
$rawArtistList = get_field('artists');
$rawArtistList = str_replace("'", "\"", $rawArtistList);
$artistsArray = json_decode($rawArtistList, true);

// VENUE
$stdVen = get_the_terms($post->ID, 'venues');

$ven = array_pop($stdVen);

$taxAndVenID = "venues_" . $ven->term_id;
$venCalendarURL = get_field('calendar_url', $taxAndVenID);
$venTwitterURL = get_field('twitter_url', $taxAndVenID);
$venFacebookURL = get_field('facebook_url', $taxAndVenID);
$venMapURL = get_field('map_url', $taxAndVenID);
$venName = $ven->name;
$venImg = get_field('image', $taxAndVenID);
// Meta
$highlight = get_field('highlight');
$rsvp = get_field('rsvp');
$ticketLink = get_field('ticket_link');
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
		<!-- START NEW ARTIST THANG -->
		<?php 
		foreach ($artistsArray as $artID) {
			$art = get_term($artID, 'artist');
			echo "<h2>" . $art->name . "</h2>";
		};
		?>
		<!-- END NEW ARTIST THANG -->
		
		<!-- START OLD ARTIST THANG -->
		<?php
		foreach (get_the_terms($post->ID, 'artist') as $i=>$stdArt) {
			$ar = get_object_vars($stdArt);
			$artistName = $ar['name'];
			?>
			<!-- <h2 class="<?php // echo "artistMeta" . $i; ?>"><?php // echo $artistName; ?></h2> -->
			<?php
		}; 
		?>
		<!-- END OLD ARTIST THANG -->
		
		
		
		<h2 class="venue"><?php echo $venName; ?></h2>
		<div class="date">
			<?php echo $dayOfWeek; ?> <?php echo $monthName; ?> <?php echo $day; ?>
		</div>
		<ul class="meta">
			<?php if ($ticketLink) { ?>
			<li>
				<a href="<?php echo $ticketLink; ?>" target="_new">Tickets</a>
			</li>
			<?php }; ?>
			<?php if ($rsvp) { ?>
			<li>
				<a href="<?php echo $rsvp; ?>">RSVP</a>
			</li>
			<?php }; ?>
		</ul>
	</div>
	<div class="flip">
		<img class="poster big" src="<?php echo $photoURL; ?>" alt="<?php echo $photoAlt; ?>" data="<?php the_permalink(); ?>"/>
		<div class="arrow"></div>
		<div class="panelWrap">
			<?php
			foreach ($artistsArray as $artID) {
				$art = get_term($artID, 'artist');
				$artistName = $art->name;
				$taxAndIDmusic = "artist_" . $artID;
				$artistMusicURL = get_field('music_url', $taxAndIDmusic);
				$artistTwitterURL = get_field('twitter_url', $taxAndIDmusic);
				$artistPhoto = get_field('artist_photo', $taxAndIDmusic);
				$artistFacebookURL = get_field('facebook_url', $taxAndIDmusic);
				$artistMyspaceURL = get_field('myspace_url', $taxAndIDmusic);
				$artistWebURL = get_field('web_url', $taxAndIDmusic);
				?>
			<div class="panel artist">
				<?php if ($artistWebURL) { ?>
					<a href="<?php echo $artistWebURL; ?>" target="_new">
						<h1><?php echo $artistName; ?></h1>
					</a>
				<?php } else { ?>
					<h1><?php echo $artistName; ?></h1>
				<?php }; ?>
				<img src="<?php echo $artistPhoto['sizes']['artist-img']; ?>" class="artistImg"/>
				<div class="social">
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
		</div>
	</div>
	<div class="clear"></div>
</article>