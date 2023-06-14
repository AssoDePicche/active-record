<?php

declare(strict_types=1);

namespace Shared\Adapter\Contract\QueryBuilder;

interface SelectStatement extends \Stringable
{
    public function select(array $columns = []): self;

    public function from(string $table): self;

    public function where(string $field, mixed $value, string $operator): self;

    public function and(): self;

    public function or(): self;

    public function groupBy(array $columns): self;

    public function orderBy(array $columns): self;

    public function limit(int $limit, int $offset = 0): self;
}
