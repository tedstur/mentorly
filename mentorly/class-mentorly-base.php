<?php
	class MentorlyBase {
	
		/* Member variables */
		var $ID;
		var $last_name;
        var $first_name;
        var $phone;
        var $tz;
        var $current_role;
        var $organization;
        var $years_in;
        var $short_bio;
        var $intensity;
        var $length;
        var $goals;
		var $currently_active;
		var $date_created;
		var $date_last_updated;
		var $date_last_active;
      
		/* Member functions */
		function setID($par){
			$this->id = $par;
		}      
		function getID(){
			echo $this->id;
		}

		function setLastName($par){
			$this->last_name = $par;
		}      
		function getLastName(){
			echo $this->last_name;
		}
	
		function setFirstName($par){
			$this->first_name = $par;
		}
		function getFirstName(){
			echo $this->first_name;
		}
	
		function setPhone($par){
			$this->phone = $par;
		}
		function getPhone(){
			echo $this->phone;
		}
		
		function setTZ($par){
			$this->tz = $par;
		}
		function getTZ(){
			echo $this->tz;
		}
			
		function setCurrentRole($par) {
			$this->current_role = $par;
		}
		function getCurrentRole($par) {
			echo $this->current_role;
		}
		
		function setOrganization($par){
			$this->tz = $par;
		}
		function getOrganization(){
			echo $this->tz;
		}
		
		function setYearsIn($par){
			$this->years_in = $par;
		}
		function getYearsIn(){
			echo $this->years_in;
		}

		function setShortBio($par){
			$this->short_bio = $par;
		}
		function getShortBio(){
			echo $this->short_bio;
		}
		
		function setIntensity($par){
			$this->intensity = $par;
		}
		function getIntensity(){
			echo $this->intensity;
		}
		
		function setLength($par){
			$this->length = $par;
		}
		function getLength(){
			echo $this->length;
		}
		
		function setGoals($par){
			$this->goals = $par;
		}
		function getGoals(){
			echo $this->goals;
		}
		
		function setCurrentlyActive($par){
			$this->currently_active = $par;
		}
		function getCurrentlyActive(){
			echo $this->currently_active;
		}
    }
?>
