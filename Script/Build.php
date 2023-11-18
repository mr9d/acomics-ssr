<?php

namespace Acomics\Ssr\Script;

class Build
{
    private static string $LAYOUTS_DIR = 'Layout';
    private static string $COMPONENTS_DIR = 'Component';
    private static string $BUNDLE_DIR = 'static/bundle';

    private static function createBundleDirectory(): void
    {
        if (!file_exists(self::$BUNDLE_DIR)) {
            mkdir(static::$BUNDLE_DIR, 0777, true);
        }
    }

    private static function getLayouts(): array
    {
        $files = scandir(static::$LAYOUTS_DIR);

        if ($files === false) {
            return [];
        }

        return array_filter(
            $files,
            fn(string $file) => is_dir(static::$LAYOUTS_DIR . '/' . $file) && $file !== '.' && $file !== '..'
        );
    }

    private static function getComponents(string $layout): array
    {
        $files = scandir(static::$LAYOUTS_DIR . '/' . $layout . '/' . static::$COMPONENTS_DIR . '/');

        if ($files === false) {
            return [];
        }

        return array_filter(
            $files,
            fn(string $file) => is_dir(static::$LAYOUTS_DIR . '/' . $layout . '/' . static::$COMPONENTS_DIR . '/' . $file) && $file !== '.' && $file !== '..'
        );
    }

    private static function getComponentsFiles(string $layout, array $components, string $type): array
    {
        $files = array_map(
            fn(string $component) => static::$LAYOUTS_DIR . '/' . $layout . '/' . static::$COMPONENTS_DIR . '/' . $component . '/' . $component . '.' . $type,
            $components
        );

        array_push($files, static::$LAYOUTS_DIR . '/' . $layout . '/' . $layout . 'Layout.' . $type);

        return array_filter($files, fn(string $file) => file_exists($file));
    }

    private static function makeBundlefilename(string $layout, string $type): string
    {
        return static::$BUNDLE_DIR . '/' . strtolower($layout) . '.' . $type;
    }

    private static function buildCssBundle(string $layout, array $components): string
    {
        $files = static::getComponentsFiles($layout, $components, 'css');

        $bundleFilename = static::makeBundlefilename($layout, 'css');

        $bundle = '';
        foreach($files as $file) {
            $bundle .= '/* ' . $file . ' */'. PHP_EOL;
            $bundle .= file_get_contents($file);
            $bundle .= PHP_EOL;
        }
        file_put_contents($bundleFilename, $bundle);

        return $bundleFilename;
    }

    private static function buildJsBundle(string $layout, array $components): string
    {
        $files = static::getComponentsFiles($layout, $components, 'js');

        $bundleFilename = static::makeBundlefilename($layout, 'js');

        $bundle = '\'use strict\';' . PHP_EOL;
        $bundle .= '(() => {' . PHP_EOL . PHP_EOL;

        foreach($files as $file) {
            $bundle .= '/* ' . $file . ' */'. PHP_EOL;
            $bundle .= file_get_contents($file);
            $bundle .= PHP_EOL;
        }

        $bundle .= '})();' . PHP_EOL;

        file_put_contents($bundleFilename, $bundle);

        return $bundleFilename;
    }

    private static function buildBundles(string $layout): void
    {
        $components = static::getComponents($layout);
        echo 'Components found: ' . implode(', ', $components) . PHP_EOL;

        $cssBundlefilename = static::buildCssBundle($layout, $components);
        echo 'CSS bundle: ' . $cssBundlefilename . ' (' . filesize($cssBundlefilename) . ' bytes)' . PHP_EOL;

        $jsBundlefilename = static::buildJsBundle($layout, $components);
        echo 'JS bundle: ' . $jsBundlefilename . ' (' . filesize($jsBundlefilename) . ' bytes)' . PHP_EOL;
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

        foreach ($layouts as $layout) {
            echo 'Building bundles for layout: ' . $layout . PHP_EOL;
            static::buildBundles($layout);
            echo PHP_EOL;
        }

        echo 'Done' . PHP_EOL;
    }
}
