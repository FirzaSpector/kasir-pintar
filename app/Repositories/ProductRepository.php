<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return Product::with('category')->get();
    }

    public function find(int $id)
    {
        return Product::findOrFail($id);
    }

    public function getByCategory(int $categoryId)
    {
        return Product::where('category_id', $categoryId)->with('category')->get();
    }

    public function search(string $keyword)
    {
        return Product::where('name', 'like', "%{$keyword}%")
            ->orWhere('sku', 'like', "%{$keyword}%")
            ->with('category')
            ->get();
    }

    public function updateStock(int $id, int $qty)
    {
        $product = $this->find($id);
        $product->stock += $qty;
        $product->save();
        return $product;
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(int $id, array $data)
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }

    public function delete(int $id)
    {
        $product = $this->find($id);
        return $product->delete();
    }
}
