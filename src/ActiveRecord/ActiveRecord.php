<?php

declare(strict_types=1);

namespace ActiveRecord;

abstract class ActiveRecord implements \Stringable, \IteratorAggregate
{
  protected array $attributes = [];

  protected readonly string $table;

  public function __construct()
  {
    $reflection = new \ReflectionClass($this);

    $className = $reflection->getShortName();

    $this->table = strtolower($className);
  }

  public function __set(string $attribute, mixed $value): void
  {
    $this->attributes[$attribute] = $value;
  }

  public function __get(string $attribute): mixed
  {
    return $this->$attribute;
  }

  public function __toString(): string
  {
    return $this->table;
  }

  public function getIterator(): \ArrayIterator
  {
    return new \ArrayIterator($this->attributes);
  }

  public function execute(\ActiveRecord\Statement\Statement $statement): void
  {
    $statement->execute($this);
  }
}
