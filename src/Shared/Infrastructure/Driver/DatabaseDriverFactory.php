<?php

declare(strict_types=1);

namespace Shared\Adapter\Infrastructure\Driver;

use Shared\Adapter\Contract\DatabaseDriver;

final class DatabaseDriverFactory
{
    private static ?DatabaseDriver $databaseDriver;

    public static function createFromEnv(): DatabaseDriver
    {
        $pdo = PDOFactory::createFromEnv();

        return new Driver($pdo);
    }

    public static function getCurrentInstance(): DatabaseDriver
    {
        if (null === self::$databaseDriver) {
            self::$databaseDriver = self::createFromEnv();
        }

        return self::$databaseDriver;
    }
}
