<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Widgets;

use Nip\Collections\Typed\ClassCollection;

abstract class WidgetsCollection extends ClassCollection
{
    protected $validClass = AbstractWidget::class;

    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    /**
     * @return static
     */
    public static function all(): static
    {
        $items = [];
        foreach (static::widgetClasses() as $name => $class) {
            $items[$name] = new $class();
        }

        return new static($items);
    }

    /**
     * @return array<string, class-string<AbstractWidget>>
     */
    abstract protected static function widgetClasses(): array;
}
