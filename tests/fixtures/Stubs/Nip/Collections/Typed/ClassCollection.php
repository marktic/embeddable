<?php

/**
 * Stub for Nip\Collections\Typed\ClassCollection used when bytic/collections
 * is not installed (e.g. in CI without vendor directory).
 */

namespace Nip\Collections\Typed;

class ClassCollection extends \Nip\Collections\AbstractCollection
{
    /** @var string|null */
    protected $validClass = null;

    /** @var \Closure|null */
    protected $typeChecker = null;

    public function __construct($items = [])
    {
        $this->typeChecker = function ($element) {
            return $this->validClass === null || ($element instanceof $this->validClass);
        };
        parent::__construct($items);
    }

    public function validClass(string $validClass): void
    {
        $this->validClass = $validClass;
    }
}
