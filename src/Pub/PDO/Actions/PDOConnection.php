<?php

declare(strict_types=1);

namespace App\Pub\PDO\Actions;

use FFPerera\Cubo\Action;
use FFPerera\Cubo\Controller;

class PDOConnection extends Action
{
    public function __construct() {}

    public function run(Controller $controller): void
    {
        // Implement the logic for the Home action here

        // Example: Create a PDO connection
        try {
            [$dsn, $username, $password] = $this->getDatabaseCredentials();
        } catch (\Exception $e) {
            $controller->logger()->error('Database wrong DSN: ' . $e->getMessage());
            throw new \Exception('Database connection failed: ' . $e->getMessage());
        }


        try {
            $pdo = new \PDO($dsn, $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            // we can use different PDO instances for different sections
            // for example:  PDOApp, PDOAdm, etc.
            // in this case we can use the same instance for all sections
            $controller->set('PDO', $pdo);
        } catch (\PDOException $e) {
            $controller->logger()->error('Database connection failed: ' . $e->getMessage());
            throw new \Exception('Database connection failed: ' . $e->getMessage());
        }
    }

    /**
     * Get the database credentials from the environment variables.
     *
     * @return array<int,string> An array containing the DSN, username, and password.
     */
    private function getDatabaseCredentials(): array
    {
        $fullDSN = $_ENV['DATABASE_URI'] ?? '';

        if (empty($fullDSN)) {
            throw new \Exception('Database connection failed: DATABASE_URI is not set');
        }

        $parts = parse_url($fullDSN);
        if ($parts === false) {
            throw new \Exception('Database connection failed: Invalid DATABASE_URI format');
        }

        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=utf8',
            $parts['host'] ?? '',
            ltrim($parts['path'] ?? '', '/')
        );

        $username = $parts['user'] ?? '';
        $password = $parts['pass'] ?? '';

        if (empty($username) || empty($password)) {
            throw new \Exception('Database connection failed: Invalid DATABASE_URI format');
        }

        return [$dsn, $username, $password];
    }
}
