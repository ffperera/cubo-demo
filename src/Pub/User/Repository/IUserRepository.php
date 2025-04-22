<?php

declare(strict_types=1);

namespace App\Pub\User\Repository;

use App\Pub\User\Model\User;

// Ensure the User class exists in the specified namespace or adjust the namespace if necessary.

interface IUserRepository
{
    /**
     * @param array <string,mixed> $options
     */
    public function init(array $options = []): void;


    /**
     * @param array <string,mixed> $options
     * @return array <string,User> 
     */
    public function getUsers(array $options = []): array;

    public function getUserById(string $id): ?User;

    public function getUserByUsernameAndPassword(string $username, string $password): ?User;

    public function add(User $user): void;
}
