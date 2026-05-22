<?php $__env->startSection('title', 'Kasir Pintar - Manajemen Produk'); ?>
<?php $__env->startSection('header_title', 'Manajemen Produk'); ?>
<?php $__env->startSection('header_subtitle', 'Kelola data katalog produk, harga jual, dan stok persediaan.'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-full-row">
    <?php if(session('success')): ?>
        <div style="background-color: var(--color-success-light); color: var(--color-success); padding: 12px 20px; border-radius: var(--radius-sm); margin-bottom: 20px; font-weight: 700; font-size: 13px; display: flex; align-items: center; gap: 8px;">
            <ion-icon name="checkmark-circle" style="font-size: 18px;"></ion-icon>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="details-card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <h3>Daftar Persediaan Produk</h3>
            <button class="btn btn-success" id="btn-tambah-produk" onclick="openLaravelProductModal()">
                <ion-icon name="add-circle-outline"></ion-icon>
                <span>Tambah Produk Baru</span>
            </button>
        </div>
        
        <div class="card-body table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th>Stok Fisik</th>
                        <th>Status Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><strong><?php echo e($product->sku); ?></strong></td>
                            <td><?php echo e($product->name); ?></td>
                            <td><span class="pill-method" style="background-color: var(--color-primary-light); color: var(--color-primary);"><?php echo e($product->category->name ?? 'Tanpa Kategori'); ?></span></td>
                            <td><strong><?php echo e($product->formatted_price); ?></strong></td>
                            <td><strong><?php echo e($product->stock); ?></strong></td>
                            <td>
                                <?php if($product->stock == 0): ?>
                                    <span class="pill-status danger" style="background-color: var(--color-danger-light); color: var(--color-danger); padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: 700;">Habis</span>
                                <?php elseif($product->stock < 10): ?>
                                    <span class="pill-status warning" style="background-color: var(--color-warning-light); color: var(--color-warning); padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: 700;">Sisa <?php echo e($product->stock); ?></span>
                                <?php else: ?>
                                    <span class="pill-status success" style="background-color: var(--color-success-light); color: var(--color-success); padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: 700;">Aman</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <button class="btn btn-outline btn-small" style="padding: 6px 10px;" onclick="openLaravelProductModal(<?php echo e(json_encode($product)); ?>)">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </button>
                                    <form action="<?php echo e(route('pos.products.destroy', $product->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-outline btn-small" style="padding: 6px 10px; color: var(--color-danger); border-color: var(--color-danger-light);">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 32px; color: var(--text-muted);">
                                <ion-icon name="fast-food-outline" style="font-size: 48px; opacity: 0.5; margin-bottom: 8px;"></ion-icon>
                                <h4>Katalog Produk Kosong</h4>
                                <p>Silakan klik "Tambah Produk Baru" untuk memasukkan item pertama Anda.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Form CRUD (Di sisi Laravel, disembunyikan secara default) -->
<div class="modal-overlay" id="laravel-product-modal" style="display: none;">
    <div class="payment-modal" style="max-width: 500px;">
        <div class="modal-header">
            <h3 id="modal-title-label">Tambah Produk Baru</h3>
            <button class="close-modal-btn" onclick="closeLaravelProductModal()">
                <ion-icon name="close-outline"></ion-icon>
            </button>
        </div>
        
        <form id="laravel-product-form" action="<?php echo e(route('pos.products.store')); ?>" method="POST" style="padding: 24px;">
            <?php echo csrf_field(); ?>
            <div id="method-field-container"></div>
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 12px; font-weight: 700; color: var(--text-secondary); margin-bottom: 6px;">Nama Produk *</label>
                <input type="text" name="name" id="prod-name" required style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: var(--radius-md); font-size: 14px;">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 12px; font-weight: 700; color: var(--text-secondary); margin-bottom: 6px;">SKU / Kode Unik *</label>
                <input type="text" name="sku" id="prod-sku" required style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: var(--radius-md); font-size: 14px; text-transform: uppercase;">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 12px; font-weight: 700; color: var(--text-secondary); margin-bottom: 6px;">Kategori Produk *</label>
                <select name="category_id" id="prod-category" required style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: var(--radius-md); font-size: 14px; background-color: white;">
                    <option value="">-- Pilih Kategori --</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: var(--text-secondary); margin-bottom: 6px;">Harga Jual (Rp) *</label>
                    <input type="number" name="price" id="prod-price" required min="0" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: var(--radius-md); font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: var(--text-secondary); margin-bottom: 6px;">Stok Awal *</label>
                    <input type="number" name="stock" id="prod-stock" required min="0" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: var(--radius-md); font-size: 14px;">
                </div>
            </div>

            <div class="modal-footer" style="padding: 16px 0 0; display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" class="btn btn-outline" onclick="closeLaravelProductModal()">Batalkan</button>
                <button type="submit" class="btn btn-success" id="btn-save-label">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openLaravelProductModal(product = null) {
        const modal = document.getElementById('laravel-product-modal');
        const form = document.getElementById('laravel-product-form');
        const titleLabel = document.getElementById('modal-title-label');
        const saveLabel = document.getElementById('btn-save-label');
        const methodField = document.getElementById('method-field-container');

        if (product) {
            // Edit Mode
            titleLabel.innerText = 'Ubah Detail Produk';
            saveLabel.innerText = 'Simpan Perubahan';
            form.action = `/products/${product.id}`;
            methodField.innerHTML = '<?php echo method_field("PUT"); ?>';

            document.getElementById('prod-name').value = product.name;
            document.getElementById('prod-sku').value = product.sku;
            document.getElementById('prod-category').value = product.category_id;
            document.getElementById('prod-price').value = parseInt(product.price);
            document.getElementById('prod-stock').value = product.stock;
        } else {
            // Add Mode
            titleLabel.innerText = 'Tambah Produk Baru';
            saveLabel.innerText = 'Simpan Produk';
            form.action = "<?php echo e(route('pos.products.store')); ?>";
            methodField.innerHTML = '';

            document.getElementById('prod-name').value = '';
            document.getElementById('prod-sku').value = 'MKN-' + Math.floor(1000 + Math.random() * 9000);
            document.getElementById('prod-category').value = '';
            document.getElementById('prod-price').value = '';
            document.getElementById('prod-stock').value = '';
        }

        modal.style.display = 'flex';
        setTimeout(() => modal.classList.add('active'), 10);
    }

    function closeLaravelProductModal() {
        const modal = document.getElementById('laravel-product-modal');
        modal.classList.remove('active');
        setTimeout(() => modal.style.display = 'none', 250);
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\kasir-pintar\resources\views/pos/products.blade.php ENDPATH**/ ?>