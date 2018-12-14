<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getParent();

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->pluckCategoryParent();

        return view('admin.category.add', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->parent_id == config('custom.zero')) {
                $data = [
                    'name' => $request->name,
                    'parent_id' => config('custom.zero'),
                ];
            } else {
                $data = [
                    'name' => $request->name,
                    'parent_id' => $request->parent_id,
                ];
            }
            $this->categoryRepository->create($data);
            $request->session()->flash('suc', trans('message.admin.add_cat_suc'));
        } catch (Exception $e) {
            $request->session()->flash('err', $e->getMessage());
        }

        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->findOrFail($id);
        $categories = $this->categoryRepository->pluckCategoryParentDiff($category->id);

        return view('admin.category.edit', compact('categories', 'category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $category = $this->categoryRepository->findOrFail($id);
            if ($request->parent_id == config('custom.zero')) {
                $category->name = $request->name;
                $category->parent_id = config('custom.zero');
            } else {
                $category->name = $request->name;
                $category->parent_id = $request->parent_id;
            }
            $category->save();
            $request->session()->flash('suc', trans('message.admin.edit_cat_suc'));
        } catch (Exception $e) {
            $request->session()->flash('err', $e->getMessage());
        }

        return redirect()->route('category.edit', $category->id);
    }

    public function destroy(Request $request, $id)
    {
        try {
            $category = $this->categoryRepository->findOrFail($id);
            if ($category->parent_id == config('custom.zero') && count($category->children) > config('custom.zero')) {
                $category->delete();
                foreach ($category->children as $cat_child) {
                    $cat_child->delete();
                }
            } else {
                $category->delete();
            }
            $request->session()->flash('suc', trans('message.admin.del_cat_suc'));
        } catch (Exception $e) {
            $request->session()->flash('err', $e->getMessage());
        }

        return redirect()->route('category.index');
    }
}
