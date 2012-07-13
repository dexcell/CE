# Currency Exchange Module for Kohana Framework

A Kohana framework module to convert currencies using free or paid services.
Current version support converting currencies using google, exchangerate-api.com, and xe.com

## How to use

### Converting currency

The usage is very straight forward.
Here is an example on how to convert 10 USD to GBP
  
	echo CE::instance()->convert(10, 'USD', 'GBP');

### Setting

See the config file.