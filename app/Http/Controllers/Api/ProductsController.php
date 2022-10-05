<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductLike;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function likeProduct(Request $request)
    {
        // validation
        $request->validate([
            'productId' => 'required|numeric'
        ]);

        $productId = intval($request->productId);

        // First check if product exist in Database.
        if (!Product::where('id', $productId)->exists()) {
            return response([
                'status' => false,
                'message' => 'Product not found.'
            ]);
        }

        // Add to ProductLike table.
        $ipAddress = empty(request()->ip) ? 'http://localhost' : request()->ip;

        if (ProductLike::where('product_id', $productId)->where('ip_address', $ipAddress)->exists()) {
            ProductLike::where('product_id', $productId)->where('ip_address', $ipAddress)->delete();
            return response([
                'status' => false,
                'message' => 'Removed from liked product !'
            ]);
        }

        $productLike = new ProductLike();
        $productLike->product_id = $productId;
        $productLike->ip_address = $ipAddress;

        if ($productLike->save()) {
            return response([
                'status' => true,
                'message' => 'Product liked successfully !'
            ]);
        }

        return response([
            'status' => false,
            'message' => 'Something went wrong. Please try again !'
        ]);
    }
}
