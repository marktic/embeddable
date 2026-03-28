<?php


declare(strict_types=1);

namespace Marktic\Embeddable\Widgets\Behaviours;

trait HasSubject
{
    protected $subject;

    public static function for($subject): self
    {
        $items = [];
        foreach (static::widgetClasses() as $name => $class) {
            $items[$name] = new $class();
            $items[$name]->setSubject($subject);
        }

        return new static($items);
    }

    public function setSubject($subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }
}

