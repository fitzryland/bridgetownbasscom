<?php

/*
Plugin Name: Admin Steez
Description: Administration in style.
Author: Fitz Ryland
Version: 1.0
*/




function my_admin_head() {
	global $current_user;
	get_currentuserinfo();
	if ($current_user->data->user_login !== 'fitzryland') {
		echo '<link rel="stylesheet" type="text/css" href="' .plugins_url('adminstyle.css', __FILE__). '">';
	}
}

add_action('admin_head', 'my_admin_head');

?>