<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Widgets;

use Marktic\Embeddable\Widgets\Properties\AbstractProperty;

abstract class AbstractWidget
{
    abstract public function getName(): string;

    abstract public function getLabel(): string;

    /**
     * @return AbstractProperty[]
     */
    public function getProperties(): array
    {
        return [];
    }

    public function getUrl(array $params = []): string
    {
        $baseUrl = $this->getBaseUrl();
        if (empty($params)) {
            return $baseUrl;
        }
        $separator = str_contains($baseUrl, '?') ? '&' : '?';

        return $baseUrl . $separator . http_build_query($params);
    }

    public function getHtml(array $params = []): string
    {
        $url = $this->getUrl($params);
        $styles = implode(';', $this->getStyles());
        $sandbox = 'allow-top-navigation allow-scripts allow-popups allow-forms allow-same-origin allow-modals';
        $onload = "(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+'px';}(this));";

        return $this->getScript()
            . '<iframe'
            . ' src="' . htmlspecialchars($url, ENT_QUOTES) . '"'
            . ' style="' . htmlspecialchars($styles, ENT_QUOTES) . '"'
            . ' sandbox="' . $sandbox . '"'
            . ' onload="' . htmlspecialchars($onload, ENT_QUOTES) . '"'
            . ' class="embeddable-widget"'
            . ' id="embeddable-' . htmlspecialchars($this->getName(), ENT_QUOTES) . '"'
            . '></iframe>';
    }

    protected function getScript(): string
    {
        return '';
    }

    protected function getStyles(): array
    {
        return [
            'width: 100%',
            'overflow-x: hidden',
            'border: 0',
        ];
    }

    abstract protected function getBaseUrl(): string;
}
