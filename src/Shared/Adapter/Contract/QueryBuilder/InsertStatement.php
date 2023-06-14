<?php

declare(strict_types=1);

namespace Shared\Adapter\Contract\QueryBuilder;

interface InsertStatement extends \Stringable
{
    public function into(string $table): self;

    public function values(array $values): self;
}
