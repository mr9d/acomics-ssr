<?php
namespace Acomics\Ssr\Layout;

abstract class AbstractLayout implements LayoutInt
{
    private ?string $title = null;

    private ?SeoData $seo = null;
    private ?OpenGraphData $openGraph = null;

    public function title(string $title)
    {
        $this->title = $title;
    }

    public function seo(SeoData $seo): void
    {
        $this->seo = $seo;
    }

	public function openGraph(OpenGraphData $openGraph): void {
		$this->openGraph = $openGraph;
	}

	public function isReady(): bool
	{
		return $this->title !== null;
	}

    protected function head(): void
    {
        echo '<meta charset="utf-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
        echo '<title>' . $this->title . '</title>';

        if ($this->seo !== null) {
			echo '<meta name="description" content="' . $this->seo->description . '" />';
            echo '<meta name="keywords" content="' . join(', ', $this->seo->keywords) . '" />';
        }

		if ($this->openGraph !== null) {
			echo '<meta property="og:title" content="' . $this->openGraph->title . '" />';
			echo '<meta property="og:type" content="' . $this->openGraph->type . '" />';
			echo '<meta property="og:image" content="' . $this->openGraph->image . '" />';
			echo '<meta property="og:image:type" content="' . $this->openGraph->imageType . '" />';
			echo '<meta property="og:image:width" content="' . $this->openGraph->imageWidth . '" />';
			echo '<meta property="og:image:height" content="' . $this->openGraph->imageHeight . '" />';
			echo '<meta property="og:url" content="' . $this->openGraph->url . '" />';
			echo '<meta property="og:description" content="' . $this->openGraph->description . '" />';
		}

    }

    public function top(): void
    {
        echo '<!DOCTYPE html><html lang="ru"><head>';
        echo $this->head();
        echo '</head><body>';
    }

    public function bottom(): void
    {
        echo '</body></html>';
    }
}
