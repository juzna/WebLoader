<?php

namespace WebLoader\Nette;

use Nette\Utils\Html;

/**
 * Css loader
 *
 * @author Jan Marek
 * @license MIT
 */
class CssLoader extends WebLoader
{

	/** @var string */
	private $media;

	/**
	 * Get media
	 * @return string
	 */
	public function getMedia()
	{
		return $this->media;
	}

	/**
	 * Set media
	 * @param string $media
	 * @return CssLoader
	 */
	public function setMedia($media)
	{
		$this->media = $media;
		return $this;
	}

	/**
	 * Get link element
	 * @param string $source
	 * @return Html
	 */
	public function getElement($source)
	{
		return Html::el("link")->rel("stylesheet")->type("text/css")->media($this->media)->href($source);
	}

	/**
	 * Factory for simple loader
	 *
	 * @param string $rootDir Root directory for relative paths
	 * @param string $tempDir Temp directory to store generated files
	 * @param string $webTempDir URL where generated files are available via HTTP
	 * @param array $baseFiles List of files to include by default
	 * @return CssLoader
	 */
	public static function createLoader($rootDir, $tempDir, $webTempDir, array $baseFiles = NULL)
	{
		$files = new \WebLoader\FileCollection($rootDir);
		if ($baseFiles) $files->addFiles($baseFiles);

		$compiler = \WebLoader\Compiler::createCssCompiler($files, $tempDir);

		$control = new \WebLoader\Nette\CssLoader($compiler, $webTempDir);
		$control->setMedia('screen');

		return $control;
	}

}
