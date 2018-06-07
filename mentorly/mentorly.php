<?php
/*
Plugin Name: Mentorly
Plugin URL: http://www.esler.org/mentorly-plugin
Description: Match mentors with mentees
Version: 0.1
Author: Ted Esler
Author URI: http://www.esler.org
Text Domain: mentorly-plugin
License: GPLv2

Mentorly is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Mentorly is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Mentor Match. If not, see http://www.esler.org/mentorly-plugin/license.

The unique plugin identifier for this plugin is mentorly_plugin

*/

function mentorly_activate() {
    
	// add pages for after signups
	$new_page_title = __('Mentor Signup Recorded', 'mentorly_plugin' );
	$new_page_content = __('We have recorded your signup as a mentor. Please check your email for further details.', 'mentorly_plugin' );
	$new_page_template = ''; 
    $page_check = get_page_by_title($new_page_title);
    $new_page = array('post_type' => 'page',
					  'post_title' => $new_page_title,
					  'post_content' => $new_page_content,
					  'post_status' => 'publish',
					  'post_author' => 1, );
    if(!isset($page_check->ID)){
        $mentor_page_id = wp_insert_post($new_page);
    } else {
		$mentor_page_id = $page_check->ID;
    }
	$new_page_title = __( 'Mentee Signup Recorded', 'mentorly_plugin' );
	$new_page_content = __( 'We have recorded your signup as a mentee. Please check your email for further details.',  'mentorly_plugin' );
	$new_page_template = ''; 
    $page_check = get_page_by_title($new_page_title);
    $new_page = array('post_type' => 'page',
					  'post_title' => $new_page_title,
					  'post_content' => $new_page_content,
					  'post_status' => 'publish',
					  'post_author' => 1, );
    if(!isset($page_check->ID)){
        $mentee_page_id = wp_insert_post($new_page);
    } else {
		$mentee_page_id = $page_check->ID;
    }
	update_option( 'mentorly_mentor_page_after_signup', $mentor_page_id );
	update_option( 'mentorly_mentee_page_after_signup', $mentee_page_id );
}


function mentorly_deactivation()
{
    // clear the permalinks to remove our post type's rules
    flush_rewrite_rules();
}

function mentorly_install()
{
	// check the WordPress version
	global $wp_version;
	
	if (version_compare( $wp_version, '4.1', '<' ) ) {
		wp_die(  __( 'This plugin requires WordPress version 4.1 or higher.' , 'mentorly_plugin') );
	}  
}

load_plugin_textdomain('mentorly', false, basename( dirname( __FILE__ ) ) . '/languages' );

register_activation_hook( __FILE__, 'mentorly_install' );
register_deactivation_hook( __FILE__, 'mentorly_deactivation' );
register_activation_hook( __FILE__, 'mentorly_activate' );

include( plugin_dir_path( __FILE__ ) . '/options.php');
include( plugin_dir_path( __FILE__ ) . '/mentor_form.php');

?>