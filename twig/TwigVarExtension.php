<?php
/*
 Copyright (c) 2017 Tuukka Norri
 This code is licensed under MIT license (see LICENSE for details).
 */

namespace Grav\Plugin;

use \Grav\Common\Grav;
use \Closure;
use \Exception;

class TwigVarExtension extends \Twig_Extension
{
	protected $config;


	public function __construct()
	{
		$this->config = Grav::instance()['config'];
	}


	public function getName()
	{
		return 'TwigVarExtension';
	}


	public function getFilters()
	{
		return array(
			'var' => new \Twig_SimpleFilter('var', function & ($obj, $name) {
				// Check that the given property exists.
				if (!property_exists($obj, $name))
					throw new Exception("Property '" . $name . "' does not exist.");

				// Create a member function in order to bypass access specifiers.
				// Try to get a reference to the value.
				$closure = function & () use($name) {
					return $this->{$name};
				};

				// Bind the function to the object and call it.
				$bound = Closure::bind($closure, $obj, get_class($obj));
				$retval =& $bound();
				return $retval;
			}),

			'set_var' => new \Twig_SimpleFilter('set_var', function($obj, $name, $val) {
				// Check that the given property exists.
				if (!property_exists($obj, $name))
					throw new Exception("Property '" . $name . "' does not exist.");

				// Create a member function in order to bypass access specifiers.
				$closure = function ($val) use($name) {
					$this->{$name} = $val;
				};

				// Bind the function to the object and call it.
				$bound = Closure::bind($closure, $obj, get_class($obj));
				$bound($val);

				// Return the filtered object.
				return $obj;
			})
		);
	}
}
