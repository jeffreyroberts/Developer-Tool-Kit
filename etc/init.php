<?php

// Default to V2
if(getenv('_TK_ROOT') != '')
    define('_TK_ROOT', getenv('_TK_ROOT'));


// Grab required files for parsing YAML config
require(_TK_ROOT .'/etc/libraries/spyc.php');


/**
 * Gets the config array
 *
 * @return array
 * @author Jake A. Smith
 **/
function config()
{
	static $return;

	if(!is_array($return))
	{

		// Grab tracked settings
		$file = _TK_ROOT .'/var/config/settings.yaml';
		$settings = Spyc::YAMLLoad($file);

		// Grab gitignored config
		$file = _TK_ROOT .'/var/config/local.yaml';
		$config = Spyc::YAMLLoad($file);


		// Merge settings and config
		if(!is_null($config))
		{
			$return = array_merge_multi_dimension($settings, $config);
		}

		// Nothing in the config
		else
		{
			$return = $settings;
		}
	}

	return $return;
}

function array_merge_multi_dimension() {
    $params = & func_get_args();
    $merged = array_shift($params); // using 1st array as base

    foreach ($params as $array) {
        foreach ($array as $key => $value) {
            if (isset($merged[$key]) && is_array($value) && is_array($merged[$key]))
                $merged[$key] = array_merge_multi_dimension($merged[$key], $value);
            else
                $merged[$key] = $value;
        }
    }
    return $merged;
}

/**
 * Sends a formatted msg to the CLI
 *
 * @return void
 * @author Jake A. Smith
 **/
function msg($msg)
{
    echo $msg . PHP_EOL;
}