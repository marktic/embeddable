<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Widgets;

use ByTIC\Html\Tags\Iframe;
use Marktic\Embeddable\WidgetProperties\AbstractProperty;

abstract class AbstractWidget
{
    use Behaviours\HasSubject;

    public const SANDBOX_ALL = 'allow-top-navigation allow-scripts allow-popups allow-forms allow-same-origin allow-modals';

    public function getName(): string
    {
        if (constant('static::NAME')) {
            return constant('static::NAME');
        }
        return static::class;
    }

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
        $classes = implode(' ', $this->getClasses());

        $return = $this->getScript();
        $return .= Iframe
            ::src($this->getUrl($params))
            ->setAttribute('style', implode(';', $this->getStyles()))
            ->setAttribute('sandbox', $this->getSandbox())
            ->setAttribute('onload', $this->getOnload())
            ->addClass($classes)
            ->setAttribute('id', $this->getIframeId());
        return $return;
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

    protected function getClasses(): array
    {
        return [];
    }

    protected function getIframeId(): string
    {
        return 'embeddable-' . $this->getName();
    }

    protected function getSandbox(): string
    {
        return self::SANDBOX_ALL;
    }

    protected function getOnload(): string
    {
        return "(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+'px';}(this));";
    }

    abstract protected function getBaseUrl(): string;
}
