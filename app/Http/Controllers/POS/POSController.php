<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;

class POSController extends Controller
{
    protected $productRepo;
    protected $transactionRepo;

    public function __construct(
        ProductRepositoryInterface $productRepo,
        TransactionRepositoryInterface $transactionRepo
    ) {
        $this->productRepo = $productRepo;
        $this->transactionRepo = $transactionRepo;
    }

    public function index()
    {
        $categories = Category::all();
        $products = $this->productRepo->all();
        return view('pos.cashier', compact('categories', 'products'));
    }

    public function dashboard()
    {
        $todaySales = $this->transactionRepo->getTodayTotal();
        $recentTransactions = $this->transactionRepo->getRecent(5);
        $allProducts = $this->productRepo->all();
        
        // hitung stok menipis (< 10)
        $lowStockProducts = $allProducts->filter(function($product) {
            return $product->stock < 10;
        });

        // hitung total transaksi hari ini
        $totalTransactionsCount = $recentTransactions->count();

        return view('dashboard.index', compact(
            'todaySales',
            'recentTransactions',
            'lowStockProducts',
            'totalTransactionsCount'
        ));
    }

    public function transactions()
    {
        $transactions = $this->transactionRepo->all();
        return view('pos.transactions', compact('transactions'));
    }
}
