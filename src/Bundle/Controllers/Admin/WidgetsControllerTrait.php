<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Bundle\Controllers\Admin;

use Marktic\Embeddable\Widgets\AbstractWidgets;
use Nip\Controllers\Response\ResponsePayload;

/**
 * @method ResponsePayload payload()
 */
trait WidgetsControllerTrait
{
    use AbstractControllerTrait;

    /**
     * Returns the widgets class to use for this controller.
     * Override in your controller to return a concrete AbstractWidgets subclass.
     */
    abstract protected function getWidgetsClass(): string;

    public function index(): void
    {
        /** @var class-string<AbstractWidgets> $widgetsClass */
        $widgetsClass = $this->getWidgetsClass();
        $widgets = $widgetsClass::all();

        $this->payload()->set('widgets', $widgets);
        $this->payload()->setView('index');
    }
}
