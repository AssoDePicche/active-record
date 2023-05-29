<?php

declare(strict_types=1);

namespace Database;

interface Database
{
    public function __construct(string $dsn, ?string $username = null, ?string $password = null);
    public function prepare(string $query): self;

    public function execute(?array $params = null): bool;

    public function fetch(?string $class = null): object|false;

    public function fetchAll(?string $class = null): Collection;

    public function rowCount(): int;

    public function inTransaction(): bool;

    public function beginTransaction(): self;

    public function commit(): bool;

    public function rollBack(): bool;

    public static function createFromEnv(): self;

    public static function getInstance(): self;
}
