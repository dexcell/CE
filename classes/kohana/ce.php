<?php defined('SYSPATH') or die('No direct access allowed.');

abstract class Kohana_CE {
  
  // CE instances
	protected static $_instance;
  
  protected $_config = array();
  
  /**
	 * Singleton pattern
	 *
	 * @return CE
	 */
	public static function instance()
	{
		if ( ! isset(CE::$_instance))
		{
			// Load the configuration for this type
			$config = Kohana::$config->load('ce');

			if ( ! $type = $config->get('driver'))
			{
				$type = 'google';
			}

			// Set the class name
			$class = 'CE_'.ucfirst($type);

			// Create a new instance
			CE::$_instance = new $class($config);
		}

		return CE::$_instance;
	}
  
  public function __construct($config)
  {
    $this->_config = $config;
  }

  abstract public function convert($amount, $from, $to);
  
}