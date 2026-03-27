<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Widgets\Properties;

class SelectProperty extends AbstractProperty
{
    /**
     * @param array<string|int, string> $options
     */
    public function __construct(
        string $name,
        string $label,
        protected array $options = [],
        mixed $defaultValue = null,
    ) {
        parent::__construct($name, $label, $defaultValue);
    }

    /**
     * @return array<string|int, string>
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    public function renderInput(): string
    {
        $name = htmlspecialchars($this->name, ENT_QUOTES);

        $html = '<div class="mb-3">'
            . '<label class="form-label">' . htmlspecialchars($this->label) . '</label>'
            . '<select class="form-select" name="' . $name . '">';

        foreach ($this->options as $value => $optionLabel) {
            $selected = $this->defaultValue === $value ? ' selected="selected"' : '';
            $html .= '<option value="' . htmlspecialchars((string) $value, ENT_QUOTES) . '"' . $selected . '>'
                . htmlspecialchars((string) $optionLabel)
                . '</option>';
        }

        $html .= '</select></div>';

        return $html;
    }
}
