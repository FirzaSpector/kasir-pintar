<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class TransactionService
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

    public function generateInvoiceNumber(): string
    {
        $today = date('Ymd');
        $randomSuffix = strtoupper(bin2hex(random_bytes(2))); // e.g. 4EF2
        return "TRX-{$today}-{$randomSuffix}";
    }

    public function checkout(array $cartItems, float $paidAmount, string $paymentMethod): object
    {
        return DB::transaction(function () use ($cartItems, $paidAmount, $paymentMethod) {
            $totalAmount = 0.0;
            $validatedItems = [];

            // 1. Validasi Stok & Harga
            foreach ($cartItems as $item) {
                $product = $this->productRepo->find($item['product_id']);

                if (!$product->hasStock($item['qty'])) {
                    throw new Exception("Stok tidak mencukupi untuk produk: {$product->name}. Sisa stok: {$product->stock}");
                }

                $subtotal = $product->price * $item['qty'];
                $totalAmount += $subtotal;

                $validatedItems[] = [
                    'product_id' => $product->id,
                    'qty' => $item['qty'],
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ];
            }

            // 2. Cek apakah Uang Bayar Cukup
            if ($paidAmount < $totalAmount) {
                throw new Exception("Uang pembayaran tidak cukup. Total belanja: Rp " . number_format($totalAmount, 0, ',', '.') . ", Uang dibayarkan: Rp " . number_format($paidAmount, 0, ',', '.'));
            }

            $changeAmount = $paidAmount - $totalAmount;

            // 3. Simpan Transaksi Utama
            $transaction = $this->transactionRepo->create([
                'user_id' => Auth::id() ?? 1, // fallback to cashier id 1 if not logged in (e.g. CLI/testing)
                'invoice_no' => $this->generateInvoiceNumber(),
                'total_amount' => $totalAmount,
                'paid_amount' => $paidAmount,
                'change_amount' => $changeAmount,
                'payment_method' => $paymentMethod,
                'status' => 'success',
            ]);

            // 4. Simpan Detail & Kurangi Stok
            foreach ($validatedItems as $item) {
                // Simpan baris detail
                $this->transactionRepo->addDetail($transaction->id, $item);

                // Kurangi stok produk (-qty)
                $this->productRepo->updateStock($item['product_id'], -$item['qty']);
            }

            return $transaction;
        });
    }
}
