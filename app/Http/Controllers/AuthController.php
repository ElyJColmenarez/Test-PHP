<?php

namespace App\Http\Controllers;

use App\Application\UsesCases\Auth\RegisterUserUseCase;
use App\Application\UsesCases\Auth\LoginUserUseCase;
use App\Application\DTOs\RegisterUserDTO;
use App\Application\DTOs\LoginUserDTO;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;


class AuthController extends Controller {
    public function __construct(
        private RegisterUserUseCase $registerUserUseCase,
        private LoginUserUseCase $loginUserUseCase
    ) {}

    // Registro
    public function register(RegisterUserRequest $request) {
        $dto = new RegisterUserDTO(
            $request->name,
            $request->email,
            $request->password
        );

        $this->registerUserUseCase->execute($dto);

        // Generar token después del registro
        $token = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'success' => true,
            'message' => 'Usuario registrado exitosamente.',
        ], 201);
    }

    // Login
    public function login(LoginUserRequest $request) {

        $dto = new LoginUserDTO(
            $request->email,
            $request->password
        );

        $token = $this->loginUserUseCase->execute($dto);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
