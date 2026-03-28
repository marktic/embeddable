<?php

/**
 * Stub for Nip\Collections\AbstractCollection used when bytic/collections
 * is not installed (e.g. in CI without vendor directory).
 */

namespace Nip\Collections;

abstract class AbstractCollection implements \Countable, \ArrayAccess, \IteratorAggregate
{
    /** @var array */
    protected $items = [];

    public function __construct($items = [])
    {
        if (is_array($items)) {
            $this->items = $items;
        }
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        if ($offset === null) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }
}
