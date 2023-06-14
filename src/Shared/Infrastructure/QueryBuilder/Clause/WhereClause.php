<?php

declare(strict_types=1);

namespace Shared\Infrastructure\QueryBuilder\Clause;

trait WhereClause
{
    public function where(string $field, mixed $value, string $operator): self
    {
        if (is_string($value)) {
            $value = "'{$value}'";
        }

        $this->query .= 'WHERE ' . $field . ' ' . $operator . ' ' . $value . ' ';

        return $this;
    }

    public function and(): self
    {
        $this->query .= 'AND ';

        return $this;
    }

    public function or(): self
    {
        $this->query .= 'OR ';

        return $this;
    }
}
