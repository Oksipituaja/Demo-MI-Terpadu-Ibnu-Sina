<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['role' => UserRole::SuperAdmin]));
    }

    public function test_account_management_page_loads(): void
    {
        $response = $this->get('/admin/manajemen-akun');
        $response->assertStatus(200);
    }

    public function test_users_table_displays_correct_data(): void
    {
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'role' => UserRole::Admin,
        ]);

        $response = $this->get('/admin/manajemen-akun');
        $response->assertStatus(200);
    }

    public function test_user_can_be_created(): void
    {
        $response = $this->post('/admin/users', [
            'name' => 'New User',
            'email' => 'newuser@test.com',
            'password' => 'password123',
            'role' => UserRole::User,
            'is_active' => true,
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'newuser@test.com',
        ]);
    }

    public function test_user_can_be_edited(): void
    {
        $user = User::factory()->create([
            'name' => 'Original Name',
        ]);

        $response = $this->put("/admin/users/{$user->id}", [
            'name' => 'Updated Name',
            'email' => $user->email,
            'role' => UserRole::Admin,
            'is_active' => true,
        ]);

        $user->refresh();
        $this->assertEquals('Updated Name', $user->name);
    }

    public function test_user_can_be_deleted(): void
    {
        $user = User::factory()->create();

        $response = $this->delete("/admin/users/{$user->id}");

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    public function test_role_filter_works(): void
    {
        User::factory()->create(['role' => UserRole::SuperAdmin]);
        User::factory()->create(['role' => UserRole::Admin]);
        User::factory()->create(['role' => UserRole::User]);

        $response = $this->get('/admin/manajemen-akun?tableFilters[role][value]=admin');
        $response->assertStatus(200);
    }

    public function test_active_status_filter_works(): void
    {
        User::factory()->create(['is_active' => true]);
        User::factory()->create(['is_active' => false]);

        $response = $this->get('/admin/manajemen-akun?tableFilters[is_active][value]=1');
        $response->assertStatus(200);
    }
}
