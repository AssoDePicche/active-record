<?php

declare(strict_types=1);

namespace ActiveRecord;

use ActiveRecord\Statement\Statement;
use IteratorAggregate;
use Stringable;

interface Record extends Stringable, IteratorAggregate
{
    public function __get(string $attribute): mixed;

    public function __set(string $attribute, mixed $value): void;

    public function execute(Statement $statement): mixed;
}
