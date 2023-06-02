<?php

declare(strict_types=1);

namespace Shared\Adapter\Contract;

interface DataAccessObject
{
    public function get(int $id): ?Record;

    public function list(): Collection;

    public function save(Record $record): bool;

    public function update(Record $record): bool;

    public function delete(Record $record): bool;
}
