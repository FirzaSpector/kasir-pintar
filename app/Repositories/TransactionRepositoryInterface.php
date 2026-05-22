<?php

namespace App\Repositories;

interface TransactionRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function findByInvoice(string $invoiceNo);
    public function create(array $data);
    public function addDetail(int $transactionId, array $detailData);
    public function getRecent(int $limit);
    public function getTodayTotal();
}
