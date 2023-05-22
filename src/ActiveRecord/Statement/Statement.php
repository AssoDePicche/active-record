<?php

declare(strict_types=1);

namespace ActiveRecord\Statement;

use ActiveRecord\Record;

interface Statement
{
    public function execute(Record $activeRecord): mixed;
}
