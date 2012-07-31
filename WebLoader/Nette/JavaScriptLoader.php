<?php

namespace WebLoader\Nette;

use Nette\Utils\Html;

/**
 * JavaScript loader
 *
 * @author Jan Marek
 * @license MIT
 */
class JavaScriptLoader extends WebLoader
{

	/**
	 * Get script element
	 * @param string $source
	 * @return Html
	 */
	public function getElement($source)
	{
		return Html::el("script")->type("text/javascript")->src($source);
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

		$compiler = \WebLoader\Compiler::createJsCompiler($files, $tempDir);

		$control = new \WebLoader\Nette\JavaScriptLoader($compiler, $webTempDir);

		return $control;
	}

}
