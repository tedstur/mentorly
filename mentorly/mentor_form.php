<?php
// This is the form a mentor fills out

// this include provides the dropdown box for timezone selection
// include( plugin_dir_path( __FILE__ ) . '/tz.php');

//[mentorly_mentor]


function mentorly_mentee_func( $atts ){
	
	ob_start(); ?> 
	
	<div id="responseform">
	<?php echo $response; ?>
	<form action="<?php the_permalink(); ?>" method="post">
    <p><label for="mentorly_first_name">First Name<br><input type="text" name="mentorly_first_name" value="<?php echo esc_attr($_POST['mentorly_first_name']); ?>"></label></p>
    <p><label for="mentorly_last_name">Last Name<br><input type="text" name="mentorly_last_name" value="<?php echo esc_attr($_POST['mentorly_last_name']); ?>"></label></p>
    <p><label for="mentorly_email">Email Address<br><input type="text" name="mentorly_email" value="<?php echo esc_attr($_POST['mentorly_email']); ?>"></label></p>
    <p><label for="mentorly_phone">Phone<br><input type="text" name="mentorly_phone" value="<?php echo esc_attr($_POST['mentorly_phone']); ?>"></label></p>
    <p><label for="mentorly_tz">Your Time Zone<br><?php echo timezone_dropdown($name, $current_value); ?></label></p>
	<p><label for="mentorly_current_role">Current Role<br><input type="text" name="mentorly_current_role" value="<?php echo esc_attr($_POST['mentorly_current_role']); ?>"></label></p>
	<p><label for="mentorly_organization">Organization<br><input type="text" name="mentorly_organization" value="<?php echo esc_attr($_POST['mentorly_organization']); ?>"></label></p>
	<p><label for="mentorly_years_in">Years in Role<br><input type="text" name="mentorly_years_in" value="<?php echo esc_attr($_POST['mentorly_years_in']); ?>"></label>
    <p><label for="mentorly_linkedin">URL for Linkedin Profile<br><input type="text" name="mentorly_linkedin" value="<?php echo esc_attr($_POST['mentorly_linkedin']); ?>"></label></p>
    <p><label for="mentorly_linkedin">Phone<br><input type="text" name="mentorly_linkedin" value="<?php echo esc_attr($_POST['mentorly_linkedin']); ?>"></label></p>
    <p><label for="mentorly_shortbio">Short Bio<br><textarea name="mentorly_shortbio" value="<?php echo esc_attr($_POST['mentorly_shortbio']); ?>"></textarea></label></p>
    <p><label for="mentorly_intensity">Intensity of Mentoring<br><select name="mentorly_intensity">
	<?php 
		$current_selection = esc_attr($_POST['mentorly_intensity']);
		$intensity_array = array("Weekly" => __("Weekly", 'mentorly_plugin'),
								 "Monthly" => __("Monthly", 'mentorly_plugin'),
								 "Quarterly" => __("Quarterly", 'mentorly_plugin'),
								 "Any" => __("Any", 'mentorly_plugin'));
		foreach ($intensity_array as $item) {
			if ($item == $current_selection) {
				echo "<option selected>" . $item . "</option>";
			} else {
				echo "<option>" . $item . "</option>";
			}
		}
	?>
	</select></label></p>
    <p><label for="mentorly_mentee_goals">What are your goals in seeking a mentor?<br><textarea name="mentorly_mentee_goals" value="<?php echo esc_attr($_POST['mentorly_mentee_goals']); ?>"></textarea></label></p>
	
    <input type="hidden" name="submitted" value="1">
    <p><input type="submit"></p>
  </form>
</div>

<?php
	return ob_get_clean();
}

add_shortcode( 'mentorly_mentee_form', 'mentorly_mentee_func' );

?>