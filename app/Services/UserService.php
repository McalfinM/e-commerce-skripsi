<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\ProfileService;

class UserService
{

    protected $userRepository;
    protected $profileService;
    public function __construct(
        UserRepository $userRepository,
        ProfileService $profileService
    ) {
        $this->userRepository = $userRepository;
        $this->profileService = $profileService;
    }

    public function create($data)
    {
        // dd($data['password']);
        if ($data['password'] !== $data['confirm_password']) {
            return redirect()->back()->with('error' . 'Password tidak sama');
        } else {
            $password = bcrypt($data['password']);
            $data['password'] = $password;
            $data['role'] = 'Member';
            $user = $this->userRepository->create($data);
            $profile = [
                'user_id' => $user->id,
                'full_name' => $user->username,
                'phone_number' => null,
                'address' => null,
                'image' => 'image.jpg'

            ];
            $this->profileService->create($profile);
        }
    }
}
