<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Bundle\Modules\Admin\Controllers;

use Marktic\Embeddable\Bundle\Library\View\ViewUtility;
use Nip\Controllers\Response\ResponsePayload;
use Nip\View\View;

/**
 * @method ResponsePayload payload()
 */
trait AbstractControllerTrait
{
    public function registerViewPaths(View $view): void
    {
        parent::registerViewPaths($view);

        ViewUtility::registerViewPaths($view, 'admin');
    }
}
