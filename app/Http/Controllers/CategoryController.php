<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(
            CategoryResource::collection(Category::all())
        );
    }

    public function show(Category $category)
    {
        return response()->json(
            CategoryResource::make($category)
        );
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());

        return response()->json([
            'message' => 'Category created',
            'status' => 200,
            'data' => CategoryResource::make($category),
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return response()->json([
            'message' => 'Category updated',
            'status' => 200,
            'data' => CategoryResource::make($category),
        ]);
    }

    public function destroy(Category $category)
    {
        if($category->products()->count()) {
            return response()->json([
                'message' => 'Category cannot delete',
                'status' => 200,
                'data' => CategoryResource::make($category),
            ]);
        }
        else
        {   $category->delete();
        return response()->json([
            'message' => 'Category deleted',
            'status' => 200,
            'data' => CategoryResource::make($category),
        ]);
    }}
}
