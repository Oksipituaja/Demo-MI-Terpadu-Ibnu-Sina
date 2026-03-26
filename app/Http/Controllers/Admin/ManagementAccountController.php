<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ManagementAccountController extends Controller
{
    public function index(): View
    {
        // Menampilkan 12 akun per halaman untuk demo
        $users = User::latest()->paginate(12);
        return view('admin.management-account.index', compact('users'));
    }

    public function create(): View
    {
        $roles = UserRole::cases();
        return view('admin.management-account.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|string|min:8',
            'role'      => 'required|in:super_admin,admin',
            'is_active' => 'sometimes|boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = $request->has('is_active');

        User::create($validated);

        return redirect()->route('admin.management-account.index')
            ->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit(User $managementAccount): View
    {
        $roles = UserRole::cases();
        return view('admin.management-account.edit', compact('managementAccount', 'roles'));
    }

    public function update(Request $request, User $managementAccount)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $managementAccount->id,
            'password'  => 'nullable|string|min:8',
            'role'      => 'required|in:super_admin,admin',
            'is_active' => 'sometimes|boolean',
        ]);

        if (filled($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_active'] = $request->has('is_active');
        $managementAccount->update($validated);

        return redirect()->route('admin.management-account.index')
            ->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function destroy(User $managementAccount)
    {
        if ($managementAccount->id === auth()->id()) {
            return back()->withErrors(['error' => 'Tidak dapat menghapus akun sendiri.']);
        }

        if ($managementAccount->role === UserRole::SuperAdmin) {
            $superAdminCount = User::where('role', UserRole::SuperAdmin)->count();
            if ($superAdminCount <= 1) {
                return back()->withErrors(['error' => 'Tidak dapat menghapus Super Admin terakhir.']);
            }
        }

        $managementAccount->delete();
        return redirect()->route('admin.management-account.index')
            ->with('success', 'Pengguna berhasil dihapus!');
    }
}
