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
        $users = User::latest()->paginate(15);

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:super_admin,admin',
            'is_active' => 'sometimes|boolean',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh melebihi 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus format yang valid.',
            'email.unique' => 'Email sudah terdaftar di sistem.',
            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'role.required' => 'Peran wajib dipilih.',
            'role.in' => 'Peran yang dipilih tidak valid.',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = $request->has('is_active');

        User::create($validated);

        return redirect()->route('admin.management-account.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit(User $managementAccount): View
    {
        $roles = UserRole::cases();

        return view('admin.management-account.edit', compact('managementAccount', 'roles'));
    }

    public function update(User $managementAccount, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$managementAccount->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:super_admin,admin',
            'is_active' => 'sometimes|boolean',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh melebihi 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus format yang valid.',
            'email.unique' => 'Email sudah terdaftar di sistem.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'role.required' => 'Peran wajib dipilih.',
            'role.in' => 'Peran yang dipilih tidak valid.',
        ]);

        if (filled($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_active'] = $request->has('is_active');

        $managementAccount->update($validated);

        return redirect()->route('admin.management-account.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function destroy(User $managementAccount)
    {
        $managementAccount->delete();

        return redirect()->route('admin.management-account.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
