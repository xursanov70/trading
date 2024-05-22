<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\User;

class CategoryController extends Controller
{
    public function addCategory(CategoryRequest $request)
    {
        Category::create([
            'category_name' => $request->category_name,
            'category_image' => $request->hasFile('category_image') ? $request->file('category_image')->store('category_images') : null,
        ]);

        return response()->json(["message" => "Categoriya muvaffaqqiyatli qo'shildi!", 'success' => true], 201);
    }

    public function updateCategory(UpdateCategoryRequest $request, int $categoryId)
    {
        $category = Category::find($categoryId);
        $category->update([
            'category_name' => $request->category_name,
            'category_image' => $request->hasFile('category_image') ? $request->file('category_image')->store('category_images') : null,
        ]);
        return response()->json(["message" => "Categoriya o'zgartirildi!", 'success' => true], 201);
    }

    public function getCategory(){
        return Category::select('id', 'category_name', 'category_image', 'active')->paginate(15);
    }

}
