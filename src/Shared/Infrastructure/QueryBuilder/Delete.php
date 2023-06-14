<?php

declare(strict_types=1);

namespace Shared\Infrastructure\QueryBuilder;

use Shared\Adapter\Contract\QueryBuilder\DeleteStatement;
use Shared\Infrastructure\QueryBuilder\Clause\WhereClause;

final class Delete implements DeleteStatement
{
    use WhereClause;

    private string $query = '';

    public function __toString(): string
    {
        return $this->query;
    }

    public function from(string $table): self
    {
        $this->query = sprintf('DELETE FROM %s ', $table);

        return $this;
    }
}
