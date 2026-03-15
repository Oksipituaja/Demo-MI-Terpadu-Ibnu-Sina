

<?php $__env->startSection('page_title', 'Manajemen Akun'); ?>
<?php $__env->startSection('page_subtitle', 'Kelola pengguna dan akses sistem'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Pengguna</p>
                    <p class="text-3xl font-bold text-gray-900"><?php echo e($users->total()); ?></p>
                </div>
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-100">
                    <i class="fas fa-users text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Admin Aktif</p>
                    <p class="text-3xl font-bold text-gray-900"><?php echo e(\App\Models\User::where('is_active', true)->get()->filter(function($u) { return in_array($u->role->value, ['admin', 'super_admin']); })->count()); ?></p>
                </div>
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-purple-100">
                    <i class="fas fa-shield-alt text-purple-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Pengguna Aktif</p>
                    <p class="text-3xl font-bold text-gray-900"><?php echo e(\App\Models\User::where('is_active', true)->count()); ?></p>
                </div>
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex justify-between items-center mb-6">
    <h3 class="text-lg font-semibold text-gray-800">Semua Pengguna</h3>
    <a href="<?php echo e(route('admin.management-account.create')); ?>" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
        <i class="fas fa-plus mr-2"></i> Tambah Pengguna
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Role</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Login Terakhir</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900"><?php echo e($user->name); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($user->email); ?></td>
                    <td class="px-6 py-4 text-sm">
                        <?php
                            $roleBadgeClass = 'bg-gray-100 text-gray-800';
                            $roleLabel = 'Unknown';
                            if ($user->role) {
                                $roleBadgeClass = match($user->role->value) {
                                    'super_admin' => 'bg-red-100 text-red-800',
                                    'admin' => 'bg-yellow-100 text-yellow-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                                $roleLabel = $user->role->label();
                            }
                        ?>
                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full <?php echo e($roleBadgeClass); ?>">
                            <?php echo e($roleLabel); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->is_active): ?>
                            <span class="inline-flex items-center text-green-600">
                                <i class="fas fa-check-circle mr-1"></i> Aktif
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center text-red-600">
                                <i class="fas fa-times-circle mr-1"></i> Nonaktif
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        <?php echo e($user->last_login?->format('d M Y, H:i') ?? 'Belum pernah'); ?>

                    </td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="<?php echo e(route('admin.management-account.edit', $user)); ?>" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="<?php echo e(route('admin.management-account.destroy', $user)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Hapus pengguna ini?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="px-6 py-8 text-center text-gray-500">Tidak ada pengguna.</td></tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-4"><?php echo e($users->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\4329_Yusuf_Hammam\resources\views/admin/management-account/index.blade.php ENDPATH**/ ?>