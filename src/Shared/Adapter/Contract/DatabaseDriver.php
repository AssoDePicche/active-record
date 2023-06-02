<?php

declare(strict_types=1);

namespace Shared\Adapter\Contract;

interface DatabaseDriver
{
    public function prepare(string $query): DatabaseDriver;

    public function execute(array $params = []): DatabaseDriver;

    public function fetch(string $class): ?object;

    public function fetchAll(string $class): Collection;

    public function rowCount(): int;

    public function inTransaction(): bool;

    public function beginTransaction(): bool;

    public function commit(): bool;

    public function rollBack(): bool;

    public function close(): void;
}
