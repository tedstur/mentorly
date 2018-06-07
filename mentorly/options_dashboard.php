<?php
include( plugin_dir_path( __FILE__ ) . '/' . 'class-mentor.php');

// This file handles the dashboard settings page
add_action( 'admin_init', 'register_mentorly_dashboard' );


function dashboard_settings_api_init() {

}


function register_mentorly_dashboard() {
  // load up the dashboard variables here
  
}

function mentorly_dashboard_page() {
?>
<div class="wrap">
<h1>Mentor Match Dashboard</h1>

    <table class="form-table">
        <tr valign="top">
        <td><strong><?php _e('Mentors:', 'mentorly_plugin') ?></strong>&nbsp;0
		
		</td>
		
        <td><strong><?php _e('Mentees:', 'mentorly_plugin') ?></strong>&nbsp;0</td>
        <td><strong><?php _e('Unapproved Applications:', 'mentorly_plugin') ?></strong>&nbsp;0</td>
        </tr>
	</table>
	<?php $mentor = new Mentor( 'John Doe' ); ?>
	
	<?php echo "Test: " . $mentor->post_type_name; ?>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>