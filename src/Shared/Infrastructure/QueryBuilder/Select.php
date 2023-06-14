<?php

declare(strict_types=1);

namespace Shared\Infrastructure\QueryBuilder;

use Shared\Adapter\Contract\QueryBuilder\SelectStatement;

final class Select implements SelectStatement
{
    private string $query = '';

    public function __toString(): string
    {
        return $this->query;
    }

    public function select(array $columns = []): self
    {
        $this->query = 'SELECT ';

        if (empty($columns)) {
            $this->query .= '* ';

            return $this;
        }

        $this->addColumns($columns);

        return $this;
    }

    public function from(string $table): self
    {
        $this->query .= ' FROM ' . $table . ' ';

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

    public function and(): self
    {
        $this->query .= ' AND ';

        return $this;
    }

    public function or(): self
    {
        $this->query .= ' OR ';

        return $this;
    }

    public function groupBy(array $columns): self
    {
        $this->query .= ' GROUP BY ';

        $this->addColumns($columns);

        return $this;
    }

    public function orderBy(array $columns): self
    {
        $this->query .= ' ORDER BY ';

        $this->addColumns($columns);

        return $this;
    }

    public function limit(int $limit, int $offset = 0): self
    {
        $this->query .= ' LIMIT ' . $limit . ', ' . $offset;

        return $this;
    }

    private function addColumns(array $columns): void
    {
        foreach ($columns as $column) {
            $this->query .= $column . ', ';
        }

        $this->query = substr_replace(trim($this->query), '', -1);
    }
}
