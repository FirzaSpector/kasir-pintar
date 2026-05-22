<div align="center">
  <h1>🛒 Kasir Pintar (Smart Cashier)</h1>
  <p><strong>A Modern, Fast, and Reliable Point-of-Sale (POS) System built with Laravel & Alpine.js</strong></p>
</div>

---

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel"/>
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"/>
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS"/>
  <img src="https://img.shields.io/badge/Vite-B73BFE?style=for-the-badge&logo=vite&logoColor=FFD62E" alt="Vite"/>
  <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine.js"/>
</p>

## 📖 English / [Bahasa Indonesia](#-bahasa-indonesia)

### 🚀 Overview
**Kasir Pintar** (Smart Cashier) is a robust and modular POS system designed to streamline product management, inventory tracking, and checkout processes. Built with a solid repository-service architecture, it ensures clean business logic separation, making it highly maintainable and scalable.

### 🛠 Tech Stack
- **Backend**: PHP 8.2, Laravel 11.x
- **Frontend**: Vite, Tailwind CSS, Alpine.js, Axios
- **Testing**: PHPUnit, Laravel Breeze for scaffolding
- **Database**: Relational Database (MySQL/PostgreSQL) via Eloquent ORM

### ✨ Core Features
- 📦 **Product & Category Management**: Seamless CRUD operations for products, categories, dynamic pricing, and stock monitoring.
- 💳 **POS Checkout System**: Real-time cart management, stock validation, auto-calculations (subtotal/total/change), and dynamic stock deductions.
- 🧾 **Transactions & Invoicing**: Automated unique invoice generation with robust transaction data tracking.
- 🏗 **Modular Architecture**: Uses **Repository Pattern** for data access and **Service Layer** for complex business logic (e.g., atomic DB transactions, rollback mechanisms).
- 🔐 **Auth & Roles**: Secure authentication system with role-based access control.

### 💻 Quick Setup
To run this project locally:

```bash
# 1. Install Dependencies
composer install
npm install

# 2. Environment Setup
cp .env.example .env
php artisan key:generate

# 3. Database Setup (Ensure your DB is created and configured in .env)
php artisan migrate --seed

# 4. Run Development Servers
npm run dev
php artisan serve
```

---

## 🇮🇩 Bahasa Indonesia

### 🚀 Gambaran Umum
**Kasir Pintar** adalah sistem Point-of-Sale (POS) yang tangguh dan modular, dirancang untuk mempermudah manajemen produk, pelacakan inventaris, dan proses checkout (kasir). Dibangun dengan arsitektur *repository-service* yang solid untuk memisahkan logika bisnis, sehingga mudah dikelola dan dikembangkan.

### 🛠 Teknologi yang Digunakan
- **Backend**: PHP 8.2, Laravel 11.x
- **Frontend**: Vite, Tailwind CSS, Alpine.js, Axios
- **Testing**: PHPUnit, Laravel Breeze
- **Database**: Relational Database (MySQL/PostgreSQL) melalui Eloquent ORM

### ✨ Fitur Utama
- 📦 **Manajemen Produk & Kategori**: Operasi CRUD untuk produk, kategori, harga dinamis, dan pemantauan stok.
- 💳 **Sistem Checkout POS**: Manajemen keranjang *real-time*, validasi stok, perhitungan otomatis (subtotal/total/kembalian), dan pengurangan stok otomatis.
- 🧾 **Transaksi & Invoice**: Pembuatan nomor invoice unik secara otomatis beserta riwayat transaksi yang detail.
- 🏗 **Arsitektur Modular**: Menggunakan **Repository Pattern** untuk akses data dan **Service Layer** untuk logika bisnis (seperti *atomic DB transactions* dan *rollback*).
- 🔐 **Autentikasi & Hak Akses**: Sistem login aman dilengkapi kontrol akses berbasis peran (Role).

### 💻 Panduan Instalasi
Untuk menjalankan proyek ini di lingkungan lokal Anda:

```bash
# 1. Install Dependencies
composer install
npm install

# 2. Pengaturan Environment
cp .env.example .env
php artisan key:generate

# 3. Pengaturan Database (Pastikan DB sudah dibuat dan di-set di .env)
php artisan migrate --seed

# 4. Jalankan Server Development
npm run dev
php artisan serve
```
