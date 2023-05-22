<?php

declare(strict_types=1);

namespace ActiveRecord;

use ActiveRecord\Statement\Statement;
use ArrayIterator;
use ReflectionClass;

abstract class ActiveRecord implements Record
{
    protected array $attributes = [];

    protected readonly string $table;

    public function __construct()
    {
        $reflection = new ReflectionClass($this);

        $className = $reflection->getShortName();

        $this->table = strtolower($className);
    }

    public function __get(string $attribute): mixed
    {
        return $this->attributes[$attribute] ?? null;
    }

    public function __set(string $attribute, mixed $value): void
    {
        $this->attributes[$attribute] = $value;
    }

    public function __toString(): string
    {
        return $this->table;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->attributes);
    }

    public function execute(Statement $statement): mixed
    {
        return $statement->execute($this);
    }
}
