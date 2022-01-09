<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function get_all()
    {
        return $this->categoryRepository->get_all();
    }
}
