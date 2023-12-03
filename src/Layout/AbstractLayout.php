<?php
namespace Acomics\Ssr\Layout;

abstract class AbstractLayout implements LayoutInt
{
    protected ?string $title = null;
    protected ?string $seoKeywords = null;
    protected ?string $seoDescription = null;

    public function title(string $title)
    {
        $this->title = $title;
    }

	public function isReady(): bool
	{
		return $this->title !== null;
	}

    public function seo(string $keywords, string $description): static
    {
        $this->seoKeywords = $keywords;
        $this->seoDescription = $description;
        return $this;
    }

    protected function head(): void
    {
        echo '<meta charset="utf-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
        echo '<title>' . $this->title . '</title>';

        if ($this->seoKeywords !== null) {
            echo '<meta name="keywords" content="' . $this->seoKeywords . '" />';
        }
        if ($this->seoDescription !== null) {
            echo '<meta name="description" content="' . $this->seoDescription . '" />';
        }
    }

    public function top(): void
    {
        echo '<!DOCTYPE html><html><head>';
        echo $this->head();
        echo '</head><body>';
    }

    public function bottom(): void
    {
        echo '</body></html>';
    }
}
