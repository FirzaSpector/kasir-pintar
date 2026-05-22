<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function all()
    {
        return Transaction::with(['user', 'details.product'])->orderBy('created_at', 'desc')->get();
    }

    public function find(int $id)
    {
        return Transaction::with(['user', 'details.product'])->findOrFail($id);
    }

    public function findByInvoice(string $invoiceNo)
    {
        return Transaction::with(['user', 'details.product'])->where('invoice_no', $invoiceNo)->firstOrFail();
    }

    public function create(array $data)
    {
        return Transaction::create($data);
    }

    public function addDetail(int $transactionId, array $detailData)
    {
        $detailData['transaction_id'] = $transactionId;
        return TransactionDetail::create($detailData);
    }

    public function getRecent(int $limit)
    {
        return Transaction::with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getTodayTotal()
    {
        return Transaction::whereDate('created_at', Carbon::today())
            ->where('status', 'success')
            ->sum('total_amount');
    }
}
