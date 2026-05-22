<?php $__env->startSection('title', 'Kasir Utama - Kasir Pintar'); ?>
<?php $__env->startSection('header_title', 'Kasir Utama'); ?>
<?php $__env->startSection('header_subtitle', 'Kelola keranjang belanja dan transaksi penjualan langsung.'); ?>

<?php $__env->startSection('content'); ?>
<div class="pos-layout">
    <!-- Panel Kiri: Produk & Kategori -->
    <div class="pos-products-section">
        <!-- Pencarian & Filter Kategori -->
        <div class="filter-bar">
            <div class="search-box-container" style="display: flex; align-items: center; gap: 8px; width: 100%;">
                <div class="input-with-icon" style="position: relative; flex: 1; display: flex; align-items: center;">
                    <ion-icon name="search-outline" style="position: absolute; left: 16px; color: #64748b; font-size: 20px;"></ion-icon>
                    <input type="text" id="product-search" placeholder="Cari nama, SKU, atau scan barcode langsung..." style="padding-left: 48px; width: 100%;">
                </div>
                <button class="btn-barcode-scan-trigger" onclick="window.openBarcodeCameraModal()" title="Pindai Barcode via Kamera" style="display: flex; align-items: center; justify-content: center; width: 46px; height: 46px; border-radius: 12px; background: rgba(99, 102, 241, 0.15); border: 1px solid rgba(99, 102, 241, 0.3); color: #818cf8; cursor: pointer; transition: all 0.2s ease;">
                    <ion-icon name="barcode-outline" style="font-size: 24px;"></ion-icon>
                </button>
            </div>
            
            <div class="category-filters">
                <button class="category-btn active" data-category="all">Semua</button>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button class="category-btn" data-category="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Grid Produk -->
        <div class="products-grid" id="products-container">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product-card" 
                     data-id="<?php echo e($product->id); ?>" 
                     data-name="<?php echo e($product->name); ?>" 
                     data-price="<?php echo e($product->price); ?>" 
                     data-category="<?php echo e($product->category->slug); ?>"
                     data-stock="<?php echo e($product->stock); ?>"
                     data-sku="<?php echo e($product->sku); ?>">
                    
                    <?php if($product->stock < 10): ?>
                        <div class="stock-badge warning">Sisa <?php echo e($product->stock); ?></div>
                    <?php elseif($product->stock == 0): ?>
                        <div class="stock-badge danger">Habis</div>
                    <?php endif; ?>

                    <div class="product-card-image">
                        <!-- Placeholder/SVG for premium UI -->
                        <div class="product-placeholder-bg">
                            <ion-icon name="fast-food-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="product-card-info">
                        <span class="product-sku"><?php echo e($product->sku); ?></span>
                        <h3><?php echo e($product->name); ?></h3>
                        <div class="product-card-footer">
                            <span class="product-price">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></span>
                            <button class="add-to-cart-btn" <?php echo e($product->stock == 0 ? 'disabled' : ''); ?>>
                                <ion-icon name="add-outline"></ion-icon>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Panel Kanan: Keranjang Belanja -->
    <div class="pos-cart-section">
        <div class="cart-card">
            <div class="cart-header">
                <ion-icon name="cart-outline"></ion-icon>
                <h2>Keranjang Belanja</h2>
                <span class="cart-count-pill" id="cart-total-qty">0 Item</span>
            </div>

            <!-- List Item Keranjang -->
            <div class="cart-items-list" id="cart-items-container">
                <!-- State Kosong -->
                <div class="cart-empty-state" id="cart-empty-msg">
                    <ion-icon name="basket-outline"></ion-icon>
                    <h3>Keranjang masih kosong</h3>
                    <p>Klik pada produk di sebelah kiri untuk menambahkan ke keranjang belanja.</p>
                </div>
            </div>

            <!-- Ringkasan Harga -->
            <div class="cart-totals-section">
                <div class="total-row">
                    <span>Subtotal</span>
                    <span id="cart-subtotal">Rp 0</span>
                </div>
                <div class="total-row" style="display: none;">
                    <span>Pajak (PPN 11%)</span>
                    <span id="cart-tax">Rp 0</span>
                </div>
                <div class="total-row grand-total">
                    <span>Total Belanja</span>
                    <span id="cart-grandtotal">Rp 0</span>
                </div>
            </div>

            <!-- Tombol Transaksi -->
            <div class="cart-actions">
                <button class="btn btn-danger btn-outline" id="clear-cart-btn">
                    <ion-icon name="trash-outline"></ion-icon>
                    <span>Batal</span>
                </button>
                <button class="btn btn-success" id="checkout-btn" disabled>
                    <ion-icon name="checkmark-circle-outline"></ion-icon>
                    <span>Bayar Sekarang</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pembayaran (Glassmorphic Slide-up) -->
<div class="modal-overlay" id="checkout-modal">
    <div class="payment-modal">
        <div class="modal-header">
            <h3>Penyelesaian Pembayaran</h3>
            <button class="close-modal-btn" id="close-payment-modal">
                <ion-icon name="close-outline"></ion-icon>
            </button>
        </div>
        
        <div class="payment-body" style="padding: 12px 20px; display: flex; flex-direction: column; gap: 10px;">
            <!-- Top: Total & Kembalian side by side -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <div class="payment-summary-box" style="margin: 0; padding: 12px 16px;">
                    <span style="font-size: 10px;">TOTAL TAGIHAN</span>
                    <h1 id="modal-bill-amount" style="font-size: 22px; margin-top: 2px;">Rp 0</h1>
                </div>
                <!-- Kembalian Info - always visible -->
                <div class="change-summary-box" id="change-summary-box" style="margin: 0; padding: 12px 16px; display: flex; flex-direction: column; justify-content: center;">
                    <span class="change-label" style="font-size: 10px;">KEMBALIAN</span>
                    <h2 id="modal-change-amount" style="font-size: 22px; margin-top: 2px;">Rp 0</h2>
                </div>
            </div>

            <div class="payment-grid" style="gap: 12px;">
                <!-- Pilihan Metode Pembayaran -->
                <div class="payment-methods-section" style="padding: 0;">
                    <h4 style="font-size: 11px; margin-bottom: 6px;">Metode Pembayaran</h4>
                    <div class="method-toggles" style="gap: 6px;">
                        <button class="method-btn active" data-method="tunai" style="padding: 8px 10px; font-size: 12px;">
                            <ion-icon name="cash-outline"></ion-icon>
                            <span>Uang Tunai</span>
                        </button>
                        <button class="method-btn" data-method="kartu" style="padding: 8px 10px; font-size: 12px;">
                            <ion-icon name="card-outline"></ion-icon>
                            <span>Debit / Kredit</span>
                        </button>
                        <button class="method-btn" data-method="qris" style="padding: 8px 10px; font-size: 12px;">
                            <ion-icon name="qr-code-outline"></ion-icon>
                            <span>QRIS Mandiri</span>
                        </button>
                    </div>
                </div>

                <!-- Input Nominal Tunai & Numpad -->
                <div class="cash-input-section" id="cash-payment-fields" style="padding: 0;">
                    <h4 style="font-size: 11px; margin-bottom: 6px;">Jumlah Bayar (Tunai)</h4>
                    <div class="cash-input-wrapper" style="margin-bottom: 8px;">
                        <span class="rp-prefix">Rp</span>
                        <input type="number" id="cash-paid-input" placeholder="0" readonly style="height: 40px; font-size: 18px;">
                    </div>
                    
                    <!-- Quick Cash Buttons -->
                    <div class="quick-cash-buttons" style="gap: 6px; margin-bottom: 8px;">
                        <button class="quick-cash-btn" data-amount="10000" style="padding: 6px 4px; font-size: 11px;">Rp 10k</button>
                        <button class="quick-cash-btn" data-amount="20000" style="padding: 6px 4px; font-size: 11px;">Rp 20k</button>
                        <button class="quick-cash-btn" data-amount="50000" style="padding: 6px 4px; font-size: 11px;">Rp 50k</button>
                        <button class="quick-cash-btn" data-amount="100000" style="padding: 6px 4px; font-size: 11px;">Rp 100k</button>
                        <button class="quick-cash-btn" id="exact-cash-btn" style="padding: 6px 4px; font-size: 11px;">Uang Pas</button>
                    </div>

                    <!-- Numpad (compact) -->
                    <div class="numpad-grid" style="gap: 5px;">
                        <button class="numpad-btn" data-val="1" style="padding: 8px; font-size: 16px;">1</button>
                        <button class="numpad-btn" data-val="2" style="padding: 8px; font-size: 16px;">2</button>
                        <button class="numpad-btn" data-val="3" style="padding: 8px; font-size: 16px;">3</button>
                        <button class="numpad-btn" data-val="4" style="padding: 8px; font-size: 16px;">4</button>
                        <button class="numpad-btn" data-val="5" style="padding: 8px; font-size: 16px;">5</button>
                        <button class="numpad-btn" data-val="6" style="padding: 8px; font-size: 16px;">6</button>
                        <button class="numpad-btn" data-val="7" style="padding: 8px; font-size: 16px;">7</button>
                        <button class="numpad-btn" data-val="8" style="padding: 8px; font-size: 16px;">8</button>
                        <button class="numpad-btn" data-val="9" style="padding: 8px; font-size: 16px;">9</button>
                        <button class="numpad-btn" data-val="000" style="padding: 8px; font-size: 14px;">000</button>
                        <button class="numpad-btn" data-val="0" style="padding: 8px; font-size: 16px;">0</button>
                        <button class="numpad-btn numpad-clear" id="numpad-backspace" style="padding: 8px;">
                            <ion-icon name="backspace-outline"></ion-icon>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer" style="padding: 10px 20px;">
            <button class="btn btn-outline" id="cancel-checkout-btn">Batalkan</button>
            <button class="btn btn-success btn-large" id="process-checkout-btn" disabled>
                <ion-icon name="print-outline"></ion-icon>
                <span>Proses Transaksi & Cetak</span>
            </button>
        </div>
    </div>
</div>

<!-- Modal Struk / Printer Simulator -->
<div class="modal-overlay" id="receipt-modal">
    <div class="receipt-paper">
        <div class="receipt-header">
            <h3>KASIR PINTAR SWALAYAN</h3>
            <p>Jalan A. Yani KM. 5, Banjarmasin</p>
            <p>Telp: (0511) 3250-1920</p>
            <div class="dashed-line"></div>
        </div>

        <div class="receipt-details">
            <p><strong>No Invoice:</strong> <span id="receipt-invoice">TRX-20260521-X9A2</span></p>
            <p><strong>Kasir:</strong> <span id="receipt-cashier">Siti Aminah</span></p>
            <p><strong>Waktu:</strong> <span id="receipt-time">21/05/2026 12:45</span></p>
            <div class="dashed-line"></div>
        </div>

        <div class="receipt-items" id="receipt-items-list">
            <!-- Disimulasikan via Javascript -->
        </div>

        <div class="dashed-line"></div>

        <div class="receipt-summary">
            <div class="receipt-row">
                <span>Subtotal</span>
                <span id="receipt-subtotal">Rp 0</span>
            </div>
            <div class="receipt-row" style="display: none;">
                <span>Pajak (PPN 11%)</span>
                <span id="receipt-tax">Rp 0</span>
            </div>
            <div class="receipt-row bold">
                <span>TOTAL AKHIR</span>
                <span id="receipt-total">Rp 0</span>
            </div>
            <div class="dashed-line"></div>
            <div class="receipt-row">
                <span>Metode Bayar</span>
                <span id="receipt-method">Tunai</span>
            </div>
            <div class="receipt-row">
                <span>Bayar</span>
                <span id="receipt-paid">Rp 0</span>
            </div>
            <div class="receipt-row">
                <span>Kembali</span>
                <span id="receipt-change">Rp 0</span>
            </div>
        </div>

        <div class="receipt-footer">
            <div class="dashed-line"></div>
            <p>Terima Kasih Atas Kunjungan Anda</p>
            <p>Powered by KasirPintar POS</p>
            
            <button class="btn btn-success btn-large print-no-print" onclick="window.print()">
                <ion-icon name="print"></ion-icon>
                <span>Cetak Struk Fiskal</span>
            </button>
            <button class="btn btn-outline print-no-print" id="close-receipt-btn" style="margin-top: 8px;">
                <span>Tutup Preview</span>
            </button>
        </div>
    </div>
</div>

<!-- MODAL 5: Modal Pemindai Barcode Kamera (Webcam Barcode Scanner) -->
<div class="modal-overlay" id="barcode-camera-modal">
    <div class="payment-modal" style="max-width: 500px; text-align: center; border: 1px solid rgba(139, 92, 246, 0.4); box-shadow: 0 20px 50px rgba(139, 92, 246, 0.15);">
        <div class="modal-header" style="border-bottom: 1px solid var(--border-color); padding: 16px 24px;">
            <h3 style="font-size: 16px; font-weight: 800; display: flex; align-items: center; gap: 8px; color: var(--text-primary);">
                <ion-icon name="barcode-outline" style="color: var(--color-primary); font-size: 20px;"></ion-icon>
                Pemindai Barcode Kamera
            </h3>
            <button class="close-modal-btn" onclick="window.closeBarcodeCameraModal()">
                <ion-icon name="close-outline"></ion-icon>
            </button>
        </div>
        <div style="padding: 24px; position: relative;">
            <p style="font-size: 13px; color: var(--text-secondary); margin-bottom: 16px;">
                Arahkan barcode produk (di bagian belakang kemasan) ke dalam area kotak pemindaian di bawah ini.
            </p>
            
            <!-- Frame kamera pemindai dengan penyorot neon -->
            <div class="barcode-scanner-viewport" style="position: relative; width: 100%; aspect-ratio: 4/3; background: #0b0f19; border-radius: 12px; overflow: hidden; border: 1px solid var(--border-color);">
                <!-- Kotak Bidik Scanner (Target Area Overlay) -->
                <div class="scanner-laser-line"></div>
                <div class="scanner-bracket top-left"></div>
                <div class="scanner-bracket top-right"></div>
                <div class="scanner-bracket bottom-left"></div>
                <div class="scanner-bracket bottom-right"></div>
                
                <div id="barcode-scanner-reader" style="width: 100%; height: 100%;"></div>
            </div>
            
            <div style="margin-top: 20px; display: flex; justify-content: center;">
                <button type="button" class="btn btn-danger btn-outline btn-large" onclick="window.closeBarcodeCameraModal()" style="padding: 10px 24px;">
                    <span>Batalkan Pemindaian</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Sync Data SQLite Ke JS Engine -->
<script>
    window.isLaravel = true;
    window.laravelCategories = <?php echo json_encode($categories->map(function($c) { return ['name' => $c->name, 'slug' => $c->slug]; })); ?>;
    window.laravelProducts = <?php echo json_encode($products->map(function($p) {
        return [
            'id' => $p->id,
            'category' => $p->category->slug ?? 'umum',
            'name' => $p->name,
            'sku' => $p->sku,
            'price' => (int) $p->price,
            'stock' => (int) $p->stock,
            'icon' => $p->icon ?? 'fast-food-outline',
            'barcode' => $p->barcode
        ];
    })); ?>;
</script>

<!-- Load Html5-QRCode library via CDN -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\kasir-pintar\resources\views/pos/cashier.blade.php ENDPATH**/ ?>