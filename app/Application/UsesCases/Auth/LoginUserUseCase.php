<?php

namespace App\Application\UsesCases\Auth;

use App\Application\DTOs\LoginUserDTO;
use App\Domain\Repositories\AuthRepositoryInterface;

class LoginUserUseCase {
    public function __construct(
        private AuthRepositoryInterface $authRepository
    ) {}

    public function execute(LoginUserDTO $dto): ?string {
        return $this->authRepository->login($dto);
    }
}
