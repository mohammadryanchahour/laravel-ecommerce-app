<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::all();
            return response()->json(['Products' => $products], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch products: ' . $e->getMessage()], 500);
        }
    }
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);

            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json(['Product' => $product, 'message' => 'Product Created Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create product: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json(['Product' => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch product: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $request->validate([
                'name' => 'required',
                'description' => 'required',
            ]);

            $product->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json(['Updated Product' => $product, 'message' => 'Product Updated Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update product: ' . $e->getMessage()], 500);
        }
    }

    // public function edit($id)
    // {
    //     try {
    //         $product = Product::findOrFail($id);
    //         return response()->json(['Product' => $product], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Failed to fetch product for editing: ' . $e->getMessage()], 500);
    //     }
    // }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            $product->delete();

            return response()->json(['message' => 'Product Deleted Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete product: ' . $e->getMessage()], 500);
        }
    }
}
