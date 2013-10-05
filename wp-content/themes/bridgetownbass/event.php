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
	echo "class=\"event highlight\"";
} else {
	echo "class=\"event\"";
}
?>>
	<img class="poster" src="<?php echo $photoURL; ?>" alt="<?php echo $photoAlt; ?>" />
<div class="flip">
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
				<?php if ($artistWebURL) { ?>
					<a href="<?php echo $artistWebURL; ?>" target="_new">
						<h1><?php echo $artistName; ?></h1>
					</a>
				<?php } else { ?>
					<h1><?php echo $artistName; ?></h1>
				<?php }; ?>
				<img src="<?php echo $artistPhoto['sizes']['artist-img']; ?>" class="artistImg"/>
				<?php if ($artistMusicURL) { ?>
					<a href="<?php echo $artistMusicURL; ?>" target="_new">SOUNDCLOUD</a>
				<?php }; ?>
				<?php if ($artistTwitterURL) { ?>
					<a href="<?php echo $artistTwitterURL; ?>" target="_new">TWITTER</a>
				<?php }; ?>
				<?php if ($artistFacebookURL) { ?>
					<a href="<?php echo $artistFacebookURL; ?>" target="_new">FACEBOOK</a>
				<?php }; ?>
				<?php if ($artistMusicURL && $artistTwitterURL && $artistFacebookURL) {} elseif ($artistMyspaceURL) { ?>
					<a href="<?php echo $artistMyspaceURL; ?>" target="_new">MYSPACE</a>
				<?php }; ?>
			<?php
			};
			?>

			<?php if ($venCalendarURL) { ?>
				<a href="<?php echo $venCalendarURL; ?>" target="_new" title="">
					<h1><?php echo $venName; ?></h1>
				</a>
			<?php } else { ?>
				<h1><?php echo $venName; ?></h1>
			<?php }; ?>
			<?php if ($venTwitterURL) { ?>
					<a href="<?php echo $venTwitterURL; ?>" target="_new" title="">TWITTER</a>
			<?php }; ?>
			<?php if ($venFacebookURL) { ?>
					<a href="<?php echo $venFacebookURL; ?>" target="_new" title="">FACEBOOK</a>
			<?php }; ?>
			<?php if ($venMapURL) { ?>
					<a href="<?php echo $venMapURL; ?>" target="_new" title="">MAP</a>
			<?php }; ?>
			<?php echo $dayOfWeek . " " . $monthName . " " . $monthNum; ?>
			<?php if ($ticketLink) { ?>
				<a href="<?php echo $ticketLink; ?>" target="_new">TICKETS</a>
			<?php }; ?>
			<?php if ($rsvp) { ?>
				<a href="<?php echo $rsvp; ?>">RSVP</a>
			<?php }; ?>

		</div>
	</div>





</article>