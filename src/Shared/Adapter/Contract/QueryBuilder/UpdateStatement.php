<?php

declare(strict_types=1);

namespace Shared\Adapter\Contract\QueryBuilder;

interface UpdateStatement extends \Stringable
{
    public function update(string $table);

    public function set(array $values);

    public function where(string $field, mixed $value, string $operator): self;
}
