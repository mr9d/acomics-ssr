<?php

namespace Acomics\Ssr\Script;

class Build
{
	private const LAYOUTS_DIR = 'src/Layout';
	private const COMPONENTS_DIR = 'Component';
	private const BUNDLE_DIR = 'static/bundle';
	private const HASHES_FILENAME = 'src/hashes.generated.php';

	private static function createBundleDirectory(): void
	{
        $bundleDir = self::BUNDLE_DIR;
        if (!@\mkdir($bundleDir, 0777, true) && !\is_dir($bundleDir)) {
            throw new \RuntimeException("Directory \"{$bundleDir}\" was not created");
        }
	}

	private static function getLayouts(): array
	{
		$files = scandir(self::LAYOUTS_DIR);

		if ($files === false) {
			return [];
		}

		return array_filter(
			$files,
			fn(string $file) => is_dir(self::LAYOUTS_DIR . '/' . $file) && $file !== '.' && $file !== '..'
		);
	}

	private static function getComponents(string $layout): array
	{
		$directory = self::LAYOUTS_DIR . '/' . $layout . '/' . self::COMPONENTS_DIR . '/';

		if (!file_exists($directory)) {
			return [];
		}

		$files = scandir($directory);

		if ($files === false) {
			return [];
		}

		return array_filter(
			$files,
			fn(string $file) => is_dir(self::LAYOUTS_DIR . '/' . $layout . '/' . self::COMPONENTS_DIR . '/' . $file) && $file !== '.' && $file !== '..'
		);
	}

	private static function getComponentsFiles(string $layout, array $components, string $type): array
	{
		$files = array_map(
			fn(string $component) => self::LAYOUTS_DIR . '/' . $layout . '/' . self::COMPONENTS_DIR . '/' . $component . '/' . $component . '.' . $type,
			$components
		);

		return array_filter($files, fn(string $file) => file_exists($file));
	}

	private static function makeBundleFilename(string $layout, string $type): string
	{
		return self::BUNDLE_DIR . '/' . strtolower($layout) . '.' . $type;
	}

	private static function buildCssBundle(string $layout, array $components): ?string
	{
		$files = static::getComponentsFiles($layout, $components, 'css');

		$mainFile = self::LAYOUTS_DIR . '/' . $layout . '/' . $layout . 'Layout.css';
		if (file_exists($mainFile)) {
			array_unshift($files, $mainFile);
		}

		if (count($files) === 0) {
			echo 'File array for CSS bundle is empty.' . PHP_EOL;
			return null;
		}

		$bundleFilename = static::makeBundleFilename($layout, 'css');

		$bundle = '';
		foreach ($files as $file) {
			$bundle .= '/* ' . $file . ' */' . PHP_EOL;
			$bundle .= file_get_contents($file);
			$bundle .= PHP_EOL;
		}
		file_put_contents($bundleFilename, $bundle);

		return $bundleFilename;
	}

	private static function buildJsBundle(string $layout, array $components): ?string
	{
		$files = static::getComponentsFiles($layout, $components, 'js');

		$mainFile = self::LAYOUTS_DIR . '/' . $layout . '/' . $layout . 'Layout.js';
		if (file_exists($mainFile)) {
			array_push($files, $mainFile);
		}

		if (count($files) === 0) {
			echo 'File array for JS bundle is empty.' . PHP_EOL;
			return null;
		}

		$bundleFilename = static::makeBundleFilename($layout, 'js');

		$bundle = '\'use strict\';' . PHP_EOL;
		$bundle .= '(() => {' . PHP_EOL . PHP_EOL;

		foreach ($files as $file) {
			$bundle .= '/* ' . $file . ' */' . PHP_EOL;
			$bundle .= file_get_contents($file);
			$bundle .= PHP_EOL;
		}

		$bundle .= '})();' . PHP_EOL;

		file_put_contents($bundleFilename, $bundle);

		return $bundleFilename;
	}

	private static function buildBundles(string $layout): array
	{
		$components = static::getComponents($layout);
		echo 'Components found: ' . ($components ? implode(', ', $components) : 'none') . PHP_EOL;

		$cssBundlefilename = static::buildCssBundle($layout, $components);
		if ($cssBundlefilename !== null) {
			echo 'CSS bundle: ' . $cssBundlefilename . ' (' . filesize($cssBundlefilename) . ' bytes)' . PHP_EOL;
		}

		$jsBundlefilename = static::buildJsBundle($layout, $components);
		if ($jsBundlefilename !== null) {
			echo 'JS bundle: ' . $jsBundlefilename . ' (' . filesize($jsBundlefilename) . ' bytes)' . PHP_EOL;
		}

		return array_filter(array($cssBundlefilename, $jsBundlefilename), fn(?string $file) => $file !== null);
	}

	private static function calculateHashes(array $bundleFilenames): void
	{
		$content = '<?php' . PHP_EOL . PHP_EOL;
		$content .= '// Этот файл сгенерирован автоматически. Не изменять вручную.' . PHP_EOL . PHP_EOL;

		$content .= 'global $hashes;' . PHP_EOL;
		$content .= '$hashes = array(' . PHP_EOL;
		foreach ($bundleFilenames as $bundleFilename) {
			$hash = md5_file($bundleFilename);
			echo $bundleFilename . ' => ' . $hash . PHP_EOL;
			$content .= '  \'' . $bundleFilename . '\' => \'' . $hash . '\',' . PHP_EOL;
		}
		$content .= ');' . PHP_EOL;

		file_put_contents(self::HASHES_FILENAME, $content);
	}

	public static function run(): void
	{
		$layouts = static::getLayouts();

		echo 'Layouts found:' . PHP_EOL;
		foreach ($layouts as $layout) {
			echo '- ' . $layout . PHP_EOL;
		}
		echo PHP_EOL;

		if (count($layouts) > 0) {
			static::createBundleDirectory();
		}

		$bundleFilenames = array();

		foreach ($layouts as $layout) {
			echo 'Building bundles for layout: ' . $layout . PHP_EOL;
			array_push($bundleFilenames, ...static::buildBundles($layout));
			echo PHP_EOL;
		}

		echo 'Calculating hashes:' . PHP_EOL;
		static::calculateHashes($bundleFilenames);
		echo PHP_EOL;

		echo 'Done' . PHP_EOL;
	}
}
