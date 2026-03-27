<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Widgets;

abstract class AbstractWidgets
{
    /**
     * @return AbstractWidget[]
     */
    public static function all(): array
    {
        $widgets = [];
        foreach (static::widgetClasses() as $name => $class) {
            $widgets[$name] = new $class();
        }

        return $widgets;
    }

    /**
     * @return array<string, class-string<AbstractWidget>>
     */
    abstract protected static function widgetClasses(): array;
}
