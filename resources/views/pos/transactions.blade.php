@extends('layouts.app')

@section('title', 'Riwayat Transaksi - Kasir Pintar')
@section('header_title', 'Riwayat Transaksi')
@section('header_subtitle', 'Seluruh catatan transaksi penjualan yang berhasil diproses.')

@section('content')
<div class="dashboard-full-row">
    <div class="details-card">
        <div class="card-header">
            <h3>Daftar Transaksi</h3>
            <div class="search-box-container" style="max-width: 300px;">
                <ion-icon name="search-outline"></ion-icon>
                <input type="text" id="trx-search" placeholder="Cari invoice...">
            </div>
        </div>
        <div class="card-body table-responsive">
            @if($transactions->isEmpty())
                <div class="cart-empty-state">
                    <ion-icon name="receipt-outline"></ion-icon>
                    <h3>Belum ada transaksi</h3>
                    <p>Semua transaksi yang diselesaikan oleh kasir akan muncul di sini.</p>
                </div>
            @else
                <table class="data-table" id="transactions-table">
                    <thead>
                        <tr>
                            <th>No Invoice</th>
                            <th>Tanggal & Waktu</th>
                            <th>Kasir</th>
                            <th>Metode Bayar</th>
                            <th>Total Tagihan</th>
                            <th>Jumlah Bayar</th>
                            <th>Kembalian</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $trx)
                            <tr>
                                <td><strong>{{ $trx->invoice_no }}</strong></td>
                                <td>{{ $trx->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>{{ $trx->user->name }}</td>
                                <td><span class="pill-method">{{ $trx->payment_method->label() }}</span></td>
                                <td><strong>Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</strong></td>
                                <td>Rp {{ number_format($trx->paid_amount, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($trx->change_amount, 0, ',', '.') }}</td>
                                <td><span class="pill-status success">Sukses</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
