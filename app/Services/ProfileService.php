<?php

namespace App\Services;

use App\Repositories\ProfileRepository;

class ProfileService
{

    protected $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function create($data)
    {
        $this->profileRepository->create($data);
    }
}
