<?php

namespace Tests\Feature;

use App\Models\User;
use App\Enums\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class POSAccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest diredirect ke halaman login ketika mengakses halaman dashboard.
     */
    public function test_guest_cannot_access_dashboard_and_is_redirected(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    /**
     * Test kasir bisa mengakses halaman Kasir Utama.
     */
    public function test_cashier_can_access_cashier_page(): void
    {
        $user = User::factory()->create([
            'role' => Role::CASHIER,
        ]);

        $response = $this->actingAs($user)->get('/cashier');

        $response->assertStatus(200);
    }

    /**
     * Test kasir tidak diizinkan mengakses halaman Manajemen Produk (403 Forbidden).
     */
    public function test_cashier_cannot_access_product_management_page(): void
    {
        $user = User::factory()->create([
            'role' => Role::CASHIER,
        ]);

        $response = $this->actingAs($user)->get('/products');

        $response->assertStatus(403);
    }

    /**
     * Test admin diizinkan mengakses halaman Manajemen Produk (200 OK).
     */
    public function test_admin_can_access_product_management_page(): void
    {
        $user = User::factory()->create([
            'role' => Role::ADMIN,
        ]);

        $response = $this->actingAs($user)->get('/products');

        $response->assertStatus(200);
    }
}
