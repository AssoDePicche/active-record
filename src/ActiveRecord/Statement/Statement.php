<?php

declare(strict_types=1);

namespace ActiveRecord\Statement;

use ActiveRecord\ActiveRecord;

interface Statement
{
  public function execute(ActiveRecord $activeRecord): mixed;
}
