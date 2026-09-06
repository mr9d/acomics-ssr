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
        echo '<script defer src="https://cdn.jsdelivr.net/gh/mr9d/acomics-markdown-editor@master/versions/2.4.2/bundle.js" integrity="sha384-pvdMEzEKr0qhyXe1n1JrhoRUH80wxpZJTlcN6FudirtGVvRWVL5/0qpXeOhQIghn" crossorigin="anonymous"></script>';
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mr9d/acomics-markdown-editor@master/versions/2.4.2/bundle.css" integrity="sha384-IGnyjM9ka5zkADAPxZcW53zcaydMAJ8M1N260pSAGDjOIKeY/rp0/aJ4zWKJtlhv" crossorigin="anonymous">';

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
