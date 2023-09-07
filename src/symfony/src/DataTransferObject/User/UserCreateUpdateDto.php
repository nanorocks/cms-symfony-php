<?php

namespace App\DataTransferObject\User;

use App\Enum\UserRoles;

class UserCreateUpdateDto
{
    public function __construct(
        public string $email,
        public ?array $roles,
        public ?string $username,
        public ?string $avatar,
        public string $password,
        public bool $isVerified
    )  
    {}
}