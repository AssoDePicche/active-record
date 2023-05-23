<?php

declare(strict_types=1);

namespace ActiveRecord\Statement;

use ActiveRecord\Record;
use ActiveRecord\Trait\RecordParser;

final class Read implements Statement
{
    use RecordParser;

    public function execute(Record $activeRecord): mixed
    {
        $attributes = $this->getAttributes($activeRecord);

        $query = 'SELECT (' . $attributes . ') FROM ' . $activeRecord . ' WHERE :id = :id';

        return [
            'query' => $query,
            'params' => $this->getParameters($activeRecord)
        ];
    }
}
