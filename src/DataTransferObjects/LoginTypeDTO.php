<?php

namespace App\DataTransferObjects;

final class LoginTypeDTO
{
    public function __construct(
        public string $username = '',
        public string $password = '',
    ) {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
