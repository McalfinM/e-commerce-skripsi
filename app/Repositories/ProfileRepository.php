<?php

namespace App\Repositories;

use App\Models\Profile;

class ProfileRepository
{

    public function create($data)
    {
        return Profile::create($data);
    }
}
