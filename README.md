# marktic/embeddable

Embeddable widgets library for SaaS applications. Provides a framework for defining, configuring, and embedding iframe-based widgets in external sites.

## Features

- Define widgets as PHP classes with typed configurable properties
- Auto-generate embed HTML (`<iframe>` + optional `<script>`)
- Admin bundle with a widget builder UI (tabbed interface, customize form, live preview, copy-to-clipboard embed code)
- Property types: `TextProperty`, `NumberProperty`, `SelectProperty`, `CheckboxProperty`

## Installation

```bash
composer require marktic/embeddable
```

## Usage

### Define a Widget

```php
use Marktic\Embeddable\Widgets\AbstractWidget;
use Marktic\Embeddable\WidgetProperties\TextProperty;
use Marktic\Embeddable\WidgetProperties\SelectProperty;

class MyWidget extends AbstractWidget
{
    public function getName(): string { return 'my-widget'; }
    public function getLabel(): string { return 'My Widget'; }

    public function getProperties(): array
    {
        return [
            new TextProperty('title', 'Title', 'Default Title'),
            new SelectProperty('theme', 'Theme', ['light' => 'Light', 'dark' => 'Dark'], 'light'),
        ];
    }

    protected function getBaseUrl(): string
    {
        return 'https://myapp.com/widgets/my-widget';
    }
}
```

### Define a Widget Collection

```php
use Marktic\Embeddable\Widgets\WidgetsCollection;

class MyWidgets extends WidgetsCollection
{
    protected static function widgetClasses(): array
    {
        return [
            'my-widget' => MyWidget::class,
        ];
    }
}
```

### Get Embed HTML

```php
$widget = new MyWidget();
echo $widget->getHtml();
// or with parameters:
echo $widget->getHtml(['theme' => 'dark', 'title' => 'Hello']);
```

### Admin Bundle Controller

```php
use Marktic\Embeddable\Bundle\Modules\Admin\Controllers\WidgetsControllerTrait;

class MyWidgetsController
{
    use WidgetsControllerTrait;

    protected function getWidgetsClass(): string
    {
        return MyWidgets::class;
    }
}
```