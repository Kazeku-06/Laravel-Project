<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::getAllCategoriesPaginated(5);

        return view('pages.admin.category', [
            'categories' => $categories
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $data = [
            'category_name' => $request->input('category_name'),
            'category_description' => $request->input('category_description'),
        ];

        $operation = Category::createCategory($data);

        if ($operation) {
            return redirect()->route('admin.category')->with('success', 'Successfully created category data');
        } else {
            return redirect()->route('admin.category')->with('error', 'Failed to create category data');
        }
    }

    public function update(CategoryRequest $request, string $category_id)
    {
        $data = [
            'category_name' => $request->input('category_name'),
            'category_description' => $request->input('category_description'),
        ];

        $operation = Category::updateCategory($category_id, $data);

        if ($operation) {
            return redirect()->route('admin.category')->with('success', 'Successfully updated category data');
        } else {
            return redirect()->route('admin.category')->with('error', 'Failed to update category data');
        }
    }

    public function delete(string $category_id)
    {
        $operation = Category::deleteCategory($category_id);

        if ($operation) {
            return redirect()->route('admin.category')->with('success', 'Successfully deleted category data');
        } else {
            return redirect()->route('admin.category')->with('error', 'Failed to delete category data');
        }
    }
}
