<?php

namespace App\Http\Services\Products;

use App\Models\Product;

class GetProductsService
{
    /**
     * Get all products with their categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProducts()
    {
        return Product::with('category')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get products by seller ID.
     *
     * @param int $sellerId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProductsBySeller($sellerId)
    {
        return Product::with('category')
            ->where('user_id', $sellerId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get a product by its ID.
     *
     * @param int $id
     * @return \App\Models\Product
     */
    public function getProductById($id)
    {
        return Product::with('category')
            ->orderBy('created_at', 'desc')
            ->findOrFail($id);
    }

    /**
     * Get products by category ID.
     *
     * @param int $categoryId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProductsByCategory($categoryId)
    {
        return Product::where('category_id', $categoryId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}