<?php

// Handles the options regarding emails

add_action('admin_menu', 'mentorly_emails_init');

function mentorly_email_settings_section() {
	echo '<p>', __('Configure Emails and Communication Options', 'mentorly_plugin'), '</p>';
}

function mentorly_email_settings_section_mentee() {
	echo '<p>', __('Configure Emails and Communication Options', 'mentorly_plugin'), '</p>';
}

function mentorly_email_settings_section_check_in() {
	echo '<p>', __('Configure Emails and Communication Options', 'mentorly_plugin'), '</p>';
}

function mentorly_emails_init() {
 
 
	add_settings_section('mentorly_email_settings_section',
								__('Email to Send to a Mentor Upon Signup', 'mentorly_plugin'),
								'mentorly_email_section_callback_function',
								'mentorly_emails');
			add_settings_field( 'mentorly_auto_send_email_to_mentor_after_signup',
								__('Send email after mentor signup', 'mentorly_plugin'),
								'mentorly_auto_send_email_to_mentor_callback_function',
								'mentorly_emails',
								'mentorly_email_settings_section');
			add_settings_field( 'mentorly_email_welcome_for_mentor',
								__('Email to send to Mentor Applicant<br><br><br>The following shortcodes are available in the body of this email: <ul><li>[mentor_first_name]</li><li>[mentor_last_name]</li><li>[mentor_email]</li><li>[mentor_profile]</li><li>[mentor_profile_link]</li><li>[administrator_name]</li></ul>', 'mentorly_plugin'),
								'mentorly_welcome_for_mentor_callback_function',
								'mentorly_emails',
								'mentorly_email_settings_section');
			add_settings_field( 'mentorly_email_welcome_for_mentor_preview',
								'',
								'mentorly_email_welcome_for_mentor_preview_callback_function',
								'mentorly_emails',
								'mentorly_email_settings_section');


	add_settings_section('mentorly_email_settings_section_mentee',
								__('Email to Send to a Mentee Upon Signup', 'mentorly_plugin'),
								'mentorly_email_section_callback_function',
								'mentorly_emails_mentee');
			add_settings_field( 'mentorly_auto_send_email_to_mentee_after_signup',
								__('Send email after mentee signup', 'mentorly_plugin'),
								'mentorly_auto_send_email_to_mentee_callback_function',
								'mentorly_emails_mentee',
								'mentorly_email_settings_section_mentee');
			add_settings_field( 'mentorly_email_welcome_for_mentee',
								__('Email to send to Mentee Applicant', 'mentorly_plugin'),
								'mentorly_welcome_for_mentee_callback_function',
								'mentorly_emails_mentee',
								'mentorly_email_settings_section_mentee');	

	add_settings_section('mentorly_email_settings_section_check_in',
								__('Email to Send to a Mentor to Remind them of the Mentor/Mentee Relationship', 'mentorly_plugin'),
								'mentorly_email_section_callback_function',
								'mentorly_emails_check_in');
			add_settings_field( 'mentorly_auto_send_mentor_check_in',
								__('Send email on a recurring basis to mentor', 'mentorly_plugin'),
								'mentorly_auto_send_mentor_check_in_callback_function',
								'mentorly_emails_check_in',
								'mentorly_email_settings_section_check_in');
			add_settings_field( 'mentorly_email_mentor_check_in',
								__('Email to send to Mentor to check in on their mentoring', 'mentorly_plugin'),
								'mentorly_mentor_check_in_callback_function',
								'mentorly_emails_check_in',
								'mentorly_email_settings_section_check_in');
			add_settings_field( 'mentorly_email_mentor_check_in_preview',
								'',
								'mentorly_auto_send_mentor_check_in_preview_callback_function',
								'mentorly_emails_check_in',
								'mentorly_email_settings_section_check_in');

	add_settings_section('mentorly_email_settings_section_match_made',
								__('Email to Send to both the Mentor and Mentee when a match is made', 'mentorly_plugin'),
								'mentorly_email_section_callback_function',
								'mentorly_emails_match_made');
			add_settings_field( 'mentorly_auto_send_match_made',
								__('Send email when a match is made', 'mentorly_plugin'),
								'mentorly_auto_send_match_made_callback_function',
								'mentorly_emails_match_made',
								'mentorly_email_settings_section_match_made');
			add_settings_field( 'mentorly_email_match_made',
								__('Email to send to Mentor and Mentee when a match is made', 'mentorly_plugin'),
								'mentorly_match_made_callback_function',
								'mentorly_emails_match_made',
								'mentorly_email_settings_section_match_made');

	register_setting('mentorly_emails','mentorly_auto_send_email_to_mentor_after_signup');
	register_setting('mentorly_emails','mentorly_email_welcome_for_mentor');
	register_setting('mentorly_emails_check_in','email_welcome_for_mentor_preview');	

	register_setting('mentorly_emails_check_in','auto_send_mentor_check_in');
	register_setting('mentorly_emails_check_in','email_mentor_check_in');
	register_setting('mentorly_emails_check_in','email_mentor_check_in_preview');
	
	register_setting('mentorly_emails_mentee','email_welcome_for_mentee');
	register_setting('mentorly_emails_mentee','auto_send_email_to_mentee_after_signup');
	
	
	register_setting('mentorly_emails_match_made','auto_send_match_made');
	register_setting('mentorly_emails_match_made','email_match_made');
}

 function mentorly_email_section_callback_function() {
 	// doing nothing - this is a placeholder
 }

 // mentor functions
 function mentorly_auto_send_email_to_mentor_callback_function() {
 	echo '<input name="mentorly_auto_send_email_to_mentor_after_signup" id="mentorly_auto_send_email_to_mentor_after_signup" type="checkbox" value="1" class="code" ' . checked( 1, get_option( 'mentorly_auto_send_email_to_mentor_after_signup' ), false ) . ' /> <i>' . __('If not set, the user will only see the follow-up page after signing up', 'mentorly_plugin') . '</i>';
 }
 function mentorly_welcome_for_mentor_callback_function() {
	$current_setting = get_option('mentorly_email_welcome_for_mentor');
	if (strlen($current_setting) == 0) {
		$current_setting = __("<h2>Welcome to our Mentor Matching Initiative, [mentor_first_name]!</h2><p>Thank you for being willing to invest in others.</p><p>We have your information and will be reviewing it. We will get back to you with further information.</p><p>A few things to keep in mind:<ul><li>The pool of mentees is in constant flux, but we will be doing our best to find a good match.</li><li>Mentees have the right to accept or reject a possible match that we suggest.</li><li>At any time you can edit your information and withdraw your mentor availability. You can pause your availability and then simply turn it back on when you are ready again.</li></ul>We will be in touch as things develop so stay tuned!</p>", 'mentorly_plugin');
	}	
	wp_editor( $current_setting, 'mentorly_email_welcome_for_mentor' );
 }
 function mentorly_email_welcome_for_mentor_preview_callback_function() {
?>

<div id="mypreview" style="display: none;">
	<H2>This preview is inserting some dummy data!</H2>
		<div id="actualtext"></div>
	<p><input type="button" value="Close" onclick="tb_remove();" title="Close"></p>
</div>

<input type="button" value="Preview" onclick="post();" title="Preview">

<script type="text/javascript">
function post() {
	var body =  tinymce.editors['mentorly_email_welcome_for_mentor'].getContent( { format : 'html' } );
	var url = "<?php echo site_url(); ?>";
	var adminname = "<?php echo get_option('mentorly_administator_name', "(Administrator name not set in General Options)"); ?>";
	var mentorfirstname = "Joe";
	var mentorlastname = "Mentor";
	var mentoremail = "joe.mentor@donotreply.com";
	var mentorprofile = "(Profile Information Here)";
	var mentorprofilelink = "<?php echo plugins_url( 'mentorprofile.php', __FILE__); ?>";
	
	$.post(<?php echo "'" . plugins_url( 'preview.php', __FILE__) . "'"; ?>, 
			{postbody:body,
			 postadminname:adminname,
			 posturl:url, 
			 postmentorfirstname:mentorfirstname,
			 postmentorlastname:mentorlastname,
			 postmentoremail:mentoremail,
			 postmentorprofile:mentorprofile,
			 postmentorprofilelink:mentorprofilelink
			 },
			function(data){
				$('#actualtext').html(data); 
				tb_show("Preview","#TB_inline?height=630&width=440&inlineId=mypreview");
			});
}
</script>

<?php 
}
 
 // mentee functions
 function mentorly_auto_send_email_to_mentee_callback_function() {
 	echo '<input name="mentorly_auto_send_email_to_mentee_after_signup" id="mentorly_auto_send_email_to_mentee_after_signup" type="checkbox" value="1" class="code" ' . checked( 1, get_option( 'mentorly_auto_send_email_to_mentee_after_signup' ), false ) . ' /> <i>' . __('If not set, the user will only see the follow-up page after signing up', 'mentorly_plugin') . '</i>';
 }

function mentorly_welcome_for_mentee_callback_function() {
	$current_setting = get_option('mentorly_email_welcome_for_mentee');
	if (strlen($current_setting) == 0) {
		$current_setting = __("<h1>Welcome to our Mentor Matching Initiative, [mentee_first_name]!</h1>We are so glad you have signed up, looking for a mentor. We have your information and will be reviewing it. We will get back to you with further information.<br><br>A few things to keep in mind:<ul><li>The pool of mentors is in constant flux, but we will be doing our best to find a good match.</li><li>Mentors have the right to accept or reject a possible match that we suggest and signing up is no guarantee that we will be able to find a suitable mentor.</li><li>At any time you can edit your information and withdraw your mentor search.</li></ul>We will be in touch as things develop so stay tuned!", 'mentorly_plugin');
	}
	wp_editor( $current_setting, 'mentorly_email_welcome_for_mentee' );
}
 
// mentor check-in email callback
function mentorly_auto_send_mentor_check_in_callback_function() {
 	echo '<input name="mentorly_auto_send_mentor_check_in" id="mentorly_auto_send_mentor_check_in" type="checkbox" value="1" class="code" ' . checked( 1, get_option( 'mentorly_auto_send_email_to_mentee_after_signup' ), false ) . ' /> <i>' . __('If not set, the user will only see the follow-up page after signing up', 'mentorly_plugin') . '</i>';
}

function mentorly_auto_send_mentor_check_in_preview_callback_function() {
		echo '<input name="Preview" type="submit" value="Preview")';
}
 
 function mentorly_mentor_check_in_callback_function() {
	$current_setting = get_option('mentorly_email_mentor_check_in');
	if (strlen($current_setting) == 0) {
		$current_setting = __("<h1>This is a friendly reminder!</h1>We are so glad you have signed up to mentor somebody.<br><br>This email is a short check-in email to remind you of this relationship.<br><br>If there are no changes in your mentoring relationship, you don't have to do anything. If there are changes, you might want to let us know by <a href='[mentorly_siteurl]' >visiting the website and updating your information.</a><br><br>Here are the mentoring relationship(s) we have on file for you:[mentorly_mentees_list]<br><br>We will be in touch as things develop so stay tuned!", 'mentorly_plugin');
	}
	wp_editor ($current_setting , 'mentorly_email_mentor_check_in');
 }
 
 // mentor/mentee match made
 function mentorly_auto_send_match_made_callback_function() {
 	echo '<input name="mentorly_auto_send_match_made" id="mentorly_auto_send_match_made" type="checkbox" value="1" class="code" ' . checked( 1, get_option( 'mentorly_auto_send_match_made' ), false ) . ' /> <i>' . __('If not set, no emails will be sent when a match is made.', 'mentorly_plugin') . '</i>';
 }

 function mentorly_match_made_callback_function() {
	$current_setting = get_option('mentorly_email_match_made');
	if (strlen($current_setting) == 0) {
		$current_setting = __("<h1>We have a match for a Mentor/Mentoring Relationship</h1><p>Thank you for being willing to invest in others.</p><p>We are suggesting that you consider mentoring [mentorly_mentee_first_name] [mentorly_mentee_last_name].</p><p>This person's full profile is:</p>[mentorly_mentee_profile]<p>The decision to mentor this person or not is up to you.</p><p>Please let us know your decision by clicking here: [mentory_decide_on_mentoring]</p>", 'mentorly_plugin');
	}
	wp_editor ($current_setting , 'mentorly_email_match_made');
}
 
function mentorly_emails_page() {
?>
<div class="wrap">
	<div id="icon-themes" class="icon32"></div>
	<?php
		echo '<h2>', __('Mentorly Emails', 'mentorly_plugin'), '</h2>';
		settings_errors();
		$active_tab = 'mentor_options';
        if( isset( $_GET[ 'tab' ] ) ) {
             $active_tab = $_GET[ 'tab' ];
        } // end if
    ?>

	<h2 class="nav-tab-wrapper">
		<a href="?page=mentorly_emails_menu&tab=mentor_options" class="nav-tab <?php echo ($active_tab == 'mentor_options' ? 'nav-tab-active' : '') , '">', __('Mentor Signup Email', 'mentorly_plugin'), '</a>' ; ?>
		<a href="?page=mentorly_emails_menu&tab=mentee_options" class="nav-tab <?php echo ($active_tab == 'mentee_options' ? 'nav-tab-active' : '') , '">', __('Mentee Signup Email', 'mentorly_plugin'), '</a>'; ?>
		<a href="?page=mentorly_emails_menu&tab=mentor_check_in_options" class="nav-tab <?php echo ($active_tab == 'mentor_check_in_options' ? 'nav-tab-active' : ''), '">', __('Mentor Check In Email', 'mentorly_plugin'), '</a>'; ?>
		<a href="?page=mentorly_emails_menu&tab=match_made" class="nav-tab <?php echo ($active_tab == 'match_made' ? 'nav-tab-active' : ''), '">', __('Match Made Email', 'mentorly_plugin'), '</a>'; ?>
	</h2>
		
    <form method="post" action="options.php">
		<?php
			switch ($active_tab) {
				case 'mentor_options';
					settings_fields( 'mentorly_emails' );
					do_settings_sections( 'mentorly_emails' );
				break;
				
				case 'mentee_options';
					settings_fields( 'mentorly_emails_mentee' );
					do_settings_sections( 'mentorly_emails_mentee' );
				break;
				
				case 'mentor_check_in_options';
					settings_fields( 'mentorly_emails_check_in' );
					do_settings_sections( 'mentorly_emails_check_in' );
				break;
				
				case 'match_made';
					settings_fields( 'mentorly_emails_match_made' );
					do_settings_sections( 'mentorly_emails_match_made' );
				break;
			}
			submit_button();
		?>
    </form>
</form>
</div>
<?php } ?>