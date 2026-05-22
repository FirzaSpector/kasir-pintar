# Kasir Pintar (POS) - Struktur Folder Laravel

Struktur folder awal untuk aplikasi kasir pintar menggunakan Laravel dan PHP.

## Struktur Direktori

- app
  - Console
  - Enums
  - Exceptions
  - Http
    - Controllers
      - Auth
      - API
      - POS
    - Middleware
    - Requests
  - Models
  - Policies
  - Providers
  - Repositories
  - Services
  - Traits
- bootstrap
- config
- database
  - factories
  - migrations
  - seeders
- lang
- public
- resources
  - js
  - css
  - images
  - views
    - layouts
    - auth
    - dashboard
    - pos
- routes
- storage
  - app
  - framework
    - cache
    - sessions
    - views
  - logs
- tests
  - Feature
  - Unit

## Catatan

- `app/Http/Controllers/POS` dapat digunakan untuk semua controller point-of-sale.
- `app/Repositories`, `app/Services`, dan `app/Enums` membantu memisahkan logika bisnis dan membuat kode lebih modular.
- `resources/views/pos` untuk tampilan POS seperti kasir, transaksi, dan laporan.
- `routes` untuk file routing Laravel (`web.php`, `api.php`, dll.).
