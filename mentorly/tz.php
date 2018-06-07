<?php
// This is a basic timezone drop down box


// This function returns an array of timezones that looks like this:
//
//  Array
//  (
//    [Pacific/Midway]    => (GMT-11:00) Pacific, Midway
//    [Pacific/Niue]      => (GMT-11:00) Pacific, Niue
//    [Pacific/Pago_Pago] => (GMT-11:00) Pacific, Pago Pago
//    [America/Adak]      => (GMT-10:00) America, Adak
//    [Pacific/Honolulu]  => (GMT-10:00) Pacific, Honolulu
//    [Pacific/Johnston]  => (GMT-10:00) Pacific, Johnston
//    [Pacific/Rarotonga] => (GMT-10:00) Pacific, Rarotonga
//    [Pacific/Tahiti]    => (GMT-10:00) Pacific, Tahiti
//    [Pacific/Marquesas] => (GMT-09:30) Pacific, Marquesas
//    [America/Anchorage] => (GMT-09:00) America, Anchorage
//	  etc...
//	
function timezone_list() {
    static $timezones = null;

    if ($timezones === null) {
        $timezones = [];
        $offsets = [];
        $now = new DateTime('now', new DateTimeZone('UTC'));

        foreach (DateTimeZone::listIdentifiers() as $timezone) {
            $now->setTimezone(new DateTimeZone($timezone));
            $offsets[] = $offset = $now->getOffset();
            $timezones[$timezone] = '(' . format_GMT_offset($offset) . ') ' . format_timezone_name($timezone);
        }

        array_multisort($offsets, $timezones);
    }

    return $timezones;
}

function format_GMT_offset($offset) {
    $hours = intval($offset / 3600);
    $minutes = abs(intval($offset % 3600 / 60));
    return 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
}

function format_timezone_name($name) {
    $name = str_replace('/', ', ', $name);
    $name = str_replace('_', ' ', $name);
    $name = str_replace('St ', 'St. ', $name);
    return $name;
}

// This function creates a dropdown box string
// The single paramater, if present, is the currently selected option

function timezone_dropdown($name, $current_value) {
	static $alltimezones = null;
	$alltimezones = timezone_list();
	$name = "<select name='" . $name . "'>";

	foreach($alltimezones as $item) {
		$name = $name .= "<option value='" . $item;
		if ($current_value == $item) {
			$name .= " selected ";
		}
		$name .= "'>" . $item . "</option>";
	}
	$name .= "</select>";
	return $name;
}
?>