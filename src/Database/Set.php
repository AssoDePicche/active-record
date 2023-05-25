<?php

declare(strict_types=1);

namespace Database;

final class Set implements Collection
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function add(mixed ...$item): void
    {
        array_push($this->data, ...$item);
    }

    public function clear(): void
    {
        $this->data = [];
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function isEmpty(): bool
    {
        return ($this->count() === 0);
    }

    public function sort(): void
    {
        sort($this->data);
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->data);
    }

    public function jsonSerialize(): mixed
    {
        return $this->data;
    }
}
