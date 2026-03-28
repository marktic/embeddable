<?php

declare(strict_types=1);

namespace Marktic\Embeddable\WidgetProperties;

class NumberProperty extends AbstractProperty
{
    public function __construct(
        string $name,
        string $label,
        mixed $defaultValue = null,
        protected ?int $min = null,
        protected ?int $max = null,
    ) {
        parent::__construct($name, $label, $defaultValue);
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function renderInput(): string
    {
        $name = htmlspecialchars($this->name, ENT_QUOTES);
        $value = htmlspecialchars((string) ($this->defaultValue ?? ''), ENT_QUOTES);
        $minAttr = $this->min !== null ? ' min="' . $this->min . '"' : '';
        $maxAttr = $this->max !== null ? ' max="' . $this->max . '"' : '';

        return '<div class="mb-3">'
            . '<label class="form-label">' . htmlspecialchars($this->label) . '</label>'
            . '<input type="number" class="form-control" name="' . $name . '" value="' . $value . '"'
            . $minAttr . $maxAttr . '>'
            . '</div>';
    }
}
