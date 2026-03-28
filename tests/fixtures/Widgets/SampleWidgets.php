<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Tests\Fixtures\Widgets;

use Marktic\Embeddable\Widgets\WidgetsCollection;

class SampleWidgets extends WidgetsCollection
{
    protected static function widgetClasses(): array
    {
        return [
            'sample-widget' => SampleWidget::class,
        ];
    }
}
