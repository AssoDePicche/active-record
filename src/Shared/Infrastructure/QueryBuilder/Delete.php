<?php

declare(strict_types=1);

namespace Shared\Infrastructure\QueryBuilder;

use Shared\Adapter\Contract\QueryBuilder\DeleteStatement;

final class Delete implements DeleteStatement
{
    private string $query = '';

    public function __toString(): string
    {
        return $this->query;
    }

    public function from(string $table): self
    {
        $this->query = 'DELETE FROM ' . $table . ' ';

        return $this;
    }

    public function where(string $field, mixed $value, string $operator): self
    {
        if (is_string($value)) {
            $value = "'{$value}'";
        }

        $this->query .= 'WHERE ' . $field . ' ' . $operator . ' ' . $value . ' ';

        return $this;
    }
}
