<?php

declare(strict_types=1);

namespace ActiveRecord\Statement;

use ActiveRecord\Record;
use ActiveRecord\Trait\RecordParser;

final class Create implements Statement
{
    use RecordParser;

    public function execute(Record $activeRecord): mixed
    {
        $attributes = $this->getAttributes($activeRecord);

        $binds = $this->getAttributes($activeRecord, ':');

        $query = 'INSERT INTO ' . $activeRecord . ' (' . $attributes . ') VALUES (' . $binds . ')';

        return [
            'query' => $query,
            'params' => $this->getParameters($activeRecord)
        ];
    }
}
