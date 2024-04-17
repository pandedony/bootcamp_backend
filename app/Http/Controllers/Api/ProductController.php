<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try {
            // Fetch all products
            $products = Product::all();

            // Check if any products were found
            if ($products->isEmpty()) {
                throw new ModelNotFoundException('No products found.');
            }

            // Return products as a collection of ProductResource
            return ProductResource::collection($products);
        } catch (ModelNotFoundException $e) {
            // Handle case where no products are found
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            // Handle other unexpected exceptions
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

    public function show($id)
    {
        try {
            // Retrieve a single product by ID
            $product = Product::findOrFail($id);

            // Return a single ProductResource instance
            return new ProductResource($product);
        } catch (ModelNotFoundException $e) {
            // Handle case where product with the specified ID is not found
            return response()->json(['error' => 'Product not found.'], 404);
        } catch (\Exception $e) {
            // Handle other unexpected exceptions
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }
}
