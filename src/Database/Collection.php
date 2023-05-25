<?php

declare(strict_types=1);

namespace Database;

interface Collection extends \Countable, \IteratorAggregate, \JsonSerializable
{
    public function add(mixed ...$item): void;

    public function clear(): void;

    public function isEmpty(): bool;

    public function sort(): void;
}
