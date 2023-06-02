<?php

declare(strict_types=1);

namespace Shared\Adapter\Contract;

interface Record extends \JsonSerializable, \Stringable
{
    public function equals(Record $record): bool;
}
