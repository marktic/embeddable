<?php

declare(strict_types=1);

namespace Marktic\Embeddable\Bundle\Library\View;

class ViewUtility
{
    public static function registerViewPaths($view, string $module = null): void
    {
        $modules = [
            $module,
            'base',
        ];
        foreach ($modules as $mod) {
            $path = realpath(__DIR__ . '/../../Resources/views/' . $mod);
            if ($path === false) {
                continue;
            }
            $view->addPath($path);
            $view->addPath($path, 'MarkticEmbeddable');
        }
    }
}
