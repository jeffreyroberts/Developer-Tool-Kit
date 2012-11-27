<?php

define('_TK_ROOT', getenv('_TK_ROOT'));

// Grab required files for parsing YAML config
require(_TK_ROOT .'/library/yaml-parser/Yaml.php');
require(_TK_ROOT .'/library/yaml-parser/Parser.php');
require(_TK_ROOT .'/library/yaml-parser/Inline.php');
require(_TK_ROOT .'/library/yaml-parser/Unescaper.php');

require(_TK_ROOT .'/library/yaml-parser/Exception/ExceptionInterface.php');
require(_TK_ROOT .'/library/yaml-parser/Exception/RuntimeException.php');
require(_TK_ROOT .'/library/yaml-parser/Exception/ParseException.php');


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
		$file = _TK_ROOT .'/share/settings.yaml';
		$settings = Symfony\Component\Yaml\Yaml::parse($file);

		// Grab gitignored config
		$file = _TK_ROOT .'/share/config.yaml';
		$config = Symfony\Component\Yaml\Yaml::parse($file);

		// Ensure we are always dealing with arrays
		if(!is_array($settings))
			$settings = array($settings);
		if(!is_array($config))
			$config = array($config);

		// Merge them and clean up
		$return = array_merge_multi_dimension($settings, $config);
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