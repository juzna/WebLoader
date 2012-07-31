<?php

namespace WebLoader\Nette\Config;

/**
 * WebLoader for Nette DI Container
 *
 * @author Jan Dolecek <juzna.cz@gmail.com>
 */
class WebLoaderExtension extends \Nette\Config\CompilerExtension
{
	public $defaults = array(
		'css' => array(
			'rootDir' => "%wwwDir%/css",
			'tempDir' => "%wwwDir%/temp",
			'webTempDir' => "temp",
			'files' => array(
				"screen.css",
			),
		),
		'javascript' => array(
			'rootDir' => "%wwwDir%/js",
			'tempDir' => "%wwwDir%/temp",
			'webTempDir' => "temp",
			'files' => array(
			),
		),
	);



	public function loadConfiguration()
	{
		$container = $this->getContainerBuilder();
		$config = $this->getConfig($this->defaults);

		$container->addDefinition($this->prefix('css'))
			->setClass('WebLoader\Nette\CssLoader')
			->setFactory('WebLoader\Nette\CssLoader::createLoader', array(
				$config['css']['rootDir'],
				$config['css']['tempDir'],
				$config['css']['webTempDir'],
				$config['css']['files'],
			)
		);

		$container->addDefinition($this->prefix('javascript'))
			->setClass('WebLoader\Nette\JavaScriptLoader')
			->setFactory('WebLoader\Nette\JavaScriptLoader::createLoader', array(
				$config['javascript']['rootDir'],
				$config['javascript']['tempDir'],
				$config['javascript']['webTempDir'],
				$config['javascript']['files'],
			)
		);
	}

}
