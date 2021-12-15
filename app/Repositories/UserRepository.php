<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create($data)
    {
        $user = new User();
        $user->email = $data['email'];
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->role = $data['role'];
        $user->save();
        return $user;
    }
}
