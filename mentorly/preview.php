<?php

// send a $mentor_id of 0 to make this work in preview mode
function resolve_shortcodes_in_email($inputstring, 
									 $mentor_id, 
									 $admin_name, 
									 $siteurl,
									 $mentorfirstname,
									 $mentorlastname,
									 $mentoremail,
									 $mentorprofile,
									 $mentorprofilelink) 
	{
		if (strlen($inputstring) == 0) {
		 return ""; 
	} else {
		 $newbuffer = $inputstring;
		 $newbuffer = str_replace("[mentorly_siteurl]", $siteurl, $newbuffer);
		 if ($mentor_id == 0)	{  			
			// this is just preview code not using real mentor/mentee info
			$some_sample_text = "<ul><li>John Doe</li><li>Jane Doe</li><li>etc...</li></ul>";
			$newbuffer = str_replace("[mentees_list]", $some_sample_text, $newbuffer);
			$some_sample_text = "John";
			$newbuffer = str_replace("[mentee_first_name]", $some_sample_text, $newbuffer);
			$some_sample_text = "Doe";
			$newbuffer = str_replace("[mentee_last_name]", $some_sample_text, $newbuffer);
			$some_sample_text = "john.doementee@donotreply.com";
			$newbuffer = str_replace("[mentee_email]", $some_sample_text, $newbuffer);
			$some_sample_text = "MENTEE PROFILE GOES HERE....";
			$newbuffer = str_replace("[mentee_profile]", $some_sample_text, $newbuffer);
			$newbuffer = str_replace("[mentor_first_name]", $mentorfirstname, $newbuffer);
			$some_sample_text = "Doe";
			$newbuffer = str_replace("[mentor_last_name]", $some_sample_text, $newbuffer);
			$some_sample_text = "jane.doementor@donotreply.com";
			$newbuffer = str_replace("[mentor_email]", $some_sample_text, $newbuffer);
			$some_sample_text = "MENTOR PROFILE GOES HERE....";
			$newbuffer = str_replace("[mentorly_mentor_profile]", $some_sample_text, $newbuffer);
			$some_sample_text = "<a href='" . $siteurl . '/mentorlink.php?mentorid=123">Click to accept/reject</a>';
			$newbuffer = str_replace("[mentor_profile_link]", $some_sample_text, $newbuffer);
			$some_sample_text = "<a href='" . $siteurl . '>Click to accept/reject</a>';
			$newbuffer = str_replace("[mentorly_decide_on_mentoring]", $some_sample_text, $newbuffer);
			$newbuffer = str_replace("[administrator_name]", $admin_name, $newbuffer);
		 } else {
			 // this code not written yet - will generate the list of mentees for mentor
		 }
		 return $newbuffer;
	 }
}
echo '<p>';
echo resolve_shortcodes_in_email($_POST['postbody'], 
								 0, 
								 $_POST['postadminname'], 
								 $_POST['posturl'],
								 $_POST['postmentorfirstname'],
								 $_POST['postmentorlastname'],
								 $_POST['postmentoremail'],
								 $_POST['postmentorprofile'],
								 $_POST['postmentorprofilelink']
								 );
echo '</p>';
?>