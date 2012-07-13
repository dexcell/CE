<?php defined('SYSPATH') or die('No direct access allowed.');

class Kohana_CE_Google extends CE {

	public function convert($amount, $from, $to)
	{
		$response = Request::factory("http://www.google.com/ig/calculator?hl=en&q={$amount}{$from}%3D%3F{$to}")
			->method(Request::GET)
			->execute()
			->body();

		$matches = array();
		// Get only the rhs
		preg_match('/rhs: \"(\d*.\d*\.?\d*)/', $response, $matches);
		// Get the rate
		$rate = $matches[1];
		// Clean invalid multibyte characters
		$rate = UTF8::clean($rate);

		return (float) $rate;
	}

}