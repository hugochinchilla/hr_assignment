<?php

declare(strict_types = 1);

namespace Example\Tests\Helpers;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception\ConnectionException;

class WaitForMariadb
{
    public function __construct(private Connection $conn)
    {
    }

    public function __invoke(): void
    {
        echo "\n\nWaiting for database to be up and running...\n\n\n";

        for ($i = 0; $i < 150; ++$i) {
            try {
                $this->conn->connect();

                return;
            } catch (ConnectionException $e) {
                usleep($i * 1000);
            }
        }

        throw new \Exception('Could not connect to database');
    }
}
