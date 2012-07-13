<?php defined('SYSPATH') or die('No direct access allowed.');

class Kohana_CE_Era extends CE {

	public function convert($amount, $from, $to)
	{
		// Get the api key
		$api_key = $this->_config['api_key'];
		// Get the rate
		$rate = Request::factory("http://www.exchangerate-api.com/{$from}/{$to}/{$amount}?k=$api_key")
			->method(Request::GET)
			->execute()
			->body();

		return (float) $rate;
	}

}