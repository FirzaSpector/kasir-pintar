<en>

Project Summary

Name & Summary: Smart Cashier — a Laravel-based Point-of-Sale (POS) system for product, inventory, and cashier transaction management.
Tech Stack

Backend: PHP 8.2, laravel/framework ^11.0 (see composer.json).
Frontend / Build: Vite, Tailwind CSS, Alpine.js, Axios (see package.json).
Testing & Dev: phpunit, laravel/breeze, laravel/tinker.
DB: Relational DB (usually MySQL/Postgres) via Eloquent.
Core Features

Product & Category Management: CRUD for products, categories, price attributes, and stock (Product.php).
POS / Checkout: Cart, stock validation, subtotal/total calculations, payment and change checks, stock deductions at checkout (TransactionService.php).
Transactions & Invoices: Unique invoice number generation (generateInvoiceNumber()), transaction and detail storage.
Modular Architecture: Repository + Service layer for separating business logic (Repositories, Services).
Auth & Role: Structure for authentication and roles (Auth folder, Role.php).
Interactive Frontend: Fast UI for POS using Tailwind + Alpine + Vite, and API communication via Axios.

Architecture & Notable Patterns
MVC (Laravel): Controllers → Models → Views.
Repository Pattern: Data access is separated through an interface/repository for testability.
Service Layer: Transaction logic and business processes are placed in services (atomic DB transactions, rollback on error).
Example files: TransactionService.php, Product.php.

Quick Setup (development)

Run:
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
php artisan serve
<id>

Project Summary

Nama & Ringkas: Kasir Pintar — sistem Point-of-Sale (POS) berbasis Laravel untuk manajemen produk, stok, dan transaksi kasir.
Tech Stack

Backend: PHP 8.2, laravel/framework ^11.0 (lihat composer.json).
Frontend / Build: Vite, Tailwind CSS, Alpine.js, Axios (lihat package.json).
Testing & Dev: phpunit, laravel/breeze, laravel/tinker.
DB: Relational DB (umumnya MySQL/Postgres) via Eloquent.
Core Features

Manajemen Produk & Kategori: CRUD produk, kategori, atribut harga & stok (Product.php).
POS / Checkout: Keranjang, validasi stok, perhitungan subtotal/total, cek pembayaran dan kembalian, pengurangan stok saat checkout (TransactionService.php).
Transaksi & Invoice: Pembuatan nomor invoice unik (generateInvoiceNumber()), penyimpanan transaksi + detail.
Arsitektur Modular: Repository + Service layer untuk pemisahan logika bisnis (Repositories, Services).
Auth & Role: Struktur untuk otentikasi dan role (folder Auth, Role.php).
Frontend interaktif: UI cepat untuk POS menggunakan Tailwind + Alpine + Vite, dan komunikasi API via Axios.

Architecture & Notable Patterns
MVC (Laravel): Controllers → Models → Views.
Repository Pattern: Akses data dipisah lewat interface/repository untuk testabilitas.
Service Layer: Logika transaksi dan proses bisnis ditempatkan di service (atomic DB transaction, rollback on error).
Contoh file: TransactionService.php, Product.php.

Quick Setup (development)

Jalankan:
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
php artisan serve
