<?php

class DateTimeView {


	public function show() {

		$timeString = date("l") . ', the ' . date("jS") . date("F Y,") . ' The time is '  ;

		return '<p>' . $timeString . '</p>';
	}
}