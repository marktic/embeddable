<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Bundle\Library\View;

class ViewUtility
{
    public const NAMESPACE = 'MarkticEmbeddable';
    public static function registerViewPaths($view, string $module = null): void
    {
        $moduleDir = ucfirst(strtolower($module ?? 'base'));
        $path = realpath(__DIR__ . '/../../Modules/' . $moduleDir . '/views');
        if ($path === false) {
            return;
        }
        $view->addPath($path);
        $view->addPath($path, self::NAMESPACE );
    }
}
