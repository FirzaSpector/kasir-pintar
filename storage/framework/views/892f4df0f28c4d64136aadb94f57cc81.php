<?php $__env->startSection('title', 'Riwayat Transaksi - Kasir Pintar'); ?>
<?php $__env->startSection('header_title', 'Riwayat Transaksi'); ?>
<?php $__env->startSection('header_subtitle', 'Seluruh catatan transaksi penjualan yang berhasil diproses.'); ?>

<?php $__env->startSection('content'); ?>
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
            <?php if($transactions->isEmpty()): ?>
                <div class="cart-empty-state">
                    <ion-icon name="receipt-outline"></ion-icon>
                    <h3>Belum ada transaksi</h3>
                    <p>Semua transaksi yang diselesaikan oleh kasir akan muncul di sini.</p>
                </div>
            <?php else: ?>
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
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong><?php echo e($trx->invoice_no); ?></strong></td>
                                <td><?php echo e($trx->created_at->format('d/m/Y H:i:s')); ?></td>
                                <td><?php echo e($trx->user->name); ?></td>
                                <td><span class="pill-method"><?php echo e($trx->payment_method->label()); ?></span></td>
                                <td><strong>Rp <?php echo e(number_format($trx->total_amount, 0, ',', '.')); ?></strong></td>
                                <td>Rp <?php echo e(number_format($trx->paid_amount, 0, ',', '.')); ?></td>
                                <td>Rp <?php echo e(number_format($trx->change_amount, 0, ',', '.')); ?></td>
                                <td><span class="pill-status success">Sukses</span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\kasir-pintar\resources\views/pos/transactions.blade.php ENDPATH**/ ?>