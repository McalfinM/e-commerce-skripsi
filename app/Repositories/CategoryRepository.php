<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{

    public function get_all()
    {
        return Category::all();
    }
}
