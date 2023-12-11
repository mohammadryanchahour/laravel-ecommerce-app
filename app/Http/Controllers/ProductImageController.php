<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function index($productId)
    {
        try {
            $product = Product::findOrFail($productId);
            $images = $product->images;
            return response()->json(['Images' => $images], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch images: ' . $e->getMessage()], 500);
        }
    }
    
    public function store(Request $request, $productId)
    {
        try {
            $product = Product::findOrFail($productId);

            $request->validate([
                'image_url' => 'required|url',
            ]);

            $imageUrl = $request->input('image_url');

            $productImage = new ProductImage([
                'image_url' => $imageUrl,
            ]);

            $product->images()->save($productImage);

            return response()->json(['Image' => $productImage, 'message' => 'Image URL added Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add image URL: ' . $e->getMessage()], 500);
        }
    }

    public function show($productId, $imageId)
    {
        try {
            $product = Product::findOrFail($productId);
            $image = $product->images()->findOrFail($imageId);
            return response()->json(['Image' => $image], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch image: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $productId, $imageId)
{
    try {
        $product = Product::findOrFail($productId);
        $image = $product->images()->findOrFail($imageId);

        $request->validate([
            'image_url' => 'required|url',
        ]);

        $imageUrl = $request->input('image_url');

        $image->update([
            'image_url' => $imageUrl,
        ]);

        return response()->json(['Updated Image' => $image, 'message' => 'Image URL updated Successfully!'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to update image URL: ' . $e->getMessage()], 500);
    }
}


public function delete($productId, $imageId)
{
    try {
        $product = Product::findOrFail($productId);
        $image = $product->images()->findOrFail($imageId);

        $image->delete();

        return response()->json(['message' => 'Image Deleted Successfully!'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to delete image: ' . $e->getMessage()], 500);
    }
}
}
