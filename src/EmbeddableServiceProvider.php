<?php

declare(strict_types=1);

namespace Marktic\Embeddable;

use ByTIC\PackageBase\BaseBootableServiceProvider;

class EmbeddableServiceProvider extends BaseBootableServiceProvider
{
    public const NAME = 'mkt_embeddable';

    protected function translationsPath(): string
    {
        return __DIR__ . '/Bundle/Resources/lang/';
    }
}
