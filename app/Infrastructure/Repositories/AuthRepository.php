<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\AuthRepositoryInterface;
use App\Domain\Entities\UserEntity;
use App\Application\DTOs\LoginUserDTO;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface {
    public function register(UserEntity $userEntity): void {
        User::create([
            'name' => $userEntity->name,
            'email' => $userEntity->email,
            'password' => bcrypt($userEntity->password)
        ]);
    }

    public function login(LoginUserDTO $dto): ?string {
        $credentials = [
            'email' => $dto->email,
            'password' => $dto->password
        ];

        return JWTAuth::attempt($credentials);
    }
}
