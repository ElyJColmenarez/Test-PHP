<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\UserEntity;
use App\Application\DTOs\LoginUserDTO;

interface AuthRepositoryInterface {
    public function register(UserEntity $user): void;
    public function login(LoginUserDTO $dto): ?string;  // Retorna token JWT
}
