<?php

declare(strict_types=1);

namespace Database;

use PDO;
use PDOException;
use PDOStatement;

final class Connection implements Database
{
    private readonly PDO $connection;

    private ?PDOStatement $statement = null;

    private static ?self $instance = null;

    public function __construct(
        string $dsn,
        ?string $username = null,
        ?string $password = null
    ) {
        try {
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $exception) {
            echo 'Error: ' . $exception->getMessage() . PHP_EOL;
        }
    }

    public function prepare(string $query): self
    {
        $this->statement = $this->connection->prepare($query);

        return $this;
    }

    public function execute(array $params = null): bool
    {
        if (is_null($this->statement)) {
            return false;
        }

        try {
            return $this->statement->execute($params);
        } catch (PDOException $exception) {
            echo 'Error: ' . $exception->getMessage() . PHP_EOL;

            return false;
        }
    }

    public function fetch(?string $class = null): object|false
    {
        if (is_null($this->statement)) {
            return false;
        }

        return $this->statement->fetchObject($class);
    }

    public function fetchAll(?string $class = null): Collection
    {
        $data = new Set;

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

    public static function createFromEnv(): self
    {
        $dsn = sprintf(
            '%s:host=%s:%d;dbname=%s',
            $_ENV['DB_CONNECTION'],
            $_ENV['DB_HOST'],
            $_ENV['DB_PORT'],
            $_ENV['DB_DATABASE']
        );

        return new self(
            $dsn,
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD']
        );
    }

    public static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = self::createFromEnv();
        }

        return self::$instance;
    }
}
