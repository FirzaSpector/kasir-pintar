<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Enums\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class POSTransactionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test checkout berhasil, mengurangi stok produk, dan menyimpan data transaksi.
     */
    public function test_checkout_successful_reduces_stock_and_saves_transaction(): void
    {
        // 1. Buat User kasir dan produk uji
        $user = User::factory()->create([
            'role' => Role::CASHIER,
        ]);

        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'price' => 10000,
            'stock' => 50,
        ]);

        $payload = [
            'items' => [
                [
                    'product_id' => $product->id,
                    'qty' => 5,
                ]
            ],
            'paid_amount' => 50000,
            'payment_method' => 'tunai',
        ];

        // 2. Lakukan request checkout
        $response = $this->actingAs($user)
            ->postJson('/api/checkout', $payload);

        // 3. Verifikasi response sukses
        $response->assertStatus(200);
        $response->assertJsonPath('success', true);

        // 4. Verifikasi stok produk berkurang (50 - 5 = 45)
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => 45,
        ]);

        // 5. Verifikasi transaksi tersimpan di database
        $this->assertDatabaseHas('transactions', [
            'total_amount' => 50000,
            'paid_amount' => 50000,
            'change_amount' => 0,
            'payment_method' => 'tunai',
            'status' => 'success',
            'user_id' => $user->id,
        ]);

        // 6. Verifikasi detail transaksi tersimpan
        $this->assertDatabaseHas('transaction_details', [
            'product_id' => $product->id,
            'qty' => 5,
            'price' => 10000,
            'subtotal' => 50000,
        ]);
    }

    /**
     * Test checkout gagal karena stok tidak mencukupi dan melakukan rollback.
     */
    public function test_checkout_fails_on_insufficient_stock_and_rolls_back(): void
    {
        $user = User::factory()->create([
            'role' => Role::CASHIER,
        ]);

        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'price' => 15000,
            'stock' => 3, // stok hanya ada 3
        ]);

        $payload = [
            'items' => [
                [
                    'product_id' => $product->id,
                    'qty' => 5, // minta 5 (melebihi stok)
                ]
            ],
            'paid_amount' => 75000,
            'payment_method' => 'tunai',
        ];

        // 2. Lakukan request checkout
        $response = $this->actingAs($user)
            ->postJson('/api/checkout', $payload);

        // 3. Verifikasi status response error 400
        $response->assertStatus(400);
        $response->assertJsonPath('success', false);

        // 4. Verifikasi stok produk tidak berubah (tidak berkurang karena rollback)
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => 3,
        ]);

        // 5. Verifikasi tidak ada transaksi yang tersimpan di database (rollback transaksi utama)
        $this->assertDatabaseCount('transactions', 0);
        $this->assertDatabaseCount('transaction_details', 0);
    }

    /**
     * Test checkout gagal jika uang pembayaran tidak mencukupi dan melakukan rollback.
     */
    public function test_checkout_fails_on_insufficient_payment_and_rolls_back(): void
    {
        $user = User::factory()->create([
            'role' => Role::CASHIER,
        ]);

        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'price' => 20000,
            'stock' => 10,
        ]);

        $payload = [
            'items' => [
                [
                    'product_id' => $product->id,
                    'qty' => 2, // total belanja = 40000
                ]
            ],
            'paid_amount' => 30000, // uang dibayar hanya 30000 (kurang)
            'payment_method' => 'tunai',
        ];

        // 2. Lakukan request checkout
        $response = $this->actingAs($user)
            ->postJson('/api/checkout', $payload);

        // 3. Verifikasi response error 400
        $response->assertStatus(400);
        $response->assertJsonPath('success', false);

        // 4. Verifikasi stok produk tidak berubah
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => 10,
        ]);

        // 5. Verifikasi tidak ada transaksi tersimpan
        $this->assertDatabaseCount('transactions', 0);
    }
}
