<?php

declare(strict_types=1);

namespace Marktic\Embeddable\WidgetProperties;

class CheckboxProperty extends AbstractProperty
{
    public function renderInput(): string
    {
        $name = htmlspecialchars($this->name, ENT_QUOTES);
        $checked = $this->defaultValue ? ' checked="checked"' : '';

        return '<div class="mb-3 form-check">'
            . '<input type="checkbox" class="form-check-input" id="prop-' . $name . '" name="' . $name . '" value="1"' . $checked . '>'
            . '<label class="form-check-label" for="prop-' . $name . '">' . htmlspecialchars($this->label) . '</label>'
            . '</div>';
    }
}
