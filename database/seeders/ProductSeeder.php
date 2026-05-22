<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $minumanSegar = Category::where('slug', 'minuman-segar')->first();
        $makananRingan = Category::where('slug', 'makanan-ringan-camilan')->first();
        $makananInstan = Category::where('slug', 'makanan-instan')->first();
        $sembako = Category::where('slug', 'bahan-pokok-sembako')->first();
        $olahanSusuRoti = Category::where('slug', 'produk-olahan-susu-roti')->first();
        $rambutTubuh = Category::where('slug', 'perawatan-rambut-tubuh')->first();
        $wajahKulit = Category::where('slug', 'perawatan-wajah-kulit')->first();
        $sanitasi = Category::where('slug', 'kebutuhan-sanitasi')->first();
        $wewangian = Category::where('slug', 'wewangian')->first();
        $pencuciPakaian = Category::where('slug', 'pencuci-pakaian')->first();
        $pembersihRumah = Category::where('slug', 'pembersih-rumah')->first();
        $pengendaliHama = Category::where('slug', 'pengendali-hama')->first();
        $kebutuhanBayi = Category::where('slug', 'kebutuhan-bayi')->first();
        $kesehatan = Category::where('slug', 'produk-kesehatan-ringan')->first();
        $imbuhan = Category::where('slug', 'kebutuhan-imbuhan')->first();

        // 1. Minuman Segar
        Product::create([
            'category_id' => $minumanSegar->id,
            'name' => 'Air Mineral Aqua 600ml',
            'sku' => 'MIN-AQUA-001',
            'price' => 3500,
            'stock' => 150,
            'image' => 'aqua.jpg',
        ]);
        Product::create([
            'category_id' => $minumanSegar->id,
            'name' => 'Teh Botol Sosro 450ml',
            'sku' => 'MIN-SOSRO-002',
            'price' => 5500,
            'stock' => 80,
            'image' => 'sosro.jpg',
        ]);
        Product::create([
            'category_id' => $minumanSegar->id,
            'name' => 'Susu UHT Ultra Milk Chocolate 250ml',
            'sku' => 'MIN-ULTRA-003',
            'price' => 6500,
            'stock' => 60,
            'image' => 'ultra.jpg',
        ]);
        Product::create([
            'category_id' => $minumanSegar->id,
            'name' => 'Coca-Cola 390ml',
            'sku' => 'MIN-COKE-004',
            'price' => 6000,
            'stock' => 40,
            'image' => 'coca_cola.jpg',
        ]);

        // 2. Makanan Ringan
        Product::create([
            'category_id' => $makananRingan->id,
            'name' => 'Keripik Singkong Kusuka Barbeque 60g',
            'sku' => 'CAM-KUSUKA-001',
            'price' => 9500,
            'stock' => 50,
            'image' => 'kusuka.jpg',
        ]);
        Product::create([
            'category_id' => $makananRingan->id,
            'name' => 'Biskuit Roma Kelapa 300g',
            'sku' => 'CAM-ROMA-002',
            'price' => 11500,
            'stock' => 40,
            'image' => 'roma.jpg',
        ]);
        Product::create([
            'category_id' => $makananRingan->id,
            'name' => 'Cokelat Silverqueen Almond 58g',
            'sku' => 'CAM-SILVER-003',
            'price' => 16000,
            'stock' => 5, // low stock!
            'image' => 'silverqueen.jpg',
        ]);

        // 3. Makanan Instan
        Product::create([
            'category_id' => $makananInstan->id,
            'name' => 'Indomie Goreng Spesial',
            'sku' => 'INS-INDOMIE-001',
            'price' => 3500,
            'stock' => 200,
            'image' => 'indomie.jpg',
        ]);
        Product::create([
            'category_id' => $makananInstan->id,
            'name' => 'Sarden ABC Saus Cabai 155g',
            'sku' => 'INS-SARDEN-002',
            'price' => 12500,
            'stock' => 30,
            'image' => 'sarden.jpg',
        ]);

        // 4. Bahan Pokok & Sembako
        Product::create([
            'category_id' => $sembako->id,
            'name' => 'Beras Anak Raja Premium 5kg',
            'sku' => 'SBK-BERAS-001',
            'price' => 74500,
            'stock' => 20,
            'image' => 'beras.jpg',
        ]);
        Product::create([
            'category_id' => $sembako->id,
            'name' => 'Minyak Goreng Bimoli Refill 1L',
            'sku' => 'SBK-MINYAK-002',
            'price' => 19500,
            'stock' => 35,
            'image' => 'minyak.jpg',
        ]);
        Product::create([
            'category_id' => $sembako->id,
            'name' => 'Gula Pasir Gulaku Premium 1kg',
            'sku' => 'SBK-GULA-003',
            'price' => 17500,
            'stock' => 50,
            'image' => 'gulaku.jpg',
        ]);

        // 5. Produk Olahan Susu & Roti
        Product::create([
            'category_id' => $olahanSusuRoti->id,
            'name' => 'Roti Tawar Sari Roti Premium',
            'sku' => 'ROT-SARIRTI-001',
            'price' => 15000,
            'stock' => 8, // low stock!
            'image' => 'rotitawar.jpg',
        ]);
        Product::create([
            'category_id' => $olahanSusuRoti->id,
            'name' => 'Keju Kraft Cheddar 165g',
            'sku' => 'ROT-KRAFT-002',
            'price' => 22000,
            'stock' => 25,
            'image' => 'keju.jpg',
        ]);

        // 6. Perawatan Rambut & Tubuh
        Product::create([
            'category_id' => $rambutTubuh->id,
            'name' => 'Sampo Pantene Anti Dandruff 160ml',
            'sku' => 'BDY-PANTENE-001',
            'price' => 24500,
            'stock' => 25,
            'image' => 'pantene.jpg',
        ]);
        Product::create([
            'category_id' => $rambutTubuh->id,
            'name' => 'Sabun Cair Lifebuoy Refill 400ml',
            'sku' => 'BDY-LIFEBUOY-002',
            'price' => 26000,
            'stock' => 30,
            'image' => 'lifebuoy.jpg',
        ]);
        Product::create([
            'category_id' => $rambutTubuh->id,
            'name' => 'Pasta Gigi Pepsodent Pencegah Gigi Berlubang 190g',
            'sku' => 'BDY-PEPSO-003',
            'price' => 13500,
            'stock' => 45,
            'image' => 'pepsodent.jpg',
        ]);

        // 7. Perawatan Wajah & Kulit
        Product::create([
            'category_id' => $wajahKulit->id,
            'name' => 'Sabun Cuci Muka Kahf Oil and Acne Care 100ml',
            'sku' => 'FCE-KAHF-001',
            'price' => 28500,
            'stock' => 15,
            'image' => 'kahf.jpg',
        ]);
        Product::create([
            'category_id' => $wajahKulit->id,
            'name' => 'Sunscreen Emina Sun Battle SPF 30 60ml',
            'sku' => 'FCE-EMINA-002',
            'price' => 29500,
            'stock' => 18,
            'image' => 'emina.jpg',
        ]);

        // 8. Kebutuhan Sanitasi
        Product::create([
            'category_id' => $sanitasi->id,
            'name' => 'Tisu Wajah Paseo 250 Sheets',
            'sku' => 'SAN-PASEO-001',
            'price' => 14500,
            'stock' => 50,
            'image' => 'paseo.jpg',
        ]);
        Product::create([
            'category_id' => $sanitasi->id,
            'name' => 'Pembalut Charm Safe Night Wing 35cm 8s',
            'sku' => 'SAN-CHARM-002',
            'price' => 18500,
            'stock' => 25,
            'image' => 'charm.jpg',
        ]);

        // 9. Wewangian
        Product::create([
            'category_id' => $wewangian->id,
            'name' => 'Deodoran Rexona Men Roll On Adventure 50ml',
            'sku' => 'WRG-REXONA-001',
            'price' => 19500,
            'stock' => 30,
            'image' => 'rexona.jpg',
        ]);
        Product::create([
            'category_id' => $wewangian->id,
            'name' => 'Parfum Casablanca Spray Blue 100ml',
            'sku' => 'WRG-CASA-002',
            'price' => 32500,
            'stock' => 15,
            'image' => 'casablanca.jpg',
        ]);

        // 10. Pencuci Pakaian
        Product::create([
            'category_id' => $pencuciPakaian->id,
            'name' => 'Detergen Rinso Liquid Active Fresh 750ml',
            'sku' => 'LND-RINSO-001',
            'price' => 23500,
            'stock' => 30,
            'image' => 'rinso.jpg',
        ]);
        Product::create([
            'category_id' => $pencuciPakaian->id,
            'name' => 'Pelembut Pewangi Downy Sunrise Fresh Refill 680ml',
            'sku' => 'LND-DOWNY-002',
            'price' => 18500,
            'stock' => 35,
            'image' => 'downy.jpg',
        ]);

        // 11. Pembersih Rumah
        Product::create([
            'category_id' => $pembersihRumah->id,
            'name' => 'Sabun Cuci Piring Mama Lemon Jeruk Nipis 780ml',
            'sku' => 'CLN-MAMALMN-001',
            'price' => 9500,
            'stock' => 50,
            'image' => 'mama_lemon.jpg',
        ]);
        Product::create([
            'category_id' => $pembersihRumah->id,
            'name' => 'Wipol Karbol Wangi Classic Pine 750ml',
            'sku' => 'CLN-WIPOL-002',
            'price' => 16500,
            'stock' => 35,
            'image' => 'wipol.jpg',
        ]);

        // 12. Pengendali Hama
        Product::create([
            'category_id' => $pengendaliHama->id,
            'name' => 'Obat Nyamuk Semprot Baygon Aerosol Citrus 600ml',
            'sku' => 'PEST-BAYGON-001',
            'price' => 42500,
            'stock' => 15,
            'image' => 'baygon.jpg',
        ]);

        // 13. Kebutuhan Bayi
        Product::create([
            'category_id' => $kebutuhanBayi->id,
            'name' => 'Popok MamyPoko Pants Standar M34',
            'sku' => 'BY-POPOK-001',
            'price' => 62000,
            'stock' => 15,
            'image' => 'mamypoko.jpg',
        ]);
        Product::create([
            'category_id' => $kebutuhanBayi->id,
            'name' => 'Susu SGM Eksplor 1+ Madu 400g',
            'sku' => 'BY-SGM-002',
            'price' => 45000,
            'stock' => 20,
            'image' => 'sgm.jpg',
        ]);
        Product::create([
            'category_id' => $kebutuhanBayi->id,
            'name' => 'Minyak Telon Konicare 60ml',
            'sku' => 'BY-TELON-003',
            'price' => 21500,
            'stock' => 25,
            'image' => 'konicare.jpg',
        ]);

        // 14. Produk Kesehatan Ringan
        Product::create([
            'category_id' => $kesehatan->id,
            'name' => 'Panadol Cold & Flu Strip Isi 10 Kaplet',
            'sku' => 'MED-PANADOL-001',
            'price' => 12500,
            'stock' => 60,
            'image' => 'panadol.jpg',
        ]);
        Product::create([
            'category_id' => $kesehatan->id,
            'name' => 'Minyak Angin Aromatherapy Safe Care 10ml',
            'sku' => 'MED-SAFECARE-002',
            'price' => 15500,
            'stock' => 45,
            'image' => 'safecare.jpg',
        ]);

        // 15. Kebutuhan Imbuhan
        Product::create([
            'category_id' => $imbuhan->id,
            'name' => 'Korek Api Gas Tokai Original',
            'sku' => 'ACC-TOKAI-001',
            'price' => 3500,
            'stock' => 120,
            'image' => 'tokai.jpg',
        ]);
        Product::create([
            'category_id' => $imbuhan->id,
            'name' => 'Baterai ABC Alkaline AA Pack Isi 4',
            'sku' => 'ACC-ABC-002',
            'price' => 18500,
            'stock' => 50,
            'image' => 'abc_battery.jpg',
        ]);

        // Secara dinamis membuat kode barcode EAN-13 tiruan untuk semua produk yang disemai
        $allProducts = Product::all();
        foreach ($allProducts as $index => $product) {
            $barcode = '8990011' . str_pad($index + 1, 6, '0', STR_PAD_LEFT);
            $product->update(['barcode' => $barcode]);
        }
    }
}
