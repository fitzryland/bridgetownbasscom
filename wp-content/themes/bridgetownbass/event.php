<?php
// Date
// quick test change
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






</article>