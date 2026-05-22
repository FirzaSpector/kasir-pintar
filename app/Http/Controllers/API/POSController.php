<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepositoryInterface;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Exception;

class POSController extends Controller
{
    protected $productRepo;
    protected $transactionService;

    public function __construct(
        ProductRepositoryInterface $productRepo,
        TransactionService $transactionService
    ) {
        $this->productRepo = $productRepo;
        $this->transactionService = $transactionService;
    }

    public function searchProducts(Request $request)
    {
        $keyword = $request->get('q', '');
        $products = $this->productRepo->search($keyword);
        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'paid_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        try {
            $transaction = $this->transactionService->checkout(
                $request->items,
                $request->paid_amount,
                $request->payment_method
            );

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil diproses.',
                'data' => $transaction->load(['details.product', 'user']),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
