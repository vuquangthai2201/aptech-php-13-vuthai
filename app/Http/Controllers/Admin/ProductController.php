<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProductController extends Controller
{
    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $products = $this->productRepository->paginate(config('custom.ten'));

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->pluckCategory();
        $strap_type = $this->productRepository->pluck('strap_type', 'strap_type');
        $skin_type = $this->productRepository->pluck('skin_type', 'skin_type');
        $energy = $this->productRepository->pluck('energy', 'energy');

        return view('admin.product.add', compact('categories', 'strap_type', 'skin_type', 'energy'));
    }

    public function store(Request $request)
    {
        $data_product = [
            'name' => $request->name,
            'price' => $request->price,
            'preview' => $request->preview,
            'description' => $request->description,
            'rating' => config('custom.zero'),
            'best_seller' => config('custom.zero'),
            'energy' => $request->energy,
            'strap_type' => $request->strap,
            'skin_type' => $request->skin,
            'picture' => '',
            'category_id' => config('custom.zero'),
        ];
        if ($request->sub_category) {
            $data_product['category_id'] = $request->sub_category;
        } else {
            $data_product['category_id'] = $request->category;
        }

        $image = $request->file('picture')->store('images/products');
        $tmp = explode('/', $image);
        $picture = end($tmp);
        $data_product['picture'] = $picture;

        try {
            $this->productRepository->create($data_product);
            $product = $this->productRepository->descFirst();
            $path_picture = '/images/products/'. $product->id .'.jpg';
            $product->picture = $product->id. '.jpg';
            $product->save();
            Storage::move($image, $path_picture);
            Storage::delete($image);
            $request->session()->flash('suc', trans('message.admin.add_product_suc'));
        } catch (Exception $e) {
            $request->session()->flash('err', $e->getMessage());
        }

        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $product = $this->productRepository->findOrFail($id);
        $categories = $this->categoryRepository->pluckCategory();
        $sub_categories = [];
        if ($product->category->parent) {
            $sub_categories = $product->category->parent->children->pluck('name', 'id')->prepend(trans('message.admin.choose_sub_cat'), '');
        }
        $strap_type = $this->productRepository->pluck('strap_type', 'strap_type');
        $skin_type = $this->productRepository->pluck('skin_type', 'skin_type');
        $energy = $this->productRepository->pluck('energy', 'energy');

        return view('admin.product.edit', compact('product', 'categories', 'sub_categories', 'strap_type', 'skin_type', 'energy'));
    }

    public function update(Request $request, $id)
    {
        $product = $this->productRepository->findOrFail($id);
        try {
            $product->name = $request->name;
            $product->price = $request->price;
            $product->preview = $request->preview;
            $product->description = $request->description;
            $product->energy = $request->energy;
            $product->strap_type = $request->strap;
            $product->skin_type = $request->skin;

            if ($request->sub_category) {
                $product->category_id = $request->sub_category;
            } else {
                $product->category_id = $request->category;
            }
            $path_picture = '/images/products/'. $product->id .'.jpg';
            if ($request->picture != null){
                if ($product->picture != null) {
                    Storage::delete($path_picture);
                }
                $image = $request->file('picture')->store('images/products');
                Storage::move($image, $path_picture);
            }
            $product->save();
            $request->session()->flash('suc', trans('message.admin.edit_product_suc'));
        } catch (Exception $e) {
            $request->session()->flash('err', $e->getMessage());
        }

        return redirect()->route('product.edit', $product->id);
    }

    public function destroy(Request $request, $id)
    {
        try {
            $this->productRepository->delete($id);
            $request->session()->flash('suc', trans('message.admin.del_product_suc'));
        } catch (Exception $e) {
            $request->session()->flash('err', $e->getMessage());
        }

        return redirect()->route('product.index');
    }
    public function changeCategory(Request $request)
    {
        $category = $this->categoryRepository->findOrFail($request->id);

        if (count($category->children) > config('custom.zero')) {
            $sub_categories = $category->children->pluck('name', 'id')->prepend(trans('message.admin.choose_sub_cat'), '');
            return view('admin.product.change_category', compact('sub_categories'));
        }
    }

    public function import(Request $request)
    {
        try {
            if (!$request->csv){
                $request->session()->flash('err', trans('message.admin.should_choose_csv'));
                return redirect()->route('product.index');
            }
            $file = $request->csv;
            $csvData = file_get_contents($file);
            $tmp = explode("\n", $csvData);
            if (end($tmp) == null) {
                $data = array_slice($tmp, config('custom.zero'), count($tmp) - config('custom.min'));
                $rowData = array_map('str_getcsv', $data);
            } else {
                $rowData = array_map('str_getcsv', $tmp);
            }

            foreach ($rowData as $row) {
                if (!$this->productRepository->checkProductExist($row[config('custom.zero')])) {
                    $insertData = [
                        'name' => $row[config('custom.zero')],
                        'category_id' => $row[config('custom.min')],
                        'picture' => $row[config('custom.two')],
                        'price' => $row[config('custom.three')],
                        'preview' => $row[config('custom.four')],
                        'description' => $row[config('custom.five')],
                        'rating' => $row[config('custom.six')],
                        'best_seller' => $row[config('custom.seven')],
                        'energy' => $row[config('custom.eight')],
                        'strap_type' => $row[config('custom.nine')],
                        'skin_type' => $row[config('custom.ten')],
                    ];
                    $this->productRepository->create($insertData);
                }
            }
            $request->session()->flash('suc', trans('message.admin.import_product_suc'));
        } catch (Exception $e) {
            $request->session()->flash('err', $e->getMessage());
        }
        return redirect()->route('product.index');
    }

    public function changeStrap(Request $request)
    {
        $value = $request->value;
        $strap_type = $this->productRepository->pluck('strap_type', 'strap_type');

        return view('admin.product.change_strap', compact('value', 'strap_type'));
    }

    public function changeSkin(Request $request)
    {
        $value = $request->value;
        $skin_type = $this->productRepository->pluck('skin_type', 'skin_type');

        return view('admin.product.change_skin', compact('value', 'skin_type'));
    }

    public function changeEnergy(Request $request)
    {
        $value = $request->value;
        $energy = $this->productRepository->pluck('energy', 'energy');

        return view('admin.product.change_energy', compact('value', 'energy'));
    }
}
