<?php

namespace App\Domain\Entities;

class UserEntity {
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {}
}
