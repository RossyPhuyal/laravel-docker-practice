<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
            'bio' => $data['bio'],
            'profile_photo' => $data['profile_photo'],
            'skills' => $data['skills']
        ]);
    }
}
