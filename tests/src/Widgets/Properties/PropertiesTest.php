<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Tests\Widgets\Properties;

use Marktic\Embeddable\Tests\AbstractTest;
use Marktic\Embeddable\WidgetProperties\CheckboxProperty;
use Marktic\Embeddable\WidgetProperties\NumberProperty;
use Marktic\Embeddable\WidgetProperties\SelectProperty;
use Marktic\Embeddable\WidgetProperties\TextProperty;

class PropertiesTest extends AbstractTest
{
    public function testTextPropertyRendersInput(): void
    {
        $property = new TextProperty('title', 'Title', 'My Default');
        $html = $property->renderInput();

        self::assertStringContainsString('type="text"', $html);
        self::assertStringContainsString('name="title"', $html);
        self::assertStringContainsString('value="My Default"', $html);
        self::assertStringContainsString('Title', $html);
    }

    public function testTextPropertyGetters(): void
    {
        $property = new TextProperty('my_field', 'My Field', 'default');
        self::assertSame('my_field', $property->getName());
        self::assertSame('My Field', $property->getLabel());
        self::assertSame('default', $property->getDefaultValue());
    }

    public function testNumberPropertyRendersInput(): void
    {
        $property = new NumberProperty('count', 'Count', 10, 1, 100);
        $html = $property->renderInput();

        self::assertStringContainsString('type="number"', $html);
        self::assertStringContainsString('name="count"', $html);
        self::assertStringContainsString('value="10"', $html);
        self::assertStringContainsString('min="1"', $html);
        self::assertStringContainsString('max="100"', $html);
    }

    public function testNumberPropertyWithoutMinMax(): void
    {
        $property = new NumberProperty('count', 'Count');
        $html = $property->renderInput();

        self::assertStringNotContainsString('min=', $html);
        self::assertStringNotContainsString('max=', $html);
    }

    public function testSelectPropertyRendersOptions(): void
    {
        $property = new SelectProperty(
            'color',
            'Color',
            ['red' => 'Red', 'blue' => 'Blue', 'green' => 'Green'],
            'blue'
        );
        $html = $property->renderInput();

        self::assertStringContainsString('<select', $html);
        self::assertStringContainsString('name="color"', $html);
        self::assertStringContainsString('value="red"', $html);
        self::assertStringContainsString('value="blue"', $html);
        self::assertStringContainsString('selected="selected"', $html);
        // blue should be selected, not red
        self::assertStringContainsString('value="blue" selected="selected"', $html);
    }

    public function testCheckboxPropertyChecked(): void
    {
        $property = new CheckboxProperty('show_footer', 'Show Footer', true);
        $html = $property->renderInput();

        self::assertStringContainsString('type="checkbox"', $html);
        self::assertStringContainsString('name="show_footer"', $html);
        self::assertStringContainsString('checked="checked"', $html);
        self::assertStringContainsString('Show Footer', $html);
    }

    public function testCheckboxPropertyUnchecked(): void
    {
        $property = new CheckboxProperty('show_footer', 'Show Footer', false);
        $html = $property->renderInput();

        self::assertStringNotContainsString('checked="checked"', $html);
    }

    public function testCheckboxPropertyDefaultUnchecked(): void
    {
        $property = new CheckboxProperty('show_footer', 'Show Footer');
        $html = $property->renderInput();

        self::assertStringNotContainsString('checked="checked"', $html);
    }
}
