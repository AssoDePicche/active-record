<?php

declare(strict_types=1);

namespace ActiveRecord\Statement;

use ActiveRecord\ActiveRecord;
use SQL\SQL;

final class Delete implements Statement
{
  public function execute(ActiveRecord $activeRecord): int
  {
    $query = 'DELETE FROM ' . $activeRecord . ' WHERE id = :id;';

    $sqlRepository = new SQL($_ENV['DSN']);

    return $sqlRepository
      ->query($query, [
        ':id' => $activeRecord->attributes['id']
      ])
      ->rowCount();
  }
}
