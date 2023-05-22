<?php

declare(strict_types=1);

namespace ActiveRecord\Trait;

use ActiveRecord\Record;

trait RecordParser
{
    public function getAttributes(Record $record, string $prefix = ''): string
    {
        $attributes = '';

        foreach ($record as $attribute => $value) {
            $attributes .= $prefix . $attribute . ', ';
        }

        return substr_replace(trim($attributes), '', -1);
    }

    public function getParameters(Record $record): array
    {
        $parameters = [];

        foreach ($record as $attribute => $value) {
            $parameters[':' . $attribute] = $value;
        }

        return $parameters;
    }

    public function getBindedAttributes(Record $record): string
    {
        $attributes = '';

        foreach ($record as $attribute => $value) {
            if ($attribute === 'id') {
                continue;
            }

            $attributes .= ':' . $attribute . ' = ' . ':' . $attribute . ', ';
        }

        return substr_replace(trim($attributes), '', -1);
    }
}
