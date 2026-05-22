/* ==========================================================================
   Kasir Pintar (POS) - Interactive Live UI Preview Script
   Created with Web Audio feedback, real-time stock decrement,
   multi-view dashboard support, and full Bahasa Indonesia copy.
   ========================================================================== */

// 1. Mock Database - Synchronized with ProductSeeder & CategorySeeder
const categories = [
    { name: 'Minuman Segar', slug: 'minuman-segar' },
    { name: 'Makanan Ringan (Camilan)', slug: 'makanan-ringan-camilan' },
    { name: 'Makanan Instan', slug: 'makanan-instan' },
    { name: 'Bahan Pokok & Sembako', slug: 'bahan-pokok-sembako' },
    { name: 'Produk Olahan Susu & Roti', slug: 'produk-olahan-susu-roti' },
    { name: 'Perawatan Rambut & Tubuh', slug: 'perawatan-rambut-tubuh' },
    { name: 'Perawatan Wajah & Kulit', slug: 'perawatan-wajah-kulit' },
    { name: 'Kebutuhan Sanitasi', slug: 'kebutuhan-sanitasi' },
    { name: 'Wewangian', slug: 'wewangian' },
    { name: 'Pencuci Pakaian', slug: 'pencuci-pakaian' },
    { name: 'Pembersih Rumah', slug: 'pembersih-rumah' },
    { name: 'Pengendali Hama', slug: 'pengendali-hama' },
    { name: 'Kebutuhan Bayi', slug: 'kebutuhan-bayi' },
    { name: 'Produk Kesehatan Ringan', slug: 'produk-kesehatan-ringan' },
    { name: 'Kebutuhan Imbuhan', slug: 'kebutuhan-imbuhan' }
];

let products = [
    // 1. Minuman Segar
    { id: 1, category: 'minuman-segar', name: 'Air Mineral Aqua 600ml', sku: 'MIN-AQUA-001', price: 3500, stock: 150, icon: 'beer-outline' },
    { id: 2, category: 'minuman-segar', name: 'Teh Botol Sosro 450ml', sku: 'MIN-SOSRO-002', price: 5500, stock: 80, icon: 'beer-outline' },
    { id: 3, category: 'minuman-segar', name: 'Susu UHT Ultra Milk Chocolate 250ml', sku: 'MIN-ULTRA-003', price: 6500, stock: 60, icon: 'nutrition-outline' },
    { id: 4, category: 'minuman-segar', name: 'Coca-Cola 390ml', sku: 'MIN-COKE-004', price: 6000, stock: 40, icon: 'beer-outline' },
    
    // 2. Makanan Ringan
    { id: 5, category: 'makanan-ringan-camilan', name: 'Keripik Singkong Kusuka Barbeque 60g', sku: 'CAM-KUSUKA-001', price: 9500, stock: 50, icon: 'pizza-outline' },
    { id: 6, category: 'makanan-ringan-camilan', name: 'Biskuit Roma Kelapa 300g', sku: 'CAM-ROMA-002', price: 11500, stock: 40, icon: 'pizza-outline' },
    { id: 7, category: 'makanan-ringan-camilan', name: 'Cokelat Silverqueen Almond 58g', sku: 'CAM-SILVER-003', price: 16000, stock: 5, icon: 'pizza-outline' },
    
    // 3. Makanan Instan
    { id: 8, category: 'makanan-instan', name: 'Indomie Goreng Spesial', sku: 'INS-INDOMIE-001', price: 3500, stock: 200, icon: 'restaurant-outline' },
    { id: 9, category: 'makanan-instan', name: 'Sarden ABC Saus Cabai 155g', sku: 'INS-SARDEN-002', price: 12500, stock: 30, icon: 'restaurant-outline' },
    
    // 4. Bahan Pokok & Sembako
    { id: 10, category: 'bahan-pokok-sembako', name: 'Beras Anak Raja Premium 5kg', sku: 'SBK-BERAS-001', price: 74500, stock: 20, icon: 'cube-outline' },
    { id: 11, category: 'bahan-pokok-sembako', name: 'Minyak Goreng Bimoli Refill 1L', sku: 'SBK-MINYAK-002', price: 19500, stock: 35, icon: 'cube-outline' },
    { id: 12, category: 'bahan-pokok-sembako', name: 'Gula Pasir Gulaku Premium 1kg', sku: 'SBK-GULA-003', price: 17500, stock: 50, icon: 'cube-outline' },
    
    // 5. Produk Olahan Susu & Roti
    { id: 13, category: 'produk-olahan-susu-roti', name: 'Roti Tawar Sari Roti Premium', sku: 'ROT-SARIRTI-001', price: 15000, stock: 8, icon: 'nutrition-outline' },
    { id: 14, category: 'produk-olahan-susu-roti', name: 'Keju Kraft Cheddar 165g', sku: 'ROT-KRAFT-002', price: 22000, stock: 25, icon: 'nutrition-outline' },
    
    // 6. Perawatan Rambut & Tubuh
    { id: 15, category: 'perawatan-rambut-tubuh', name: 'Sampo Pantene Anti Dandruff 160ml', sku: 'BDY-PANTENE-001', price: 24500, stock: 25, icon: 'body-outline' },
    { id: 16, category: 'perawatan-rambut-tubuh', name: 'Sabun Cair Lifebuoy Refill 400ml', sku: 'BDY-LIFEBUOY-002', price: 26000, stock: 30, icon: 'body-outline' },
    { id: 17, category: 'perawatan-rambut-tubuh', name: 'Pasta Gigi Pepsodent 190g', sku: 'BDY-PEPSO-003', price: 13500, stock: 45, icon: 'body-outline' },
    
    // 7. Perawatan Wajah & Kulit
    { id: 18, category: 'perawatan-wajah-kulit', name: 'Sabun Cuci Muka Kahf Wash 100ml', sku: 'FCE-KAHF-001', price: 28500, stock: 15, icon: 'sparkles-outline' },
    { id: 19, category: 'perawatan-wajah-kulit', name: 'Sunscreen Emina Sun Battle SPF 30', sku: 'FCE-EMINA-002', price: 29500, stock: 18, icon: 'sparkles-outline' },
    
    // 8. Kebutuhan Sanitasi
    { id: 20, category: 'kebutuhan-sanitasi', name: 'Tisu Wajah Paseo 250 Sheets', sku: 'SAN-PASEO-001', price: 14500, stock: 50, icon: 'medkit-outline' },
    { id: 21, category: 'kebutuhan-sanitasi', name: 'Pembalut Charm Safe Night Wing 8s', sku: 'SAN-CHARM-002', price: 18500, stock: 25, icon: 'medkit-outline' },
    
    // 9. Wewangian
    { id: 22, category: 'wewangian', name: 'Deodoran Rexona Men Roll On 50ml', sku: 'WRG-REXONA-001', price: 19500, stock: 30, icon: 'flower-outline' },
    { id: 23, category: 'wewangian', name: 'Parfum Casablanca Spray Blue 100ml', sku: 'WRG-CASA-002', price: 32500, stock: 15, icon: 'flower-outline' },
    
    // 10. Pencuci Pakaian
    { id: 24, category: 'pencuci-pakaian', name: 'Detergen Rinso Liquid Active Fresh', sku: 'LND-RINSO-001', price: 23500, stock: 30, icon: 'shirt-outline' },
    { id: 25, category: 'pencuci-pakaian', name: 'Pelembut Pewangi Downy Refill 680ml', sku: 'LND-DOWNY-002', price: 18500, stock: 35, icon: 'shirt-outline' },
    
    // 11. Pembersih Rumah
    { id: 26, category: 'pembersih-rumah', name: 'Sabun Cuci Piring Mama Lemon 780ml', sku: 'CLN-MAMALMN-001', price: 9500, stock: 50, icon: 'brush-outline' },
    { id: 27, category: 'pembersih-rumah', name: 'Wipol Karbol Wangi Classic Pine', sku: 'CLN-WIPOL-002', price: 16500, stock: 35, icon: 'brush-outline' },
    
    // 12. Pengendali Hama
    { id: 28, category: 'pengendali-hama', name: 'Obat Nyamuk Semprot Baygon 600ml', sku: 'PEST-BAYGON-001', price: 42500, stock: 15, icon: 'bug-outline' },
    
    // 13. Kebutuhan Bayi
    { id: 29, category: 'kebutuhan-bayi', name: 'Popok MamyPoko Pants Standar M34', sku: 'BY-POPOK-001', price: 62000, stock: 15, icon: 'happy-outline' },
    { id: 30, category: 'kebutuhan-bayi', name: 'Susu SGM Eksplor 1+ Madu 400g', sku: 'BY-SGM-002', price: 45000, stock: 20, icon: 'happy-outline' },
    { id: 31, category: 'kebutuhan-bayi', name: 'Minyak Telon Konicare 60ml', sku: 'BY-TELON-003', price: 21500, stock: 25, icon: 'happy-outline' },
    
    // 14. Produk Kesehatan Ringan
    { id: 32, category: 'produk-kesehatan-ringan', name: 'Panadol Cold & Flu Strip Isi 10', sku: 'MED-PANADOL-001', price: 12500, stock: 60, icon: 'medkit-outline' },
    { id: 33, category: 'produk-kesehatan-ringan', name: 'Minyak Angin Safe Care 10ml', sku: 'MED-SAFECARE-002', price: 15500, stock: 45, icon: 'medkit-outline' },
    
    // 15. Kebutuhan Imbuhan
    { id: 34, category: 'kebutuhan-imbuhan', name: 'Korek Api Gas Tokai Original', sku: 'ACC-TOKAI-001', price: 3500, stock: 120, icon: 'flash-outline' },
];

// Men-generate barcode EAN-13 tiruan untuk semua produk mock di frontend agar cocok dengan database backend
products = products.map((prod, index) => {
    return {
        ...prod,
        barcode: '8990011' + String(index + 1).padStart(6, '0')
    };
});

let transactions = [
    { invoice: 'TRX-20260521-0001', time: '21/05/2026 09:15', cashier: 'Siti Aminah', method: 'Tunai', total: 24500, paid: 30000, change: 5500, items: [
        { name: 'Indomie Goreng Spesial', qty: 5, price: 3500 },
        { name: 'Air Mineral Aqua 600ml', qty: 2, price: 3500 }
    ]},
    { invoice: 'TRX-20260521-0002', time: '21/05/2026 10:30', cashier: 'Siti Aminah', method: 'QRIS Mandiri', total: 95500, paid: 95500, change: 0, items: [
        { name: 'Beras Anak Raja Premium 5kg', qty: 1, price: 74500 },
        { name: 'Minyak Goreng Bimoli Refill 1L', qty: 1, price: 19500 },
        { name: 'Air Mineral Aqua 600ml', qty: 1, price: 3500 }
    ]},
    { invoice: 'TRX-20260521-0003', time: '21/05/2026 11:45', cashier: 'Siti Aminah', method: 'Debit / Kredit', total: 68500, paid: 68500, change: 0, items: [
        { name: 'Susu SGM Eksplor 1+ Madu 400g', qty: 1, price: 45000 },
        { name: 'Detergen Rinso Liquid Active Fresh', qty: 1, price: 23500 }
    ]},
    // Historical transactions for Period filters testing
    { invoice: 'TRX-20260520-0004', time: '20/05/2026 14:20', cashier: 'Siti Aminah', method: 'Tunai', total: 37000, paid: 50000, change: 13000, items: [
        { name: 'Roti Tawar Sari Roti Premium', qty: 1, price: 15000 },
        { name: 'Keju Kraft Cheddar 165g', qty: 1, price: 22000 }
    ]},
    { invoice: 'TRX-20260518-0005', time: '18/05/2026 18:35', cashier: 'Siti Aminah', method: 'QRIS Mandiri', total: 104500, paid: 104500, change: 0, items: [
        { name: 'Beras Anak Raja Premium 5kg', qty: 1, price: 74500 },
        { name: 'Sunscreen Emina Sun Battle SPF 30', qty: 1, price: 29500 }
    ]},
    { invoice: 'TRX-20260515-0006', time: '15/05/2026 12:10', cashier: 'Siti Aminah', method: 'Debit / Kredit', total: 47000, paid: 47000, change: 0, items: [
        { name: 'Sabun Cair Lifebuoy Refill 400ml', qty: 1, price: 26000 },
        { name: 'Minyak Telon Konicare 60ml', qty: 1, price: 21500 }
    ]},
    { invoice: 'TRX-20260505-0007', time: '05/05/2026 11:30', cashier: 'Siti Aminah', method: 'Tunai', total: 125000, paid: 130000, change: 5000, items: [
        { name: 'Popok MamyPoko Pants Standar M34', qty: 1, price: 62000 },
        { name: 'Obat Nyamuk Semprot Baygon 600ml', qty: 1, price: 42500 },
        { name: 'Air Mineral Aqua 600ml', qty: 5, price: 3500 },
        { name: 'Indomie Goreng Spesial', qty: 1, price: 3500 }
    ]}
];

// 2. Active Application State
let cart = [];
let activeCategory = 'all';
let searchQuery = '';
let selectedPaymentMethod = 'tunai';
let cashPaidAmount = ''; // Numpad string

// 3. Audio Synth Feedback (Tactile UX Design Spells)
function playSound(type) {
    try {
        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        const oscillator = audioCtx.createOscillator();
        const gainNode = audioCtx.createGain();
        
        oscillator.connect(gainNode);
        gainNode.connect(audioCtx.destination);
        
        if (type === 'beep') {
            // Crisp barcode scanner sound
            oscillator.type = 'sine';
            oscillator.frequency.setValueAtTime(1400, audioCtx.currentTime); // 1.4kHz
            gainNode.gain.setValueAtTime(0.08, audioCtx.currentTime);
            oscillator.start();
            oscillator.stop(audioCtx.currentTime + 0.07);
        } else if (type === 'double-beep') {
            // Success chime
            oscillator.type = 'sine';
            oscillator.frequency.setValueAtTime(1000, audioCtx.currentTime);
            gainNode.gain.setValueAtTime(0.12, audioCtx.currentTime);
            oscillator.start();
            oscillator.stop(audioCtx.currentTime + 0.05);
            
            const osc2 = audioCtx.createOscillator();
            const gain2 = audioCtx.createGain();
            osc2.connect(gain2);
            gain2.connect(audioCtx.destination);
            osc2.type = 'sine';
            osc2.frequency.setValueAtTime(1500, audioCtx.currentTime + 0.08);
            gain2.gain.setValueAtTime(0.12, audioCtx.currentTime + 0.08);
            osc2.start(audioCtx.currentTime + 0.08);
            osc2.stop(audioCtx.currentTime + 0.18);
        } else if (type === 'error') {
            // Warning buzz
            oscillator.type = 'sawtooth';
            oscillator.frequency.setValueAtTime(110, audioCtx.currentTime);
            gainNode.gain.setValueAtTime(0.08, audioCtx.currentTime);
            oscillator.start();
            oscillator.stop(audioCtx.currentTime + 0.22);
        }
    } catch (e) {
        console.warn("Audio Context could not start:", e);
    }
}

// Helper: Format price as Indonesian Rupiah
function formatRupiah(num) {
    return 'Rp ' + num.toLocaleString('id-ID');
}

// 4. Catalog Rendering & Filtering
function renderProductCatalog() {
    const container = document.getElementById('products-container');
    if (!container) return;
    
    container.innerHTML = '';
    
    // Filter product array
    const filtered = products.filter(p => {
        const matchesCategory = activeCategory === 'all' || p.category === activeCategory;
        const matchesSearch = p.name.toLowerCase().includes(searchQuery.toLowerCase()) || 
                             p.sku.toLowerCase().includes(searchQuery.toLowerCase());
        return matchesCategory && matchesSearch;
    });

    if (filtered.length === 0) {
        container.innerHTML = `
            <div class="cart-empty-state" style="grid-column: 1 / -1; padding: 60px 20px;">
                <ion-icon name="alert-circle-outline" style="font-size: 48px; opacity: 0.5;"></ion-icon>
                <h3 style="margin-top: 8px;">Produk Tidak Ditemukan</h3>
                <p>Coba gunakan kata kunci pencarian yang lain.</p>
            </div>
        `;
        return;
    }
    
    filtered.forEach(p => {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.setAttribute('data-id', p.id);
        
        let badgeHtml = '';
        if (p.stock === 0) {
            badgeHtml = `<div class="stock-badge danger">Habis</div>`;
        } else if (p.stock < 10) {
            badgeHtml = `<div class="stock-badge warning">Sisa ${p.stock}</div>`;
        }
        
        card.innerHTML = `
            ${badgeHtml}
            <div class="product-card-image">
                <div class="product-placeholder-bg">
                    <ion-icon name="${p.icon}"></ion-icon>
                </div>
            </div>
            <div class="product-card-info">
                <span class="product-sku">${p.sku}</span>
                <h3>${p.name}</h3>
                <div class="product-card-footer">
                    <span class="product-price">${formatRupiah(p.price)}</span>
                    <button class="add-to-cart-btn" ${p.stock === 0 ? 'disabled' : ''}>
                        <ion-icon name="add-outline"></ion-icon>
                    </button>
                </div>
            </div>
        `;
        
        // Listeners for clicking the card
        card.addEventListener('click', (e) => {
            if (p.stock === 0) {
                playSound('error');
                return;
            }
            // Don't trigger if they clicked the disabled add button specifically (it handles its own click)
            if (e.target.closest('.add-to-cart-btn') && p.stock === 0) return;
            
            addToCart(p);
        });
        
        container.appendChild(card);
    });
}

// 5. Cart Operations
function addToCart(product) {
    const existing = cart.find(item => item.product.id === product.id);
    
    if (existing) {
        if (existing.quantity >= product.stock) {
            playSound('error');
            alert(`Stok tidak mencukupi! Batas stok ${product.name} adalah ${product.stock}.`);
            return;
        }
        existing.quantity++;
    } else {
        cart.push({ product, quantity: 1 });
    }
    
    playSound('beep');
    updateCartUI();
}

function updateCartQty(productId, delta) {
    const item = cart.find(i => i.product.id === productId);
    if (!item) return;
    
    if (delta > 0) {
        if (item.quantity >= item.product.stock) {
            playSound('error');
            alert(`Stok tidak mencukupi! Batas stok ${item.product.name} adalah ${item.product.stock}.`);
            return;
        }
        item.quantity++;
    } else {
        item.quantity--;
        if (item.quantity <= 0) {
            cart = cart.filter(i => i.product.id !== productId);
        }
    }
    
    playSound('beep');
    updateCartUI();
}

function removeFromCart(productId) {
    cart = cart.filter(i => i.product.id !== productId);
    playSound('error');
    updateCartUI();
}

function clearCart() {
    if (cart.length === 0) return;
    if (confirm('Apakah Anda yakin ingin membatalkan transaksi dan mengosongkan keranjang?')) {
        cart = [];
        playSound('error');
        updateCartUI();
    }
}

function updateCartUI() {
    const listContainer = document.getElementById('cart-items-container');
    const emptyMsg = document.getElementById('cart-empty-msg');
    const countPill = document.getElementById('cart-total-qty');
    const checkoutBtn = document.getElementById('checkout-btn');
    
    if (!listContainer) return;
    
    // Clear list but preserve empty message placeholder if empty
    listContainer.innerHTML = '';
    
    if (cart.length === 0) {
        if (emptyMsg) emptyMsg.style.display = 'flex';
        listContainer.appendChild(emptyMsg);
        countPill.textContent = '0 Item';
        checkoutBtn.disabled = true;
        
        document.getElementById('cart-subtotal').textContent = 'Rp 0';
        document.getElementById('cart-tax').textContent = 'Rp 0';
        document.getElementById('cart-grandtotal').textContent = 'Rp 0';
        return;
    }
    
    if (emptyMsg) emptyMsg.style.display = 'none';
    
    let totalQty = 0;
    let subtotal = 0;
    
    cart.forEach(item => {
        totalQty += item.quantity;
        const rowTotal = item.product.price * item.quantity;
        subtotal += rowTotal;
        
        const row = document.createElement('div');
        row.className = 'cart-item-row';
        row.innerHTML = `
            <div class="cart-item-details">
                <h4>${item.product.name}</h4>
                <div class="cart-item-price">${formatRupiah(item.product.price)}</div>
            </div>
            <div class="cart-item-qty-controls">
                <button class="qty-btn" onclick="window.updateCartQty(${item.product.id}, -1)">
                    <ion-icon name="remove-outline"></ion-icon>
                </button>
                <span class="qty-val">${item.quantity}</span>
                <button class="qty-btn" onclick="window.updateCartQty(${item.product.id}, 1)">
                    <ion-icon name="add-outline"></ion-icon>
                </button>
            </div>
            <button class="remove-cart-item" onclick="window.removeFromCart(${item.product.id})">
                <ion-icon name="close-circle-outline"></ion-icon>
            </button>
        `;
        listContainer.appendChild(row);
    });
    
    countPill.textContent = `${totalQty} Item`;
    checkoutBtn.disabled = false;
    
    const tax = 0;
    const grandtotal = subtotal;
    
    document.getElementById('cart-subtotal').textContent = formatRupiah(subtotal);
    document.getElementById('cart-tax').textContent = formatRupiah(tax);
    document.getElementById('cart-grandtotal').textContent = formatRupiah(grandtotal);
}

// 6. Checkout Modal & Numpad Calculations
function calculateBillSummary() {
    let subtotal = 0;
    cart.forEach(item => {
        subtotal += item.product.price * item.quantity;
    });
    const tax = 0;
    const grandTotal = subtotal;
    return { subtotal, tax, grandTotal };
}

function openCheckoutModal() {
    const modal = document.getElementById('checkout-modal');
    if (!modal) return;
    
    const { grandTotal } = calculateBillSummary();
    
    document.getElementById('modal-bill-amount').textContent = formatRupiah(grandTotal);
    
    // Reset payment settings
    selectedPaymentMethod = 'tunai';
    cashPaidAmount = '';
    document.getElementById('cash-paid-input').value = '';
    document.getElementById('modal-change-amount').textContent = 'Rp 0';
    
    // Toggle active state on methods buttons
    document.querySelectorAll('.method-btn').forEach(btn => {
        btn.classList.remove('active');
        if (btn.getAttribute('data-method') === 'tunai') {
            btn.classList.add('active');
        }
    });
    
    // Display elements
    document.getElementById('cash-payment-fields').style.display = 'block';
    document.getElementById('change-summary-box').style.display = 'flex';
    document.getElementById('process-checkout-btn').disabled = true;
    
    modal.classList.add('active');
}

function closeCheckoutModal() {
    const modal = document.getElementById('checkout-modal');
    if (modal) modal.classList.remove('active');
}

function setPaymentMethod(method) {
    selectedPaymentMethod = method;
    
    document.querySelectorAll('.method-btn').forEach(btn => {
        btn.classList.remove('active');
        if (btn.getAttribute('data-method') === method) {
            btn.classList.add('active');
        }
    });
    
    const cashFields = document.getElementById('cash-payment-fields');
    const changeBox = document.getElementById('change-summary-box');
    const processBtn = document.getElementById('process-checkout-btn');
    
    if (method === 'tunai') {
        cashFields.style.display = 'block';
        changeBox.style.display = 'flex';
        updateChangeCalculation();
    } else {
        cashFields.style.display = 'none';
        changeBox.style.display = 'none';
        processBtn.disabled = false; // card & QRIS can directly checkout
    }
    
    playSound('beep');
}

function handleNumpadInput(val) {
    if (selectedPaymentMethod !== 'tunai') return;
    
    if (val === 'backspace') {
        cashPaidAmount = cashPaidAmount.slice(0, -1);
    } else {
        // Prevent leading zeroes
        if (cashPaidAmount === '' && (val === '0' || val === '000')) return;
        cashPaidAmount += val;
    }
    
    document.getElementById('cash-paid-input').value = cashPaidAmount;
    updateChangeCalculation();
}

function setQuickCash(amount) {
    if (selectedPaymentMethod !== 'tunai') return;
    
    if (amount === 'pas') {
        const { grandTotal } = calculateBillSummary();
        cashPaidAmount = grandTotal.toString();
    } else {
        cashPaidAmount = amount.toString();
    }
    
    document.getElementById('cash-paid-input').value = cashPaidAmount;
    updateChangeCalculation();
    playSound('beep');
}

function updateChangeCalculation() {
    const { grandTotal } = calculateBillSummary();
    const paid = parseInt(cashPaidAmount) || 0;
    const change = paid - grandTotal;
    
    const changeDisplay = document.getElementById('modal-change-amount');
    const processBtn = document.getElementById('process-checkout-btn');
    
    if (change >= 0) {
        changeDisplay.textContent = formatRupiah(change);
        changeDisplay.style.color = 'var(--color-success)';
        processBtn.disabled = false;
    } else {
        changeDisplay.textContent = 'Nominal kurang!';
        changeDisplay.style.color = 'var(--color-danger)';
        processBtn.disabled = true;
    }
}

// 7. Transaction Process & Stock Reduction Simulator
function processTransaction() {
    const { subtotal, tax, grandTotal } = calculateBillSummary();
    const paid = selectedPaymentMethod === 'tunai' ? (parseInt(cashPaidAmount) || 0) : grandTotal;
    const change = paid - grandTotal;
    
    const processBtn = document.getElementById('process-checkout-btn');
    const origBtnContent = processBtn.innerHTML;
    
    // Simulate database write delay
    processBtn.disabled = true;
    processBtn.innerHTML = `<span class="loading-spinner"></span> <span>Memproses...</span>`;
    
    setTimeout(() => {
        // Double Beep Chime (tactile magic)
        playSound('double-beep');
        
        // Decrement physical mock database stocks
        cart.forEach(item => {
            const dbProduct = products.find(p => p.id === item.product.id);
            if (dbProduct) {
                dbProduct.stock = Math.max(0, dbProduct.stock - item.quantity);
            }
        });
        
        // Generate dynamic receipt invoice metadata
        const randHex = Math.floor(1000 + Math.random() * 9000);
        const invoiceNo = `TRX-20260521-${randHex}`;
        const cashierName = 'Siti Aminah';
        const dateStr = new Date().toLocaleDateString('id-ID', {
            year: 'numeric', month: 'numeric', day: 'numeric',
            hour: '2-digit', minute: '2-digit', second: '2-digit'
        });
        
        let methodLabel = 'Tunai';
        if (selectedPaymentMethod === 'kartu') methodLabel = 'Debit / Kredit';
        if (selectedPaymentMethod === 'qris') methodLabel = 'QRIS Mandiri';
        
        // Add transaction to active session history log
        const transactionRecord = {
            invoice: invoiceNo,
            time: dateStr,
            cashier: cashierName,
            method: methodLabel,
            total: grandTotal,
            paid: paid,
            change: change,
            items: cart.map(i => ({ name: i.product.name, qty: i.quantity, price: i.product.price }))
        };
        transactions.unshift(transactionRecord); // prepend
        
        // Recalculate Dashboard statistics & update widgets
        updateDashboardWidgets();
        updateTransactionsListTable();
        
        // Generate visual HTML print receipt
        populateThermalReceipt(transactionRecord, subtotal, tax);
        
        // Reset POS state
        cart = [];
        updateCartUI();
        renderProductCatalog(); // refreshes card stocks
        
        // Modal management toggle
        closeCheckoutModal();
        
        // Reset button
        processBtn.innerHTML = origBtnContent;
        
        // Show receipt overlay
        document.getElementById('receipt-modal').classList.add('active');
        
    }, 800);
}

function populateThermalReceipt(trx, subtotal, tax) {
    document.getElementById('receipt-invoice').textContent = trx.invoice;
    document.getElementById('receipt-cashier').textContent = trx.cashier;
    document.getElementById('receipt-time').textContent = trx.time;
    
    document.getElementById('receipt-subtotal').textContent = formatRupiah(subtotal);
    document.getElementById('receipt-tax').textContent = formatRupiah(tax);
    document.getElementById('receipt-total').textContent = formatRupiah(trx.total);
    
    document.getElementById('receipt-method').textContent = trx.method;
    document.getElementById('receipt-paid').textContent = formatRupiah(trx.paid);
    document.getElementById('receipt-change').textContent = formatRupiah(trx.change);
    
    // Items table list
    const container = document.getElementById('receipt-items-list');
    container.innerHTML = '';
    
    trx.items.forEach(item => {
        const itemRow = document.createElement('div');
        itemRow.className = 'receipt-row';
        itemRow.style.fontSize = '12px';
        itemRow.style.margin = '4px 0';
        itemRow.innerHTML = `
            <div>
                <span>${item.name}</span><br>
                <span style="color: #64748b">${item.qty} x ${formatRupiah(item.price)}</span>
            </div>
            <div style="text-align: right; vertical-align: bottom;">
                ${formatRupiah(item.qty * item.price)}
            </div>
        `;
        container.appendChild(itemRow);
    });
}

function closeReceiptModal() {
    const modal = document.getElementById('receipt-modal');
    if (modal) modal.classList.remove('active');
}

// 8. Reactive Live Dashboard Controller
function updateDashboardWidgets() {
    // A. Revenue computation
    let totalRevenue = 0;
    transactions.forEach(t => totalRevenue += t.total);
    
    const revenueWidget = document.querySelector('.metrics-row .metric-card:nth-child(1) h2');
    if (revenueWidget) revenueWidget.textContent = formatRupiah(totalRevenue);
    
    // B. Transaction counter
    const countWidget = document.querySelector('.metrics-row .metric-card:nth-child(2) h2');
    if (countWidget) countWidget.textContent = `${transactions.length} Transaksi`;
    
    // C. Low stock calculation
    const lowStockCount = products.filter(p => p.stock < 10).length;
    const stockWidget = document.querySelector('.metrics-row .metric-card:nth-child(3) h2');
    if (stockWidget) stockWidget.textContent = `${lowStockCount} Produk`;
    
    const stockTrend = document.querySelector('.metrics-row .metric-card:nth-child(3) .trend');
    if (stockTrend) {
        if (lowStockCount > 0) {
            stockTrend.className = 'trend down';
            stockTrend.innerHTML = `<ion-icon name="warning-outline"></ion-icon> Membutuhkan restock segera`;
        } else {
            stockTrend.className = 'trend up';
            stockTrend.innerHTML = `<ion-icon name="checkmark-outline"></ion-icon> Stok aman terkendali`;
        }
    }
    
    // D. Low Stock Alerts side card list
    const warningList = document.querySelector('.warning-list-card .card-body');
    const warningCount = document.querySelector('.warning-list-card .warning-count');
    
    if (warningCount) warningCount.textContent = `${lowStockCount} Terdeteksi`;
    
    if (warningList) {
        const lowStockItems = products.filter(p => p.stock < 10);
        if (lowStockItems.length === 0) {
            warningList.innerHTML = `
                <div class="empty-state-small">
                    <ion-icon name="checkmark-done-circle-outline" style="font-size: 32px; color: var(--color-success);"></ion-icon>
                    <p style="font-size: 12px; margin-top: 4px;">Hebat! Seluruh stok produk mencukupi.</p>
                </div>
            `;
        } else {
            let listHtml = `<ul class="warning-products-list">`;
            lowStockItems.forEach(p => {
                const stockLevelClass = p.stock === 0 ? 'danger-level' : 'warning-level';
                listHtml += `
                    <li>
                        <div class="item-meta">
                            <h4>${p.name}</h4>
                            <span>SKU: ${p.sku}</span>
                        </div>
                        <div class="item-stock ${stockLevelClass}">
                            <span>Sisa: <strong>${p.stock}</strong></span>
                        </div>
                    </li>
                `;
            });
            listHtml += `</ul>`;
            warningList.innerHTML = listHtml;
        }
    }
    
    // E. Recent Transaction Activity list on the Dashboard home
    const recentTableBody = document.querySelector('.dashboard-full-row .data-table tbody');
    if (recentTableBody) {
        recentTableBody.innerHTML = '';
        
        // Take latest 5 transactions
        const sliceTrx = transactions.slice(0, 5);
        
        if (sliceTrx.length === 0) {
            recentTableBody.innerHTML = `
                <tr>
                    <td colspan="6" style="text-align: center; padding: 24px;">
                        Belum ada aktivitas transaksi tercatat hari ini.
                    </td>
                </tr>
            `;
        } else {
            sliceTrx.forEach(t => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><strong>${t.invoice}</strong></td>
                    <td>${t.time}</td>
                    <td>${t.cashier}</td>
                    <td><span class="pill-method">${t.method}</span></td>
                    <td><strong>${formatRupiah(t.total)}</strong></td>
                    <td><span class="pill-status success">Sukses</span></td>
                `;
                recentTableBody.appendChild(row);
            });
        }
    }
    updateWeeklyChart();
}

// 9. Advanced Reports Filtering & Metrics
let editingProductId = null;

function getCategoryName(slug) {
    const cat = categories.find(c => c.slug === slug);
    return cat ? cat.name : slug;
}

function parseTrxDate(dateStr) {
    const cleanStr = dateStr.replace(/,/g, '');
    const parts = cleanStr.split(' ');
    const dateParts = parts[0].split('/');
    const day = parseInt(dateParts[0]) || 1;
    const month = (parseInt(dateParts[1]) || 1) - 1; // 0-indexed month
    const year = parseInt(dateParts[2]) || 2026;
    
    let hour = 0;
    let minute = 0;
    let second = 0;
    if (parts[1]) {
        const timeParts = parts[1].split(':');
        hour = parseInt(timeParts[0]) || 0;
        minute = parseInt(timeParts[1]) || 0;
        second = parseInt(timeParts[2]) || 0;
    }
    return new Date(year, month, day, hour, minute, second);
}

function matchesPeriod(date, period) {
    const trxYear = date.getFullYear();
    const trxMonth = date.getMonth(); // 0-indexed, 4 = May
    const trxDay = date.getDate();
    
    if (period === 'semua') return true;
    if (period === 'hari-ini') {
        return trxYear === 2026 && trxMonth === 4 && trxDay === 21;
    }
    if (period === 'kemarin') {
        return trxYear === 2026 && trxMonth === 4 && trxDay === 20;
    }
    if (period === 'pekan-ini') {
        // May 15-21, 2026
        const start = new Date(2026, 4, 15, 0, 0, 0);
        const end = new Date(2026, 4, 21, 23, 59, 59);
        return date >= start && date <= end;
    }
    if (period === 'bulan-ini') {
        // May 1-21, 2026
        const start = new Date(2026, 4, 1, 0, 0, 0);
        const end = new Date(2026, 4, 21, 23, 59, 59);
        return date >= start && date <= end;
    }
    return true;
}

function renderFilteredHistory() {
    const tableBody = document.querySelector('#transactions-table tbody');
    const emptyState = document.getElementById('trx-empty-state');
    const tableContainer = document.getElementById('transactions-table');
    
    if (!tableBody) return;
    
    const query = document.getElementById('trx-search')?.value.trim().toLowerCase() || '';
    const period = document.getElementById('report-period-filter')?.value || 'semua';
    const payment = document.getElementById('report-payment-filter')?.value || 'semua';
    
    // Filter the transaction history array
    const filtered = transactions.filter(t => {
        // Matches query on Invoice number
        const matchesQuery = t.invoice.toLowerCase().includes(query);
        
        // Matches payment method
        const matchesPayment = payment === 'semua' || t.method === payment;
        
        // Matches period
        const date = parseTrxDate(t.time);
        const matchesDate = matchesPeriod(date, period);
        
        return matchesQuery && matchesPayment && matchesDate;
    });
    
    // Render filtered rows
    tableBody.innerHTML = '';
    
    if (filtered.length === 0) {
        if (emptyState) emptyState.style.display = 'flex';
        if (tableContainer) tableContainer.style.display = 'none';
        
        // Update metrics to 0
        document.getElementById('report-total-revenue').textContent = 'Rp 0';
        document.getElementById('report-total-count').textContent = '0 Struk';
        document.getElementById('report-avg-amount').textContent = 'Rp 0';
        return;
    }
    
    if (emptyState) emptyState.style.display = 'none';
    if (tableContainer) tableContainer.style.display = 'table';
    
    let totalRevenue = 0;
    
    filtered.forEach(t => {
        totalRevenue += t.total;
        
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><strong>${t.invoice}</strong></td>
            <td>${t.time}</td>
            <td>${t.cashier}</td>
            <td><span class="pill-method">${t.method}</span></td>
            <td><strong>${formatRupiah(t.total)}</strong></td>
            <td>${formatRupiah(t.paid)}</td>
            <td>${formatRupiah(t.change)}</td>
            <td><span class="pill-status success">Sukses</span></td>
        `;
        tableBody.appendChild(row);
    });
    
    // Update metrics
    const totalCount = filtered.length;
    const avgAmount = Math.round(totalRevenue / totalCount);
    
    document.getElementById('report-total-revenue').textContent = formatRupiah(totalRevenue);
    document.getElementById('report-total-count').textContent = `${totalCount} Struk`;
    document.getElementById('report-avg-amount').textContent = formatRupiah(avgAmount);
}

function updateTransactionsListTable() {
    renderFilteredHistory();
}

function updateWeeklyChart() {
    const chartSvg = document.querySelector('.custom-svg-chart');
    if (!chartSvg) return;
    
    // Compute daily totals for Mon May 18 to Sun May 24, 2026
    const dailyTotals = [0, 0, 0, 0, 0, 0, 0]; // Index 0: Sen (18 May), 1: Sel (19 May), ...
    
    transactions.forEach(t => {
        const date = parseTrxDate(t.time);
        if (date.getFullYear() === 2026 && date.getMonth() === 4) { // May
            const day = date.getDate();
            if (day >= 18 && day <= 24) {
                const index = day - 18;
                if (index >= 0 && index < 7) {
                    dailyTotals[index] += t.total;
                }
            }
        }
    });
    
    const maxVal = Math.max(150000, ...dailyTotals) * 1.15; // padding top
    const getY = (val) => 180 - (val / maxVal) * 140;
    
    const xCoords = [40, 110, 180, 250, 320, 390, 460];
    const points = xCoords.map((x, i) => ({ x, y: getY(dailyTotals[i]) }));
    
    // Build path string for area and line
    let linePath = `M ${points[0].x},${points[0].y}`;
    for (let i = 1; i < points.length; i++) {
        linePath += ` L ${points[i].x},${points[i].y}`;
    }
    
    let areaPath = `${linePath} L ${points[points.length - 1].x},180 L ${points[0].x},180 Z`;
    
    let circlesHtml = '';
    points.forEach((p, idx) => {
        circlesHtml += `
            <g class="chart-point-group" style="cursor: pointer;">
                <circle cx="${p.x}" cy="${p.y}" r="6" fill="#10b981" stroke="#ffffff" stroke-width="2" />
                <title>Omzet: ${formatRupiah(dailyTotals[idx])}</title>
            </g>
        `;
    });
    
    chartSvg.innerHTML = `
        <defs>
            <linearGradient id="chart-grad" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="#10b981" stop-opacity="0.35"/>
                <stop offset="100%" stop-color="#10b981" stop-opacity="0"/>
            </linearGradient>
        </defs>
        <!-- Grid Lines -->
        <line x1="0" y1="40" x2="500" y2="40" stroke="#f1f5f9" stroke-width="1" />
        <line x1="0" y1="90" x2="500" y2="90" stroke="#f1f5f9" stroke-width="1" />
        <line x1="0" y1="140" x2="500" y2="140" stroke="#f1f5f9" stroke-width="1" />
        <line x1="0" y1="180" x2="500" y2="180" stroke="#e2e8f0" stroke-width="2" />
        
        <!-- Area Fill -->
        <path d="${areaPath}" fill="url(#chart-grad)" />
        <!-- Line Plot -->
        <path d="${linePath}" fill="none" stroke="#10b981" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
        
        <!-- Data Points -->
        ${circlesHtml}
    `;
}

function simulateExport() {
    playSound('double-beep');
    const modal = document.getElementById('export-success-modal');
    if (modal) {
        modal.classList.add('active');
    }
}

// 10. Management Products CRUD Reactive Logic
function renderCRUDTable() {
    const tableBody = document.querySelector('#crud-products-table tbody');
    const emptyState = document.getElementById('crud-empty-state');
    const tableContainer = document.getElementById('crud-products-table');
    
    if (!tableBody) return;
    
    const query = document.getElementById('crud-product-search')?.value.trim().toLowerCase() || '';
    const category = document.getElementById('crud-category-filter')?.value || 'all';
    
    // Filter product array
    const filtered = products.filter(p => {
        const matchesCategory = category === 'all' || p.category === category;
        const matchesSearch = p.name.toLowerCase().includes(query) || p.sku.toLowerCase().includes(query);
        return matchesCategory && matchesSearch;
    });
    
    tableBody.innerHTML = '';
    
    if (filtered.length === 0) {
        if (emptyState) emptyState.style.display = 'flex';
        if (tableContainer) tableContainer.style.display = 'none';
        return;
    }
    
    if (emptyState) emptyState.style.display = 'none';
    if (tableContainer) tableContainer.style.display = 'table';
    
    filtered.forEach(p => {
        const row = document.createElement('tr');
        
        let badgeClass = 'success';
        let badgeText = `Aman (${p.stock})`;
        if (p.stock === 0) {
            badgeClass = 'danger';
            badgeText = 'Habis';
        } else if (p.stock < 10) {
            badgeClass = 'warning';
            badgeText = `Menipis (${p.stock})`;
        }
        
        row.innerHTML = `
            <td><strong>${p.sku}</strong></td>
            <td>${p.name}</td>
            <td><span class="pill-method">${getCategoryName(p.category)}</span></td>
            <td><strong>${formatRupiah(p.price)}</strong></td>
            <td><strong>${p.stock}</strong></td>
            <td><span class="stock-badge-crud ${badgeClass}">${badgeText}</span></td>
            <td>
                <div class="crud-actions-cell">
                    <button class="btn btn-outline btn-small btn-edit" data-id="${p.id}" style="padding: 6px 10px; border-color: var(--color-primary); color: var(--color-primary);">
                        <ion-icon name="create-outline"></ion-icon>
                    </button>
                    <button class="btn btn-outline btn-small btn-delete" data-id="${p.id}" style="padding: 6px 10px; border-color: var(--color-danger); color: var(--color-danger);">
                        <ion-icon name="trash-outline"></ion-icon>
                    </button>
                </div>
            </td>
        `;
        
        // Add direct event listeners to edit and delete buttons
        row.querySelector('.btn-edit').addEventListener('click', () => openProductModal(p.id));
        row.querySelector('.btn-delete').addEventListener('click', () => deleteProduct(p.id));
        
        tableBody.appendChild(row);
    });
}

function openProductModal(productId = null) {
    editingProductId = productId;
    const modal = document.getElementById('product-modal');
    if (!modal) return;
    
    const titleEl = document.getElementById('preview-modal-title');
    
    if (productId === null) {
        if (titleEl) titleEl.textContent = 'Tambah Produk Baru';
        
        // Reset inputs
        document.getElementById('preview-prod-name').value = '';
        document.getElementById('preview-prod-sku').value = '';
        document.getElementById('preview-prod-category').value = '';
        document.getElementById('preview-prod-price').value = '';
        document.getElementById('preview-prod-stock').value = '';
        document.getElementById('preview-prod-icon').value = 'restaurant-outline';
    } else {
        if (titleEl) titleEl.textContent = 'Edit Produk';
        
        const p = products.find(prod => prod.id === productId);
        if (p) {
            document.getElementById('preview-prod-name').value = p.name;
            document.getElementById('preview-prod-sku').value = p.sku;
            document.getElementById('preview-prod-category').value = p.category;
            document.getElementById('preview-prod-price').value = p.price;
            document.getElementById('preview-prod-stock').value = p.stock;
            document.getElementById('preview-prod-icon').value = p.icon;
        }
    }
    
    modal.classList.add('active');
    playSound('beep');
}

function closeProductModal() {
    const modal = document.getElementById('product-modal');
    if (modal) modal.classList.remove('active');
}

function saveProduct() {
    const name = document.getElementById('preview-prod-name').value.trim();
    let sku = document.getElementById('preview-prod-sku').value.trim().toUpperCase();
    const category = document.getElementById('preview-prod-category').value;
    const priceVal = document.getElementById('preview-prod-price').value;
    const stockVal = document.getElementById('preview-prod-stock').value;
    const icon = document.getElementById('preview-prod-icon').value;
    
    const price = parseInt(priceVal);
    const stock = parseInt(stockVal);
    
    // Validation
    if (!name || !category || isNaN(price) || price < 0 || isNaN(stock) || stock < 0) {
        playSound('error');
        alert('Harap isi semua kolom yang berbintang (*) dengan benar dan bernilai positif!');
        return;
    }
    
    // Auto SKU generation
    if (!sku) {
        let prefix = 'PRD';
        if (category === 'makanan-utama') prefix = 'MKN';
        else if (category === 'minuman-dingin') prefix = 'MIN';
        else if (category === 'kopi-teh') prefix = 'KOP';
        else if (category === 'camilan-dessert') prefix = 'CAM';
        else if (category === 'paket-hemat') prefix = 'PKT';
        
        sku = `${prefix}-${name.substring(0, 3).toUpperCase().replace(/[^A-Z]/g, '')}-${Math.floor(100 + Math.random() * 900)}`;
    }
    
    // Duplicate SKU check
    const duplicate = products.find(p => p.sku === sku && p.id !== editingProductId);
    if (duplicate) {
        playSound('error');
        alert('SKU sudah digunakan oleh produk lain! Harap gunakan SKU yang unik.');
        return;
    }
    
    if (editingProductId !== null) {
        // Edit mode
        const p = products.find(prod => prod.id === editingProductId);
        if (p) {
            p.name = name;
            p.sku = sku;
            p.category = category;
            p.price = price;
            p.stock = stock;
            p.icon = icon;
            
            // Sync with active cashier cart
            const cartItem = cart.find(item => item.product.id === editingProductId);
            if (cartItem) {
                cartItem.product.name = name;
                cartItem.product.price = price;
                cartItem.product.stock = stock;
                
                // Cap qty if stock is now lower
                cartItem.quantity = Math.min(cartItem.quantity, stock);
                if (stock === 0) {
                    cart = cart.filter(item => item.product.id !== editingProductId);
                }
            }
        }
    } else {
        // Add mode
        const nextId = products.reduce((max, prod) => Math.max(max, prod.id), 0) + 1;
        products.push({
            id: nextId,
            category,
            name,
            sku,
            price,
            stock,
            icon
        });
    }
    
    playSound('double-beep');
    closeProductModal();
    renderCRUDTable();
    renderProductCatalog();
    updateCartUI();
    updateDashboardWidgets();
}

function deleteProduct(productId) {
    const p = products.find(prod => prod.id === productId);
    if (!p) return;
    
    if (confirm(`Apakah Anda yakin ingin menghapus produk '${p.name}' dari sistem?`)) {
        products = products.filter(prod => prod.id !== productId);
        
        // Remove from cart if present
        cart = cart.filter(item => item.product.id !== productId);
        
        playSound('error');
        renderCRUDTable();
        renderProductCatalog();
        updateCartUI();
        updateDashboardWidgets();
    }
}

// 11. SPA View Switcher Navigation Handler
function switchView(viewName) {
    const sections = {
        dashboard: document.querySelector('.dashboard-section'),
        cashier: document.querySelector('.pos-section'),
        history: document.querySelector('.history-section'),
        products: document.querySelector('.products-crud-section')
    };
    
    // Toggle Section visibility
    Object.keys(sections).forEach(key => {
        if (sections[key]) {
            if (key === viewName) {
                sections[key].style.display = 'block';
            } else {
                sections[key].style.display = 'none';
            }
        }
    });
    
    // Update active state in sidebar navigation links
    document.querySelectorAll('.sidebar-menu .menu-item').forEach(link => {
        link.classList.remove('active');
    });
    
    const activeLink = document.getElementById(`menu-${viewName}`);
    if (activeLink) activeLink.classList.add('active');
    
    playSound('beep');
}

// 12. Initializer on DOM Content Loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initial catalogs
    renderProductCatalog();
    updateCartUI();
    updateDashboardWidgets();
    updateTransactionsListTable();
    renderCRUDTable();
    
    // A. View Switching Listeners
    const navItems = [
        { id: 'menu-dashboard', view: 'dashboard' },
        { id: 'menu-cashier', view: 'cashier' },
        { id: 'menu-transactions', view: 'history' },
        { id: 'menu-products', view: 'products' }
    ];
    
    navItems.forEach(item => {
        const elem = document.getElementById(item.id);
        if (elem) {
            elem.addEventListener('click', (e) => {
                e.preventDefault();
                switchView(item.view);
            });
        }
    });
    
    // Ensure default dashboard section is shown
    switchView('dashboard');
    
    // B. Search Box listener
    const searchBox = document.getElementById('product-search');
    if (searchBox) {
        searchBox.addEventListener('input', (e) => {
            searchQuery = e.target.value;
            renderProductCatalog();
        });
    }
    
    // C. Category Buttons filter listener
    const filterContainer = document.querySelector('.category-filters');
    if (filterContainer) {
        filterContainer.addEventListener('click', (e) => {
            const btn = e.target.closest('.category-btn');
            if (!btn) return;
            
            filterContainer.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            activeCategory = btn.getAttribute('data-category');
            renderProductCatalog();
            playSound('beep');
        });
    }
    
    // D. Cart Header action listener
    const clearBtn = document.getElementById('clear-cart-btn');
    if (clearBtn) clearBtn.addEventListener('click', clearCart);
    
    const checkoutBtn = document.getElementById('checkout-btn');
    if (checkoutBtn) checkoutBtn.addEventListener('click', openCheckoutModal);
    
    // E. Payment Modal listener actions
    const closePaymentBtn = document.getElementById('close-payment-modal');
    if (closePaymentBtn) closePaymentBtn.addEventListener('click', closeCheckoutModal);
    
    const cancelCheckoutBtn = document.getElementById('cancel-checkout-btn');
    if (cancelCheckoutBtn) cancelCheckoutBtn.addEventListener('click', closeCheckoutModal);
    
    const processCheckoutBtn = document.getElementById('process-checkout-btn');
    if (processCheckoutBtn) processCheckoutBtn.addEventListener('click', processTransaction);
    
    // Payment toggles Card/QRIS/Cash
    document.querySelectorAll('.method-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            setPaymentMethod(btn.getAttribute('data-method'));
        });
    });
    
    // Quick cash buttons
    document.querySelectorAll('.quick-cash-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const amount = btn.getAttribute('data-amount');
            if (amount) {
                setQuickCash(parseInt(amount));
            } else if (btn.id === 'exact-cash-btn') {
                setQuickCash('pas');
            }
        });
    });
    
    // Numpad key triggers
    document.querySelectorAll('.numpad-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const val = btn.getAttribute('data-val');
            if (val) {
                handleNumpadInput(val);
                playSound('beep');
            }
        });
    });
    
    const backspaceBtn = document.getElementById('numpad-backspace');
    if (backspaceBtn) {
        backspaceBtn.addEventListener('click', () => {
            handleNumpadInput('backspace');
            playSound('error');
        });
    }
    
    // F. Receipt Modal close button
    const closeReceiptBtn = document.getElementById('close-receipt-btn');
    if (closeReceiptBtn) closeReceiptBtn.addEventListener('click', closeReceiptModal);
    
    // G. Transaction Invoice Search & Filter Listeners
    const trxSearch = document.getElementById('trx-search');
    if (trxSearch) {
        trxSearch.addEventListener('input', () => {
            renderFilteredHistory();
        });
    }
    
    const periodFilter = document.getElementById('report-period-filter');
    if (periodFilter) {
        periodFilter.addEventListener('change', () => {
            renderFilteredHistory();
            playSound('beep');
        });
    }
    
    const paymentFilter = document.getElementById('report-payment-filter');
    if (paymentFilter) {
        paymentFilter.addEventListener('change', () => {
            renderFilteredHistory();
            playSound('beep');
        });
    }
    
    const exportBtn = document.getElementById('btn-export-report');
    if (exportBtn) {
        exportBtn.addEventListener('click', () => {
            simulateExport();
        });
    }
    
    const closeExportBtn = document.getElementById('close-export-modal-btn');
    if (closeExportBtn) {
        closeExportBtn.addEventListener('click', () => {
            const modal = document.getElementById('export-success-modal');
            if (modal) modal.classList.remove('active');
            playSound('beep');
        });
    }
    
    // H. CRUD Product preview management UI Listeners
    const btnTambahPreview = document.getElementById('btn-tambah-produk-preview');
    if (btnTambahPreview) {
        btnTambahPreview.addEventListener('click', () => openProductModal(null));
    }
    
    const closeProdModalBtn = document.getElementById('close-product-modal-btn');
    if (closeProdModalBtn) {
        closeProdModalBtn.addEventListener('click', closeProductModal);
    }
    
    const closeProdModalCancel = document.getElementById('close-product-modal-cancel');
    if (closeProdModalCancel) {
        closeProdModalCancel.addEventListener('click', closeProductModal);
    }
    
    const saveProdBtn = document.getElementById('preview-product-save-btn');
    if (saveProdBtn) {
        saveProdBtn.addEventListener('click', saveProduct);
    }
    
    const crudSearchBox = document.getElementById('crud-product-search');
    if (crudSearchBox) {
        crudSearchBox.addEventListener('input', () => {
            renderCRUDTable();
        });
    }
    
    const crudCategoryFilter = document.getElementById('crud-category-filter');
    if (crudCategoryFilter) {
        crudCategoryFilter.addEventListener('change', () => {
            renderCRUDTable();
            playSound('beep');
        });
    }
});

// Map Global scopes so standard HTML onclick tags trigger functions successfully
window.updateCartQty = updateCartQty;
window.removeFromCart = removeFromCart;

// ==========================================================================
// 13. FITUR SCAN BARCODE (HARDWARE & WEBCAM CAMERA SCANNER)
// ==========================================================================

let html5QrcodeScannerInstance = null;
let barcodeBuffer = '';
let lastKeyTime = Date.now();

// Listener keyboard global untuk mendeteksi scanner fisik (keyboard emulator)
window.addEventListener('keydown', (e) => {
    // Abaikan jika fokus sedang berada pada form input produk baru/edit (kecuali input pencarian kasir)
    const activeEl = document.activeElement;
    if (activeEl && (activeEl.tagName === 'INPUT' || activeEl.tagName === 'TEXTAREA')) {
        if (activeEl.id !== 'product-search' && activeEl.id !== 'barcode-search-input') {
            return;
        }
    }

    const currentTime = Date.now();
    
    // Kecepatan ketik hardware barcode scanner biasanya sangat cepat (< 50ms per karakter)
    // Jika jeda waktu antarketikan > 150ms, anggap itu ketikan manual keyboard biasa, reset buffer
    if (currentTime - lastKeyTime > 150) {
        barcodeBuffer = '';
    }

    // Jika karakter berupa angka, masukkan ke buffer
    if (/^[0-9]$/.test(e.key)) {
        barcodeBuffer += e.key;
        lastKeyTime = currentTime;
    } else if (e.key === 'Enter') {
        // Scanner fisik biasanya mengirimkan tombol 'Enter' setelah selesai memindai
        if (barcodeBuffer.length >= 8) {
            e.preventDefault();
            handleBarcodeScanned(barcodeBuffer);
            barcodeBuffer = '';
        }
    }
});

// Penanganan Barcode yang Terdeteksi
function handleBarcodeScanned(barcode) {
    const matchedProduct = products.find(p => p.barcode === barcode || p.sku === barcode);
    
    if (matchedProduct) {
        if (matchedProduct.stock === 0) {
            playSound('error');
            showToastMessage(`Stok '${matchedProduct.name}' habis!`, 'error');
            return;
        }
        
        addToCart(matchedProduct);
        showToastMessage(`Barcode cocok! ${matchedProduct.name} dimasukkan.`);
    } else {
        playSound('error');
        showToastMessage(`Barcode ${barcode} tidak terdaftar!`, 'error');
    }
}

// Custom Toast Message yang Elegan
function showToastMessage(message, type = 'success') {
    const existingToast = document.querySelector('.pos-barcode-toast');
    if (existingToast) existingToast.remove();

    const toast = document.createElement('div');
    toast.className = `pos-barcode-toast ${type}`;
    
    const iconName = type === 'success' ? 'checkmark-circle' : 'alert-circle';
    const accentColor = type === 'success' ? 'var(--color-success)' : 'var(--color-danger)';
    
    toast.style.position = 'fixed';
    toast.style.bottom = '30px';
    toast.style.left = '50%';
    toast.style.transform = 'translateX(-50%) translateY(20px)';
    toast.style.backgroundColor = 'rgba(15, 23, 42, 0.95)';
    toast.style.border = `1px solid ${accentColor}`;
    toast.style.color = '#f8fafc';
    toast.style.padding = '12px 24px';
    toast.style.borderRadius = '12px';
    toast.style.boxShadow = '0 10px 25px rgba(0,0,0,0.5)';
    toast.style.display = 'flex';
    toast.style.alignItems = 'center';
    toast.style.gap = '10px';
    toast.style.zIndex = '99999';
    toast.style.opacity = '0';
    toast.style.transition = 'all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
    
    toast.innerHTML = `
        <ion-icon name="${iconName}" style="color: ${accentColor}; font-size: 20px;"></ion-icon>
        <span style="font-weight: 500; font-size: 14px;">${message}</span>
    `;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.style.transform = 'translateX(-50%) translateY(0)';
        toast.style.opacity = '1';
    }, 50);

    // Auto dismiss after 3 seconds
    setTimeout(() => {
        toast.style.transform = 'translateX(-50%) translateY(-20px)';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Logika Kamera Web Barcode Scanner
function openBarcodeCameraModal() {
    const modal = document.getElementById('barcode-camera-modal');
    if (!modal) return;
    
    modal.classList.add('active');
    playSound('beep');
    
    // Memulai scanner setelah modal aktif
    setTimeout(() => {
        startWebcamScanner();
    }, 300);
}

function closeBarcodeCameraModal() {
    const modal = document.getElementById('barcode-camera-modal');
    if (modal) modal.classList.remove('active');
    
    stopWebcamScanner();
}

function startWebcamScanner() {
    const readerElement = document.getElementById('barcode-scanner-reader');
    if (!readerElement) return;

    // Bersihkan instansi sebelumnya jika masih aktif
    if (html5QrcodeScannerInstance) {
        html5QrcodeScannerInstance.clear();
    }

    // Inisialisasi html5-qrcode
    html5QrcodeScannerInstance = new Html5Qrcode("barcode-scanner-reader");
    
    const config = { 
        fps: 20, 
        qrbox: { width: 280, height: 180 }, // Optimal box landscape untuk Barcode kemasan
        aspectRatio: 1.333334
    };

    html5QrcodeScannerInstance.start(
        { facingMode: "environment" }, // Kamera belakang jika di handphone
        config,
        (decodedText, decodedResult) => {
            // Callback sukses scan barcode
            handleBarcodeScanned(decodedText);
            closeBarcodeCameraModal();
        },
        (errorMessage) => {
            // Callback pencarian barcode gagal di frame (abaikan log untuk performa bersih)
        }
    ).catch(err => {
        console.error("Gagal memulai kamera scanner: ", err);
        readerElement.innerHTML = `
            <div style="padding: 20px; text-align: center; color: var(--color-danger);">
                <ion-icon name="videocam-off-outline" style="font-size: 48px; margin-bottom: 10px;"></ion-icon>
                <p style="font-size: 14px;">Kamera tidak terdeteksi atau izin ditolak!</p>
                <button onclick="window.startWebcamScanner()" style="margin-top:12px; padding: 8px 16px; border-radius: 6px; background: var(--color-primary); color: white; border: none; font-size:12px; cursor: pointer;">Ulangi Kamera</button>
            </div>
        `;
    });
}

function stopWebcamScanner() {
    if (html5QrcodeScannerInstance) {
        html5QrcodeScannerInstance.stop().then(() => {
            html5QrcodeScannerInstance.clear();
            html5QrcodeScannerInstance = null;
        }).catch(err => {
            console.warn("Gagal menghentikan kamera secara bersih:", err);
            html5QrcodeScannerInstance = null;
        });
    }
}

// Map ke global scope agar bisa diakses dari atribut onclick pada HTML
window.openBarcodeCameraModal = openBarcodeCameraModal;
window.closeBarcodeCameraModal = closeBarcodeCameraModal;
window.startWebcamScanner = startWebcamScanner;
