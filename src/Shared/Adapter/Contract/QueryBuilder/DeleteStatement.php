<?php

declare(strict_types=1);

namespace Shared\Adapter\Contract\QueryBuilder;

interface DeleteStatement extends \Stringable
{
    public function from(string $table): self;

    public function where(string $field, mixed $value, string $operator): self;
}
