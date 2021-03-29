<?php

declare(strict_types = 1);

namespace Example\App\Infrastructure;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class DbalConnectionFactory
{
    public function test(): Connection
    {
        return $this->fromUri('mysql://root:example@mariadb/chessable_hr');
    }

    public function production(): Connection
    {
        return $this->fromUri('mysql://production:supersecret@mariadb/production_db');
    }

    private function fromUri(string $url): Connection
    {
        return DriverManager::getConnection(['url' => $url]);
    }
}
