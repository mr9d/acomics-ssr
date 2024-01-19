<?php

namespace Acomics\Ssr\Layout\Serial\Component\ContentTree;

use Acomics\Ssr\Dto\SerialChapterDto;
use Acomics\Ssr\Dto\SerialChapterStructDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Util\UrlUtil;

class ContentTree extends AbstractComponent
{
    private SerialChapterStructDto $rootStruct;

    private string $serialCode;

    public function __construct(SerialChapterStructDto $rootStruct, string $serialCode)
    {
        $this->rootStruct = $rootStruct;
        $this->serialCode = $serialCode;
    }

    public function render(): void
    {
        $this->renderStruct($this->rootStruct, SerialChapterDto::LAYOUT_LIST_WITH_IMAGE);
    }

    private function renderStruct(SerialChapterStructDto $struct, int $basicLayout): int
    {
        $this->renderHeader($struct);

        echo '<section class="serial-content-tree">';

        $basicLayout = $this->renderChapters($struct->chapters, $basicLayout);
        $basicLayout = $this->renderStructs($struct->childStructs, $basicLayout);

        echo '</section>';

        return $basicLayout;
    }

    public function renderHeader(SerialChapterStructDto $struct): void
    {
        switch($struct->headerLevel)
        {
            case SerialChapterStructDto::LEVEL_TOP: {
                echo '<h2>' . $struct->name . '</h2>';
                break;
            }
            case SerialChapterStructDto::LEVEL_SUBTITLE: {
                echo '<h3>' . $struct->name . '</h3>';
                break;
            }
            case SerialChapterStructDto::LEVEL_SUBTITLE_COLLAPSE: {
                echo '<h3>' . $struct->name . '</h3>';
                break;
            }
            case SerialChapterStructDto::LEVEL_ROOT:
            default:
                // Ничего не выводим
        }
    }

    /** @param ?SerialChapterDto[] $chapters */
    public function renderChapters(?array $chapters, int $basicLayout): int
    {
        if($chapters === null)
        {
            return $basicLayout;
        }

        for($i = 0; $i < count($chapters); $i++)
        {
            $chapter = $chapters[$i];
            $chapterLayout = $chapter->layout === SerialChapterDto::LAYOUT_INHERIT ? $basicLayout : $chapter->layout;

            // Если элемент первый, открываем расположение
            if($i === 0)
            {
                $this->renderLayoutPrefix($chapterLayout);
            }
            // Если у элемента новое расположение, закрываем старое, открываем новое
            else if($chapterLayout !== $basicLayout)
            {
                $this->renderLayoutPostfix($basicLayout);
                $this->renderLayoutPrefix($chapterLayout);
            }

            $this->renderChapter($chapter, $chapterLayout);
            $basicLayout = $chapterLayout;
        }

        $this->renderLayoutPostfix($basicLayout);

        return $basicLayout;
    }

    /** @param ?SerialChapterStructDto[] $structs */
    public function renderStructs(?array $structs, int $basicLayout): int
    {
        if($structs === null)
        {
            return $basicLayout;
        }

        foreach($structs as $struct)
        {
            $basicLayout = $this->renderStruct($struct, $basicLayout);
        }

        return $basicLayout;
    }

    private function renderLayoutPrefix(int $layout): void
    {
        switch($layout) {
            case SerialChapterDto::LAYOUT_LIST_WITH_IMAGE: {
                echo '<ul>';
                break;
            }
            case SerialChapterDto::LAYOUT_CENTER_OR_IMAGE: {
                echo '<p class="serial-chapters-centered">';
                break;
            }
            case SerialChapterDto::LAYOUT_INLINE_OR_IMAGE: {
                echo '<p class="serial-chapters-inline">';
                break;
            }
        }
    }

    private function renderLayoutPostfix(int $layout): void
    {
        switch($layout) {
            case SerialChapterDto::LAYOUT_LIST_WITH_IMAGE: {
                echo '</ul>';
                break;
            }
            case SerialChapterDto::LAYOUT_CENTER_OR_IMAGE: {
                echo '</p>';
                break;
            }
            case SerialChapterDto::LAYOUT_INLINE_OR_IMAGE: {
                echo '</p>';
                break;
            }
        }
    }

    private function renderChapter(SerialChapterDto $chapter, int $layout): void
    {
        switch($layout) {
            case SerialChapterDto::LAYOUT_LIST_WITH_IMAGE: {
                echo '<li>';
                if ($chapter->imageUrl !== null)
                {
                    echo '<img src="' . $chapter->imageUrl . '">';
                }
                echo '<a href="' . UrlUtil::makeSerialUrl($this->serialCode, $chapter->issueNumber) . '">' . $chapter->name . '</a>' . ($chapter->about ? ' - ' . $chapter->about : '');
                echo '</li>';
                break;
            }
            case SerialChapterDto::LAYOUT_CENTER_OR_IMAGE:
            case SerialChapterDto::LAYOUT_INLINE_OR_IMAGE: {
                echo '<a href="' . UrlUtil::makeSerialUrl($this->serialCode, $chapter->issueNumber) . '">';

                if ($chapter->imageUrl !== null)
                {
                    echo '<img src="' . $chapter->imageUrl . '">';
                }
                else
                {
                    echo $chapter->name;
                }

                echo '</a>';
                break;
            }
        }
    }
}
