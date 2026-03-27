<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Tests\Widgets;

use Marktic\Embeddable\Tests\AbstractTest;
use Marktic\Embeddable\Tests\Fixtures\Widgets\SampleWidget;
use Marktic\Embeddable\Tests\Fixtures\Widgets\SampleWidgets;
use Marktic\Embeddable\Widgets\WidgetsCollection;

class AbstractWidgetTest extends AbstractTest
{
    protected SampleWidget $widget;

    protected function setUp(): void
    {
        parent::setUp();
        $this->widget = new SampleWidget();
    }

    public function testGetName(): void
    {
        self::assertSame('sample-widget', $this->widget->getName());
    }

    public function testGetLabel(): void
    {
        self::assertSame('Sample Widget', $this->widget->getLabel());
    }

    public function testGetUrlWithNoParams(): void
    {
        $url = $this->widget->getUrl();
        self::assertSame('https://example.com/widgets/sample', $url);
    }

    public function testGetUrlWithParams(): void
    {
        $url = $this->widget->getUrl(['color' => 'red', 'show_footer' => '1']);
        self::assertSame('https://example.com/widgets/sample?color=red&show_footer=1', $url);
    }

    public function testGetUrlWithExistingQueryString(): void
    {
        $widget = new class () extends SampleWidget {
            protected function getBaseUrl(): string
            {
                return 'https://example.com/widgets/sample?token=abc';
            }
        };

        $url = $widget->getUrl(['color' => 'red']);
        self::assertSame('https://example.com/widgets/sample?token=abc&color=red', $url);
    }

    public function testGetHtmlContainsIframe(): void
    {
        $html = $this->widget->getHtml();
        self::assertStringContainsString('<iframe', $html);
        self::assertStringContainsString('embeddable-widget', $html);
        self::assertStringContainsString('embeddable-sample-widget', $html);
    }

    public function testGetHtmlContainsUrl(): void
    {
        $html = $this->widget->getHtml();
        self::assertStringContainsString('https://example.com/widgets/sample', $html);
    }

    public function testGetHtmlWithParams(): void
    {
        $html = $this->widget->getHtml(['color' => 'red']);
        self::assertStringContainsString('color=red', $html);
    }

    public function testGetPropertiesReturnsArray(): void
    {
        $properties = $this->widget->getProperties();
        self::assertIsArray($properties);
        self::assertCount(3, $properties);
    }

    public function testWidgetsCollectionAll(): void
    {
        $widgets = SampleWidgets::all();
        self::assertInstanceOf(WidgetsCollection::class, $widgets);
        $widgetsArray = $widgets->toArray();
        self::assertArrayHasKey('sample-widget', $widgetsArray);
        self::assertInstanceOf(SampleWidget::class, $widgetsArray['sample-widget']);
    }
}
