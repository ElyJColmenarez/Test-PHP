<?php

namespace App\Application\DTOs;

class LoginUserDTO {
    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {}
}
