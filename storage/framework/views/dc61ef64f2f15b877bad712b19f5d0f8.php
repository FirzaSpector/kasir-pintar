<?php $__env->startSection('title', 'Dashboard - Kasir Pintar'); ?>
<?php $__env->startSection('header_title', 'Ringkasan Laporan'); ?>
<?php $__env->startSection('header_subtitle', 'Selamat datang kembali! Berikut ringkasan penjualan usaha Anda hari ini.'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-grid">
    <!-- Baris 1: Kartu Metrik Utama -->
    <div class="metrics-row">
        <!-- Pendapatan -->
        <div class="metric-card">
            <div class="metric-card-header">
                <span>PENDAPATAN HARI INI</span>
                <div class="metric-icon success">
                    <ion-icon name="trending-up-outline"></ion-icon>
                </div>
            </div>
            <div class="metric-card-body">
                <h2>Rp <?php echo e(number_format($todaySales, 0, ',', '.')); ?></h2>
                <span class="trend up">
                    <ion-icon name="arrow-up-outline"></ion-icon>
                    12.5% dari kemarin
                </span>
            </div>
        </div>

        <!-- Jumlah Transaksi -->
        <div class="metric-card">
            <div class="metric-card-header">
                <span>TRANSAKSI HARI INI</span>
                <div class="metric-icon primary">
                    <ion-icon name="receipt-outline"></ion-icon>
                </div>
            </div>
            <div class="metric-card-body">
                <h2><?php echo e($totalTransactionsCount); ?> Transaksi</h2>
                <span class="trend up">
                    <ion-icon name="arrow-up-outline"></ion-icon>
                    5% dari jam yang sama
                </span>
            </div>
        </div>

        <!-- Stok Menipis Warning -->
        <div class="metric-card">
            <div class="metric-card-header">
                <span>STOK MENIPIS (< 10)</span>
                <div class="metric-icon warning">
                    <ion-icon name="alert-circle-outline"></ion-icon>
                </div>
            </div>
            <div class="metric-card-body">
                <h2><?php echo e($lowStockProducts->count()); ?> Produk</h2>
                <span class="trend <?php echo e($lowStockProducts->count() > 0 ? 'down' : 'up'); ?>">
                    <ion-icon name="<?php echo e($lowStockProducts->count() > 0 ? 'warning-outline' : 'checkmark-outline'); ?>"></ion-icon>
                    <?php echo e($lowStockProducts->count() > 0 ? 'Membutuhkan restock segera' : 'Stok aman terkendali'); ?>

                </span>
            </div>
        </div>
    </div>

    <!-- Baris 2: Grafik & Riwayat Transaksi -->
    <div class="dashboard-details-row">
        <!-- Grafik Penjualan (Pure CSS/SVG Bento Box) -->
        <div class="details-card chart-container-card">
            <div class="card-header">
                <h3>Tren Penjualan Pekan Ini</h3>
                <span>Mei 2026</span>
            </div>
            <div class="card-body chart-body">
                <!-- Gorgeous custom pure SVG chart for Light Mode -->
                <div class="svg-chart-wrapper">
                    <svg viewBox="0 0 500 200" class="custom-svg-chart">
                        <defs>
                            <linearGradient id="chart-grad" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#10b981" stop-opacity="0.3"/>
                                <stop offset="100%" stop-color="#10b981" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                        <!-- Grid Lines -->
                        <line x1="0" y1="40" x2="500" y2="40" stroke="#f1f5f9" stroke-width="1" />
                        <line x1="0" y1="90" x2="500" y2="90" stroke="#f1f5f9" stroke-width="1" />
                        <line x1="0" y1="140" x2="500" y2="140" stroke="#f1f5f9" stroke-width="1" />
                        <line x1="0" y1="190" x2="500" y2="190" stroke="#e2e8f0" stroke-width="2" />
                        
                        <!-- Area Fill -->
                        <path d="M 0,190 Q 70,120 140,140 T 280,70 T 420,110 L 500,80 L 500,190 Z" fill="url(#chart-grad)" />
                        <!-- Line Plot -->
                        <path d="M 0,190 Q 70,120 140,140 T 280,70 T 420,110 L 500,80" fill="none" stroke="#10b981" stroke-width="4" stroke-linecap="round" />
                        
                        <!-- Data Points -->
                        <circle cx="140" cy="140" r="6" fill="#10b981" stroke="#ffffff" stroke-width="2" />
                        <circle cx="280" cy="70" r="6" fill="#10b981" stroke="#ffffff" stroke-width="2" />
                        <circle cx="420" cy="110" r="6" fill="#10b981" stroke="#ffffff" stroke-width="2" />
                    </svg>
                </div>
                <!-- X-Axis Labels -->
                <div class="chart-labels">
                    <span>Sen</span>
                    <span>Sel</span>
                    <span>Rab</span>
                    <span>Kam</span>
                    <span>Jum</span>
                    <span>Sab</span>
                    <span>Min</span>
                </div>
            </div>
        </div>

        <!-- Daftar Peringatan Stok Menipis -->
        <div class="details-card warning-list-card">
            <div class="card-header">
                <h3>Peringatan Stok Menipis</h3>
                <span class="warning-count"><?php echo e($lowStockProducts->count()); ?> Terdeteksi</span>
            </div>
            <div class="card-body">
                <?php if($lowStockProducts->isEmpty()): ?>
                    <div class="empty-state-small">
                        <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                        <p>Hebat! Seluruh stok produk mencukupi.</p>
                    </div>
                <?php else: ?>
                    <ul class="warning-products-list">
                        <?php $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="item-meta">
                                    <h4><?php echo e($prod->name); ?></h4>
                                    <span>SKU: <?php echo e($prod->sku); ?></span>
                                </div>
                                <div class="item-stock warning-level">
                                    <span>Sisa: <strong><?php echo e($prod->stock); ?></strong></span>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Baris 3: Aktivitas Transaksi Terbaru -->
    <div class="dashboard-full-row">
        <div class="details-card">
            <div class="card-header">
                <h3>Aktivitas Transaksi Terbaru</h3>
                <a href="<?php echo e(route('pos.transactions')); ?>" class="btn btn-outline btn-small">Lihat Semua</a>
            </div>
            <div class="card-body table-responsive">
                <?php if($recentTransactions->isEmpty()): ?>
                    <div class="empty-state-small">
                        <ion-icon name="receipt-outline"></ion-icon>
                        <p>Belum ada transaksi tercatat hari ini.</p>
                    </div>
                <?php else: ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No Invoice</th>
                                <th>Waktu</th>
                                <th>Kasir</th>
                                <th>Metode Bayar</th>
                                <th>Total Tagihan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $recentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong><?php echo e($trx->invoice_no); ?></strong></td>
                                    <td><?php echo e($trx->created_at->format('d/m/Y H:i')); ?></td>
                                    <td><?php echo e($trx->user->name); ?></td>
                                    <td><span class="pill-method"><?php echo e($trx->payment_method->label()); ?></span></td>
                                    <td><strong>Rp <?php echo e(number_format($trx->total_amount, 0, ',', '.')); ?></strong></td>
                                    <td><span class="pill-status success">Sukses</span></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\kasir-pintar\resources\views/dashboard/index.blade.php ENDPATH**/ ?>