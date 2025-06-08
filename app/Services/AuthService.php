<?php

namespace App\Services;

use App\Repositories\UserRepository;

class AuthService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    /**
     * @param $data
     * @return string
     */
    public function register($data): string
    {
        $user = $this->userRepository->create($data);
        return $user->createToken('Personal Access Token')->accessToken;
    }
}
