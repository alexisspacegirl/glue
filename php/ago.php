<?php
function ago($a) {

	$b = strtotime("now"); 
	$c = strtotime($a);
	$d = $b - $c;

	$minute = 60;
	$hour = $minute * 60;

	$day = $hour * 24;
	$week = $day * 7;
	$month = $day * 30;

	if(is_numeric($d) && $d > 0) {

		// Seconds
		if($d < 3) return "Right now";
		if($d < $minute) return "Less than a minute ago";

		// Minutes
		if($d < $minute * 2) return "About a minute ago";
		if($d < $minute * 25) return floor($d / $minute) . " minutes ago";
		if($d < $minute * 35) return "About half an hour ago";
		if($d < $minute * 55) return floor($d / $minute) . " minutes ago";

		// Hours
		if($d < $minute * 70) return "About an hour ago";
		if($d < $hour * 2) return "1 hour ago";
		if($d < $day) return floor($d / $hour) . " hours ago";

		// Days
		if($d > $day && $d < $day * 2) return "Yesterday";
		if($d < $week) return floor($d / $day) . " days ago";

		// Weeks
		if($d < $week * 2) return "Last week";
		if($d < $month) return floor($d / $week) . " weeks ago";

		// Months
		if($d < $month * 2) return "1 month ago";
		if($d < $month * 12) return floor($d / $month) . " months ago";

		// Years
		if($d < $month * 13) return "About a year ago";
		return "Over a year ago";
	}
}
?>
