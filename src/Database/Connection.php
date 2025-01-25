<?php

namespace Tiagolopes\AbFilmes\Database;

use PDO;

class Connection
{
    public static function get(): PDO
    {
        $config = [
            'driver' => $_ENV['DB_DRIVER'],
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'dbname' => $_ENV['DB_DATABASE'],
        ];

        $driver = $config['driver'];
        unset($config['driver']);

        $queryString = $driver . ':' . http_build_query($config, '', ';');

        return new PDO($queryString, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    }
}
