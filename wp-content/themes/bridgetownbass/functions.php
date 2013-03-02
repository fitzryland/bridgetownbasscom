<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );

	/* ========================================================================================================================
	
	Theme specific settings
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	
	add_image_size( 'artist-img', 224, 224, true );
	
	register_nav_menus(array('primary' => 'Primary Navigation'));
	register_nav_menus(array('FuturePast' => 'Secondary Navigation'));
	
	//hook into the init action and call create_book_taxonomies when it fires
	add_action( 'init', 'create_artist_taxonomies', 0 );

	function create_artist_taxonomies() 
	{
	  // Add new taxonomy, NOT hierarchical (like tags)
	  $labels = array(
	    'name' => _x( 'Artists', 'taxonomy general name' ),
	    'singular_name' => _x( 'Artist', 'taxonomy singular name' ),
	    'search_items' =>  __( 'Search Artists' ),
	    'popular_items' => __( 'Popular Artists' ),
	    'all_items' => __( 'All Artists' ),
	    'parent_item' => null,
	    'parent_item_colon' => null,
	    'edit_item' => __( 'Edit Artists' ), 
	    'update_item' => __( 'Update Artists' ),
	    'add_new_item' => __( 'Add New Artists' ),
	    'new_item_name' => __( 'New Artists Name' ),
	    'separate_items_with_commas' => __( 'Separate artists with commas' ),
	    'add_or_remove_items' => __( 'Add or remove artists' ),
	    'choose_from_most_used' => __( 'Choose from the most used artists' ),
	    'menu_name' => __( 'Artists' ),
	  ); 

	  register_taxonomy('artist','events',array(
	    'hierarchical' => false,
	    'labels' => $labels,
	    'show_ui' => true,
	    'update_count_callback' => '_update_post_term_count',
	    'query_var' => true,
	    'rewrite' => array( 'slug' => 'writer' ),
	  ));
	}
	
	/*****  Custom Taxonomy Order Stuff *****/
	register_field('Tax_order', dirname(__File__) . '/taxorder/tax_order.php');
	
	
	/****** Dashboard Stuff ******/
	
	// Create the function to use in the action hook

	function remove_default_dashboard_widgets() {
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
	} 

	// Hoook into the 'wp_dashboard_setup' action to register our function

	add_action('wp_dashboard_setup', 'remove_default_dashboard_widgets' );

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'script_enqueuer' );

	add_filter( 'body_class', 'add_slug_to_body_class' );

	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function script_enqueuer() {
		wp_register_style( 'screen', get_template_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
	}
?>