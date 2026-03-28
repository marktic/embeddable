<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Widgets;

use Nip\Collections\Typed\ClassCollection;

abstract class WidgetsCollection extends ClassCollection
{
    protected $validClass = AbstractWidget::class;

    public static function for($subject): self
    {
        $items = [];
        foreach (static::widgetClasses() as $name => $class) {
            $items[$name] = new $class();
            $items[$name]->setSubject($subject);
        }

        return new static($items);
    }

    /**
     * @return array<string, class-string<AbstractWidget>>
     */
    abstract protected static function widgetClasses(): array;
}
