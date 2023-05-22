<?php

declare(strict_types=1);

namespace Database;

use PDO;
use PDOException;
use PDOStatement;

final readonly class Connection
{
    private PDO $connection;

    private PDOStatement $statement;

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
        try {
            return $this->statement->execute($params);
        } catch (PDOException $exception) {
            echo 'Error: ' . $exception->getMessage() . PHP_EOL;

            return false;
        }
    }

    public function fetch(string $class = null): object|false
    {
        return $this->statement->fetchObject($class);
    }

    public function fetchAll(string $class = null): array
    {
        $data = [];

        while ($row = $this->fetch($class)) {
            $data[] = $row;
        }

        return $data;
    }

    public function rowCount(): int
    {
        return $this->statement->rowCount();
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

        return new self($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    }
}
