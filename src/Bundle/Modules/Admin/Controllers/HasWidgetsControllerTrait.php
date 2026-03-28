<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Bundle\Modules\Admin\Controllers;

use Marktic\Embeddable\Widgets\WidgetsCollection;
use Nip\Controllers\Response\ResponsePayload;

/**
 * @method ResponsePayload payload()
 */
trait HasWidgetsControllerTrait
{
    use AbstractControllerTrait;

    /**
     * Returns the widgets collection class to use for this controller.
     * Override in your controller to return a concrete WidgetsCollection subclass.
     */
    abstract protected function getWidgetsClass(): string;

    public function populateWidgets($subject = null): void
    {
        /** @var class-string<WidgetsCollection> $widgetsClass */
        $widgetsClass = $this->getWidgetsClass();
        if ($subject) {
            $widgets = $widgetsClass::for($subject);
        } else {
            $widgets = $widgetsClass::all();
        }

        $this->payload()->with(['widgets' => $widgets]);
    }
}
