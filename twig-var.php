<?php
/*
 Copyright (c) 2017 Tuukka Norri
 This code is licensed under MIT license (see LICENSE for details).
 */

namespace Grav\Plugin;

use Grav\Common\Plugin;


class TwigVarPlugin extends Plugin
{
	protected $config = null;

	public static function getSubscribedEvents()
	{
		return array(
			'onPluginsInitialized' => ['onPluginsInitialized', 0]
		);
	}


	public function onPluginsInitialized()
	{
		if ($this->isAdmin())
		{
			$this->active = false;
			return;
		}

		$this->enable([
			'onTwigExtensions' => ['onTwigExtensions', 0]
		]);
	}

	
	public function onTwigExtensions()
	{
		require_once(__DIR__ . '/twig/TwigVarExtension.php');
		$this->grav['twig']->twig->addExtension(new TwigVarExtension());
	}
}

?>
