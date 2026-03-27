<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Tests\Fixtures\Widgets;

use Marktic\Embeddable\Widgets\AbstractWidget;
use Marktic\Embeddable\Widgets\Properties\CheckboxProperty;
use Marktic\Embeddable\Widgets\Properties\SelectProperty;
use Marktic\Embeddable\Widgets\Properties\TextProperty;

class SampleWidget extends AbstractWidget
{
    public function getName(): string
    {
        return 'sample-widget';
    }

    public function getLabel(): string
    {
        return 'Sample Widget';
    }

    public function getProperties(): array
    {
        return [
            new TextProperty('title', 'Title', 'Default Title'),
            new SelectProperty('color', 'Color', ['red' => 'Red', 'blue' => 'Blue'], 'blue'),
            new CheckboxProperty('show_footer', 'Show Footer', true),
        ];
    }

    protected function getBaseUrl(): string
    {
        return 'https://example.com/widgets/sample';
    }
}
