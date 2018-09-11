<?php

class DateTimeView {


	public function show() {

		$timeString =  date("l") . ',the' . date("d") . 'th of ' . date("F Y,") . ' The time is' ;

		return '<p>' . $timeString . '</p>';
	}
}