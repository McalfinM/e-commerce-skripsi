<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\ProfileService;
use Illuminate\Support\Str;

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
        // dd($data);
        if ($data['type'] == 'company') {
            $data['role'] = 'Company';
        } else {
            $data['role'] = 'Member';
        }
        // dd($data);


        if ($data['password'] !== $data['confirm_password']) {
            return redirect()->back()->with('error' . 'Password tidak sama');
        }

        $password = bcrypt($data['password']);
        $data['password'] = $password;
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
