<?php

declare(strict_types=1);

namespace App\Pub\User\Repository;

use App\Pub\User\Model\User;



class UserRepositoryPDO implements IUserRepository
{
    private \PDO $pdo;

    public function __construct() {}

    /**
     * @param array <string,mixed> $options
     */
    public function init(array $options = []): void
    {
        if (!isset($options['PDO'])) {
            throw new \InvalidArgumentException('PDO instance is required');
        }
        if (!($options['PDO'] instanceof \PDO)) {
            throw new \InvalidArgumentException('Invalid PDO instance');
        }
        $this->pdo = $options['PDO'];
    }

    public function getUsers(array $options = []): array
    {
        // Example query to fetch posts
        $stmt = $this->pdo->query("SELECT * FROM user");

        if ($stmt) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, User::class);
        }

        return [];
    }

    public function getUserById(string $id): ?User
    {
        // Example query to fetch a single post by ID
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject(User::class) ?: null;
    }

    public function getUserByUsernameAndPassword(string $username, string $password): ?User
    {
        // Example query to fetch a single post by ID
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $username);
        $stmt->execute();
        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (is_array($userData) && count($userData) > 0) {

            if (password_verify(trim($password), $userData['password'])) {
                return new User(
                    $userData['name'],
                    $userData['email'],
                    '',
                    $userData['uuid']
                );
            }
        }

        return null;
    }


    public function add(User $user): void
    {
        // Example query to add a new user
        $stmt = $this->pdo->prepare("INSERT INTO user (uuid,  name, email, password) VALUES (:uuid, :name, :email, :password)");

        $uuid = $user->getUuid();
        $stmt->bindParam(':uuid', $uuid);

        $name = $user->getName();
        $stmt->bindParam(':name', $name);

        $email = $user->getEmail();
        $stmt->bindParam(':email', $email);

        // User class does the password hashing
        // $hashedPassword = password_hash($user->getPassword(), PASSWORD_BCRYPT);
        $hashedPassword = $user->getPassword();
        $stmt->bindParam(':password', $hashedPassword);

        $stmt->execute();
    }
}
