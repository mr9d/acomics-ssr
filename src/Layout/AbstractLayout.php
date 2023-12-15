<?php
namespace Acomics\Ssr\Layout;

abstract class AbstractLayout implements LayoutInt
{
    protected ?string $title = null;
    protected ?string $seoDescription = null;
    protected ?string $seoKeywords = null;

    public function title(string $title)
    {
        $this->title = $title;
    }

	public function isReady(): bool
	{
		return $this->title !== null;
	}

    public function seo(string $description, string $keywords): static
    {
        $this->seoDescription = $description;
        $this->seoKeywords = $keywords;
        return $this;
    }

	protected function openGraph(): void {}

    protected function head(): void
    {
        echo '<meta charset="utf-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
        echo '<title>' . $this->title . '</title>';

        if ($this->seoDescription !== null) {
            echo '<meta name="description" content="' . $this->seoDescription . '" />';
        }
        if ($this->seoKeywords !== null) {
            echo '<meta name="keywords" content="' . $this->seoKeywords . '" />';
        }

		$this->openGraph();
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
