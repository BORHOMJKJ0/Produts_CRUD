<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(
            ProductResource::collection(Product::all())
        );
    }

    public function show(Product $product)
    {
        return response()->json(
            ProductResource::make($product)
        );
    }

    public function store(Request $request)
    {
        try
        {
        $request->validate([
            'name' => 'required|string|max:191|unique:products,name',
            'price' => 'required|numeric',
            'is_available' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ]);
        $product = Product::create($request->all());
        return response()->json([
            'message' => 'Product created',
            'status' => 201,
            'data' => ProductResource::make($product),
        ]);
    }catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Validation error',
            'errors' => $e->errors(),
        ], 400);
    }
    }

    public function update(Request $request, Product $product)
    {
        try {
            $request->validate([
                'name' => 'string|max:191|unique:products,name',
                'price' => 'numeric',
                'is_available' => 'boolean',
                'category_id' => 'exists:categories,id',
            ]);
            $product->update($request->all());

            return response()->json([
                'message' => 'Product updated',
                'status' => 200,
                'data' => ProductResource::make($product),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 400);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted',
            'status' => 200,
        ]);
    }
}
