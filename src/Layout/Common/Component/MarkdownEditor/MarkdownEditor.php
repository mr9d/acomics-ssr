<?php

namespace Acomics\Ssr\Layout\Common\Component\MarkdownEditor;

use Acomics\Ssr\Layout\AbstractComponent;

class MarkdownEditor extends AbstractComponent
{
    private static bool $isDepsInitialized = false;

    private string $name;
    private string $value;

    public function __construct(string $name, string $value = '')
    {
        $this->name = $name;
        $this->value = $value;
    }

    public static function head(): void
    {
        // See https://github.com/mr9d/acomics-markdown-editor/tree/main/versions
        echo <<<HTML
            <script defer src="https://cdn.jsdelivr.net/gh/mr9d/acomics-markdown-editor@master/versions/2.5.0/bundle.js" integrity="sha384-4bmg2npnQ+ya9D5rT0N1w1kPkDq6QyTLjauE8+/CftTYy68QGbsDQv/gYOlUJ02F" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mr9d/acomics-markdown-editor@master/versions/2.5.0/bundle.css" integrity="sha384-UREhWNpcYfb3G3AwMfYO0QgEhH/hU8rzokBuw0p6tgh23C3YJ751qfK2U8nNoQY9" crossorigin="anonymous">
        HTML;
        self::$isDepsInitialized = true;
    }

    public function render(): void
    {
        if (self::$isDepsInitialized === false)
        {
            echo '<span>Editor deps not initialized</span>';
            return;
        }

        echo '<textarea name="' . $this->name . '" class="acomicsMarkdownEditor">';
        echo htmlspecialchars($this->value, encoding: 'UTF-8');
        echo '</textarea>';
    }
}
