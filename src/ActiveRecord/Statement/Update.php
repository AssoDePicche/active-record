<?php

declare(strict_types=1);

namespace ActiveRecord\Statement;

use ActiveRecord\Record;
use ActiveRecord\Trait\RecordParser;

final class Update implements Statement
{
    use RecordParser;

    public function execute(Record $activeRecord): mixed
    {
        $binds = $this->getBindedAttributes($activeRecord);

        $query = 'UPDATE ' . $activeRecord . ' SET ' . $binds . ' WHERE :id = :id';

        return [
            'query' => $query,
            'params' => $this->getParameters($activeRecord)
        ];
    }
}
