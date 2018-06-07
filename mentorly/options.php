<?php

// add the menu for the options setttings
add_action('admin_menu', 'mentorly_create_menu');

function mentorly_create_menu() {
	$svg_icon = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAllBMVEUplMkplcoplswvmcswmcsxmss1nMs3ncs8n8o+oMpBospHpMlNqMhZrsdarsdissZls8Z0usR4vMR5vcSEwsOGw8ORycGUysGYzMGh0cCp1L+q1b+r1b+v17653L283b2+3rvE4brF4rzG4rzX6rrZ7Lrb7brc7Ljc7brf77ng77nj8Lnk8bnq9Ljt9bjw97fy+Lf//rZfA/FIAAAAdElEQVR4Aa3ORQ7EMBAF0e5hZmaYCUP6/pcLxJa+ZSmr1PKtitiOqGPHjTg+PB/7gYnLVIqiGeIkk6qgD3gS1Qbwq/EK+NF4ATxqXAOOktr+XVxaxKV5U3N+uLvftj2YX52huUJfoJ/CENFpAZn57UIvZsoBJGQfN4T6b9oAAAAASUVORK5CYII=";
	$parent_slug = 'mentorly_main_menu';
	$capability = 'manage_options';
	
	//create new top-level menu
    add_menu_page(
        __( 'Mentorly Plugin Page', 'mentorly_plugin' ),
        __( 'Mentorly', 'mentorly_plugin' ),
        $capability,
        $parent_slug,
        'mentorly_dashboard_page',
        $svg_icon
    );
	add_submenu_page($parent_slug, 
					 __( 'Mentorly Dashboard', 'mentorly_plugin' ),
					 __( 'Dashboard',  'mentorly_plugin' ),
					 $capability, 
					 $parent_slug, 
					 'mentorly_dashboard_page');
	add_submenu_page($parent_slug, 
					 __( 'Mentorly Settings', 'mentorly_plugin' ),
					 __( 'Settings',  'mentorly_plugin' ),
					 $capability, 
					 'mentorly_settings_menu', 
					 'mentorly_settings_page');
    add_submenu_page($parent_slug, 
					 __( 'Mentorly Emails',  'mentorly_plugin' ),
					 __( 'Emails',  'mentorly_plugin' ),
					 $capability, 
					 'mentorly_emails_menu', 
					 'mentorly_emails_page');
}

include( plugin_dir_path( __FILE__ ) . '/options_general.php');
include( plugin_dir_path( __FILE__ ) . '/options_dashboard.php');
include( plugin_dir_path( __FILE__ ) . '/options_emails.php');

 ?>