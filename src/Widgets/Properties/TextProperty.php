<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Widgets\Properties;

class TextProperty extends AbstractProperty
{
    public function renderInput(): string
    {
        $name = htmlspecialchars($this->name, ENT_QUOTES);
        $value = htmlspecialchars((string) ($this->defaultValue ?? ''), ENT_QUOTES);

        return '<div class="mb-3">'
            . '<label class="form-label">' . htmlspecialchars($this->label) . '</label>'
            . '<input type="text" class="form-control" name="' . $name . '" value="' . $value . '">'
            . '</div>';
    }
}
