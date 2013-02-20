<?php
/**
 * The Template for displaying all single posts
 *
 * Please see /external/starkers-utilities.php for info on get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php
include 'header.php';
if ( have_posts() ) while ( have_posts() ) : the_post();
	include 'event.php';
endwhile;
include 'footer.php';
?>