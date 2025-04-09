<?php

namespace App\Application\UsesCases\Auth;

use App\Application\DTOs\RegisterUserDTO;
use App\Domain\Repositories\AuthRepositoryInterface;
use App\Domain\Entities\UserEntity;

class RegisterUserUseCase {
    public function __construct(
        private AuthRepositoryInterface $authRepository
    ) {}

    public function execute(RegisterUserDTO $dto): void {
        $userEntity = new UserEntity(
            $dto->name,
            $dto->email,
            $dto->password
        );

        $this->authRepository->register($userEntity);
    }
}
