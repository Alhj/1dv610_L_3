<?php

class DateTimeView {


	public function show() {

		$timeString = date("l") . ', the ' . date("jS") . " of " . date("F Y,") . ' The time is '  ;

		return '<p>' . $timeString . '</p>';
	}
}