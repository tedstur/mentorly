<?php

// Handles the general settings

add_action( 'admin_init', 'init_mentorly_settings' );

function mentorly_setting_section() {
    echo '<p>' . __('General options', 'mentorly_plugin') . '</p>';
}

function init_mentorly_settings() {

	add_settings_section(
		'mentorly_setting_section',               // ID used to identify this section and with which to register options
		__('Mentorly General Options', 'mentorly_plugin'),        // Title to be displayed on the administration page
		'mentorly_setting_section_cb',            // Callback used to render the description of the section
		'mentorly_settings'                       // Page on which to add this section of options
	);	

	add_settings_field(                          
		'mentorly_administator_name',			// ID for the field
		__('Administrator name', 'mentorly_plugin'),		// Title for the field
		'administator_name_cb',					// Callback function for the field
		'mentorly_settings',					// Settings page
		'mentorly_setting_section'				// Section
	);
	
	add_settings_field(                          
		'mentorly_email_to_send_from',			// ID for the field
		__('Email address used in the from field of generated emails', 'mentorly_plugin'),		// Title for the field
		'email_to_send_from_cb',				// Callback function for the field
		'mentorly_settings',					// Settings page
		'mentorly_setting_section'				// Section
	);

	add_settings_field(                          
		'mentorly_mentor_page_after_signup',	// ID for the field
		__('Page to show mentor after signup', 'mentorly_plugin'),		// Title for the field
		'mentor_page_after_signup_cb',			// Callback function for the field
		'mentorly_settings',					// Settings page
		'mentorly_setting_section'				// Section
	);
	
	add_settings_field(
		'mentorly_mentee_page_after_signup',	// ID for the field
		__('Page to show mentee after signup', 'mentorly_plugin'),		// Title for the field
		'mentee_page_after_signup_cb',			// Callback function for the field
		'mentorly_settings',					// Settings page
		'mentorly_setting_section'				// Section
	);
	
	add_settings_field(                          
		'mentorly_gender_option',				// ID for the field
		__('Use gender in filtering matches', 'mentorly_plugin'),		// Title for the field
		'mentor_page_gender_cb',				// Callback function for the field
		'mentorly_settings',					// Settings page
		'mentorly_setting_section'				// Section
	);

	register_setting('mentorly_settings', 'mentorly_email_to_send_from');
	register_setting('mentorly_settings', 'mentorly_mentor_page_after_signup');
	register_setting('mentorly_settings', 'mentorly_mentee_page_after_signup');
	register_setting('mentorly_settings', 'mentorly_gender_option' );

}

// display title of section
function mentorly_setting_section_cb() {
	_e('Mentor pages and other settings', 'mentorly_plugin');
}

// field content cb
function administator_name_cb ()
{
	echo '<input name="mentory_administator_name" id="mentorly_administator_name" type="input" ' . checked( 1, get_option( 'mentorly_administator_name' ), false ) . ' /> <i>This is the name of the person (or organization if you prefer) administrating the mentoring program.</i>';
}

// field content cb
function email_to_send_from_cb ()
{
	echo '<input name="mentorly_email_to_send_from" id="mentorly_email_to_send_from" type="input" ' . checked( 1, get_option( 'mentorly_email_to_send_from' ), false ) . ' /> <i>' . __('This is the email address that will be used to send emails from.', 'mentorly_plugin') . '</i>';
}

// field content cb
function mentor_page_after_signup_cb()
{
   $setting = get_option('mentorly_mentor_page_after_signup');
   $args = array('selected' => $setting,
				 'name'		=> 'mentorly_mentor_page_after_signup',
				 'echo'     => 1);
	wp_dropdown_pages( $args );
}

// field content cb
function mentee_page_after_signup_cb()
{
   $setting = get_option('mentorly_mentee_page_after_signup');
   $args = array('selected' => $setting,
				 'name'		=> 'mentorly_mentee_page_after_signup',
				 'echo'     => 1);
	wp_dropdown_pages( $args );
}

function mentor_page_gender_cb()
{
	echo '<input type="checkbox" name="mentorly_gender_option" value="1"', checked(1, get_option('mentorly_gender_option'), true), '/>'; 
}

function mentorly_validate_settings() {
	// NEED AN EMAIL VALIDATOR HERE!!!!!
}

function mentorly_settings_page() {

	 // check user capabilities
	 if ( ! current_user_can( 'manage_options' ) ) {
	 return;
	 }
	?>
	<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form action="options.php" method="post">
	<?php
	settings_fields( 'mentorly_settings' );
	// output setting sections and their fields
	do_settings_sections( 'mentorly_settings' );
	// output save settings button
	submit_button( __('Save Settings', 'mentorly_plugin') );
	?>
	</form>
	</div>
 <?php
}
?>