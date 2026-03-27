<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Widgets\Properties;

abstract class AbstractProperty
{
    public function __construct(
        protected string $name,
        protected string $label,
        protected mixed $defaultValue = null,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getDefaultValue(): mixed
    {
        return $this->defaultValue;
    }

    abstract public function renderInput(): string;
}
