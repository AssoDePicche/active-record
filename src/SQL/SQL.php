<?php

declare(strict_types=1);

namespace SQL;

final class SQL
{

  private readonly \PDO $pdo;

  private \PDOStatement $statement;

  public function __construct(
    string $dsn,
    string $username = 'root',
    string $password = '',
  ) {
    $options = [
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
    ];

    try {
      $this->pdo = new \PDO($dsn, $username, $password, $options);
    } catch (\PDOException $exception) {
      echo $exception->getMessage() . PHP_EOL;
    }
  }

  public function fetch(): mixed
  {
    try {
      $data = $this->statement->fetch();
    } catch (\PDOException $exception) {
      echo $exception->getMessage() . PHP_EOL;
    } finally {
      return $data;
    }
  }

  public function fetchAll(): array
  {
    try {
      $data = $this->statement->fetchAll();
    } catch (\PDOException $exception) {
      echo $exception->getMessage() . PHP_EOL;
    } finally {
      return $data;
    }
  }

  public function query(string $query, array $params = []): \PDOStatement
  {
    try {
      $this->statement = $this->pdo->prepare($query);

      $this->statement->execute($params);
    } catch (\PDOException $exception) {
      echo $exception->getMessage() . PHP_EOL;
    } finally {
      return $this->statement;
    }
  }

  public function rowCount(): int
  {
    return $this->statement->rowCount();
  }
}
