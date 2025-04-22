<?php

declare(strict_types=1);

namespace App\Pub\User\Model;


class User
{
    private string $uuid;
    private string $name;
    private string $email;
    private string $password;

    public function __construct(string $name, string $email, string $password = '', string $uuid = '')
    {

        if ($uuid !== '') {
            $this->uuid = $uuid;
        } else {
            $this->uuid = $this->generateUUID();
        }

        $this->name = $name;
        $this->email = $email;
        $this->password = '';

        if ($password !== '') {
            $this->password = password_hash($password, PASSWORD_BCRYPT);
        }
    }

    public function getUUID(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    // simple UUID generator RFC 4122
    private function generateUUID(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set variant to 10

        return vsprintf('urn:uuid:%s-%s-%s-%s-%s', str_split(bin2hex($data), 4));
    }
}
