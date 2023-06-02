<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Driver;

use PDO;
use PDOStatement;
use Shared\Adapter\ArrayList;
use Shared\Adapter\Contract\DatabaseDriver;
use Shared\Adapter\Contract\Collection;

final class Driver implements DatabaseDriver
{
    private ?PDOStatement $statement;

    public function __construct(private ?PDO $connection)
    {
    }

    public function prepare(string $query): self
    {
        $this->statement = $this->connection->prepare($query);

        return $this;
    }

    public function execute(array $params = []): self
    {
        $this->statement->execute($params);

        return $this;
    }

    public function fetch(string $class): ?object
    {
        return $this->statement->fetchObject($class);
    }

    public function fetchAll(string $class): Collection
    {
        $data = new ArrayList;

        while ($row = $this->fetch($class)) {
            $data->add($row);
        }

        return $data;
    }

    public function rowCount(): int
    {
        if (is_null($this->statement)) {
            return 0;
        }

        return $this->statement->rowCount();
    }

    public function inTransaction(): bool
    {
        return $this->connection->inTransaction();
    }

    public function beginTransaction(): bool
    {
        if ($this->inTransaction()) {
            return false;
        }

        return $this->connection->beginTransaction();
    }

    public function commit(): bool
    {
        if (!$this->inTransaction()) {
            return false;
        }

        return $this->connection->commit();
    }

    public function rollBack(): bool
    {
        if (!$this->inTransaction()) {
            return false;
        }

        return $this->connection->rollBack();
    }

    public function close(): void
    {
        $this->connection = null;
    }
}
