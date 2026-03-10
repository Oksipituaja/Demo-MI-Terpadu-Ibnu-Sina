<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user model can access Filament panel.
     */
    public function test_super_admin_can_access_panel(): void
    {
        $admin = User::factory()->create([
            'role' => UserRole::SuperAdmin,
            'is_active' => true,
        ]);

        $this->assertTrue($admin->canAccessPanel(null));
    }

    /**
     * Test admin user can access Filament panel.
     */
    public function test_admin_can_access_panel(): void
    {
        $admin = User::factory()->create([
            'role' => UserRole::Admin,
            'is_active' => true,
        ]);

        $this->assertTrue($admin->canAccessPanel(null));
    }

    /**
     * Test regular user cannot access Filament panel.
     */
    public function test_regular_user_cannot_access_panel(): void
    {
        $user = User::factory()->create([
            'role' => UserRole::User,
            'is_active' => true,
        ]);

        $this->assertFalse($user->canAccessPanel(null));
    }

    /**
     * Test inactive user cannot access panel.
     */
    public function test_inactive_user_cannot_access_panel(): void
    {
        $admin = User::factory()->create([
            'role' => UserRole::SuperAdmin,
            'is_active' => false,
        ]);

        $this->assertFalse($admin->canAccessPanel(null));
    }

    /**
     * Test user can be created.
     */
    public function test_user_can_be_created(): void
    {
        $user = User::factory()->create([
            'name' => 'New User',
            'email' => 'newuser@test.com',
            'role' => UserRole::User,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'newuser@test.com',
        ]);
    }

    /**
     * Test user can be edited.
     */
    public function test_user_can_be_edited(): void
    {
        $user = User::factory()->create([
            'name' => 'Original Name',
            'role' => UserRole::User,
        ]);

        $user->update([
            'name' => 'Updated Name',
            'role' => UserRole::Admin,
        ]);

        $user->refresh();
        $this->assertEquals('Updated Name', $user->name);
        $this->assertEquals(UserRole::Admin, $user->role);
    }

    /**
     * Test user can be deleted.
     */
    public function test_user_can_be_deleted(): void
    {
        $user = User::factory()->create(['role' => UserRole::User]);
        $userId = $user->id;

        $user->delete();

        $this->assertDatabaseMissing('users', [
            'id' => $userId,
        ]);
    }

    /**
     * Test user has correct Filament name.
     */
    public function test_user_filament_name(): void
    {
        $user = User::factory()->create(['name' => 'John Doe']);

        $this->assertEquals('John Doe', $user->getFilamentName());
    }

    /**
     * Test user enum values are correct.
     */
    public function test_user_role_values(): void
    {
        $this->assertEquals('super_admin', UserRole::SuperAdmin->value);
        $this->assertEquals('admin', UserRole::Admin->value);
        $this->assertEquals('user', UserRole::User->value);
    }
}
