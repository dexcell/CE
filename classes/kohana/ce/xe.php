<?php defined('SYSPATH') or die('No direct access allowed.');

class Kohana_CE_Xe extends CE {

	public function convert($amount, $from, $to)
	{
		// Get feed url
		$feed_url = $this->_config->feed_url[$from];

		// Get xml
		$xml = Request::factory($feed_url)
			->method(HTTP_Request::GET)
			->execute()
			->body();

		// Create new dom document
		$doc = new DOMDocument();
		$doc->preserveWhiteSpace = false;
		$doc->loadXML($xml);

		// Get the currencies node list
		$currencies = $doc->getElementsByTagName('currency');

		// Set default rate
		$rate = 0;

		foreach ($currencies as $currency)
		{
			$values = array();
			foreach ($currency->childNodes as $node)
			{
				$values[$node->nodeName] = $node->nodeValue;
			}

			if ($values['csymbol'] == $to)
			{
				$rate = $values['crate'];
				break;
			}
		}

		return $amount * $rate;
	}

}