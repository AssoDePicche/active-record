<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Driver;

use PDO;

final class PDOFactory
{
    public static function createFromEnv(): ?PDO
    {
        $dsn = sprintf(
            '%s:host=%s:%d;dbname=%s',
            $_ENV['DB_CONNECTION'],
            $_ENV['DB_HOST'],
            $_ENV['DB_PORT'],
            $_ENV['DB_DATABASE']
        );

        return new PDO(
            $dsn,
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD']
        );
    }
}
