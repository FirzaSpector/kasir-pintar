<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        $products = $this->productRepo->all();
        $categories = Category::all();
        return view('pos.products', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:50|unique:products,sku',
            'barcode' => 'nullable|string|max:50|unique:products,barcode',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|string|max:255',
        ], [
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists' => 'Kategori produk tidak valid.',
            'name.required' => 'Nama produk wajib diisi.',
            'sku.required' => 'SKU produk wajib diisi.',
            'sku.unique' => 'SKU produk sudah digunakan oleh produk lain.',
            'barcode.unique' => 'Barcode produk sudah digunakan oleh produk lain.',
            'price.required' => 'Harga jual wajib diisi.',
            'price.numeric' => 'Harga jual harus berupa angka.',
            'price.min' => 'Harga jual tidak boleh kurang dari 0.',
            'stock.required' => 'Stok awal wajib diisi.',
            'stock.integer' => 'Stok awal harus berupa angka bulat.',
            'stock.min' => 'Stok awal tidak boleh kurang dari 0.',
        ]);

        $this->productRepo->create($validated);

        return redirect()->route('pos.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:50|unique:products,sku,' . $id,
            'barcode' => 'nullable|string|max:50|unique:products,barcode,' . $id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|string|max:255',
        ], [
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists' => 'Kategori produk tidak valid.',
            'name.required' => 'Nama produk wajib diisi.',
            'sku.required' => 'SKU produk wajib diisi.',
            'sku.unique' => 'SKU produk sudah digunakan oleh produk lain.',
            'barcode.unique' => 'Barcode produk sudah digunakan oleh produk lain.',
            'price.required' => 'Harga jual wajib diisi.',
            'price.numeric' => 'Harga jual harus berupa angka.',
            'price.min' => 'Harga jual tidak boleh kurang dari 0.',
            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok produk harus berupa angka bulat.',
            'stock.min' => 'Stok produk tidak boleh kurang dari 0.',
        ]);

        $this->productRepo->update($id, $validated);

        return redirect()->route('pos.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->productRepo->delete($id);
        return redirect()->route('pos.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
