<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\EloquentRepository;
use App\Repositories\CategoryRepository;

class ProductRepository extends EloquentRepository
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
       parent::__construct();
       $this->categoryRepository = $categoryRepository;
    }
    public function getModel()
    {
        return Product::class;
    }

    public function common($request, $products, $type)
    {
        if ($request){
            $products->where(function($products) use ($request, $type) {
                foreach ($request as $each_request) {
                    if ($each_request != trans('message.leftbar.all')) {
                        $products->orWhere($type, 'LIKE', $each_request);
                    }
                }
            });
        }
        return true;
    }

    public function filter($categories, $strap, $skin, $energy, $price_min, $price_max, $search, $sort)
    {
        $products = $this->model->select('*');
        if ($categories){
            $products = $products->where(function($products) use ($categories) {
                foreach ($categories as $category) {
                    $cat = $this->categoryRepository->categoryFirst($category);
                    if ($category != config('custom.zero')) {
                        if (count($cat->children) > config('custom.zero')) {
                            foreach ($cat->children as $cat_child) {
                                $products->orwhere('category_id', '=', $cat_child->id);
                            }
                        } else {
                            $products->orwhere('category_id', '=', $category);
                        }
                    }
                }
            });
        }
        $this->common($strap, $products, 'strap_type');
        $this->common($skin, $products, 'skin_type');
        $this->common($energy, $products, 'energy');

        if ($price_min && $price_max){
            $products->whereBetween('price',  [$price_min * config('custom.million'), $price_max * config('custom.million')]);
        }
        $search = explode(' ',$search);
        $products->where(function($products) use ($search) {
            for($i = config('custom.zero'); $i < count($search); $i++)
            {
                $products->orWhere('name','LIKE','%'.$search[$i].'%');
            }
        });

        if ($sort == 'popularity'){
            $products = $products->orderBy('best_seller', 'DESC');
        } elseif ($sort == 'price_asc') {
            $products = $products->orderBy('price', 'asc');
        } elseif ($sort == 'price_desc') {
            $products = $products->orderBy('price', 'desc');
        } else {
            $products = $products->orderBy('id', 'DESC');
        }
        $products = $products->paginate(config('custom.nine'));

        return $products;
    }

    public function descFirst()
    {
        return $this->model->orderBy('id', "DESC")->first();
    }

    public function getProductBestSeller($category)
    {
        return $this->model->where('category_id', $category)->sum('best_seller');
    }

    public function checkProductExist($name)
    {
        return $this->model->where('name', $name)->exists();
    }
}
