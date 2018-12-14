<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\EloquentRepository;

class CategoryRepository extends EloquentRepository
{
    public function getModel()
    {
        return Category::class;
    }

    public function categoryFirst($category)
    {
        return $this->model->where('id', '=', $category)->first();
    }

    public function pluckCategory()
    {
        return $this->model->where('parent_id', '=', config('custom.zero'))->pluck('name', 'id')->prepend('Choose a Category ', '');
    }

    public function getParent()
    {
        return $this->model->where('parent_id', config('custom.zero'))->get();
    }

    public function pluckCategoryParent()
    {
        return $this->model->where('parent_id', '=', config('custom.zero'))
                           ->pluck('name', 'id')
                           ->prepend('No parent', config('custom.zero'))
                           ->prepend('Choose a Category ', '');
    }

    public function pluckCategoryParentDiff($category_id)
    {
        return $this->model->where('parent_id', '=', config('custom.zero'))
                           ->where('id', '!=', $category_id)
                           ->pluck('name', 'id')
                           ->prepend('No parent', config('custom.zero'))
                           ->prepend('Choose a Category ', '');
    }
}
