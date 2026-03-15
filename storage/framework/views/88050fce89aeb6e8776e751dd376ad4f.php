

<?php $__env->startSection('page_title', 'Edit Pengguna'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <h3 class="font-semibold text-red-800 mb-2">Terjadi Kesalahan:</h3>
            <ul class="list-disc list-inside space-y-1">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="text-sm text-red-700"><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </ul>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <form action="<?php echo e(route('admin.management-account.update', $managementAccount)); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" name="name" value="<?php echo e(old('name', $managementAccount->name)); ?>" required class="w-full px-4 py-3 border <?php echo e($errors->has('name') ? 'border-red-500' : 'border-gray-300'); ?> rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="<?php echo e(old('email', $managementAccount->email)); ?>" required class="w-full px-4 py-3 border <?php echo e($errors->has('email') ? 'border-red-500' : 'border-gray-300'); ?> rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" class="w-full px-4 py-3 border <?php echo e($errors->has('password') ? 'border-red-500' : 'border-gray-300'); ?> rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah password. Minimal 8 karakter jika ingin diubah.</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Role / Peran</label>
            <select name="role" required class="w-full px-4 py-3 border <?php echo e($errors->has('role') ? 'border-red-500' : 'border-gray-300'); ?> rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">-- Pilih Role --</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($role->value); ?>" <?php echo e(old('role', $managementAccount->role?->value) === $role->value ? 'selected' : ''); ?>>
                        <?php echo e($role->label()); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
        </div>

        <div class="flex items-center space-x-3">
            <input type="checkbox" id="is_active" name="is_active" value="1" <?php echo e(old('is_active', $managementAccount->is_active) ? 'checked' : ''); ?> class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <label for="is_active" class="text-sm font-medium text-gray-700">Pengguna Aktif</label>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($managementAccount->last_login): ?>
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                <p class="text-sm text-gray-600">
                    <strong>Login Terakhir:</strong> <?php echo e($managementAccount->last_login->format('d M Y, H:i')); ?>

                </p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="flex gap-3 pt-4 border-t">
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                <i class="fas fa-save mr-2"></i> Simpan
            </button>
            <a href="<?php echo e(route('admin.management-account.index')); ?>" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg font-medium">
                <i class="fas fa-times mr-2"></i> Batal
            </a>
        </div>
    </form>

    <!-- Delete Form (MUST be outside Update Form) -->
    <form action="<?php echo e(route('admin.management-account.destroy', $managementAccount)); ?>" method="POST" style="margin-top:1.5rem;" onsubmit="return confirm('Hapus pengguna ini secara permanen?')">
        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
        <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium">
            <i class="fas fa-trash mr-2"></i> Hapus Pengguna
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\4329_Yusuf_Hammam\resources\views/admin/management-account/edit.blade.php ENDPATH**/ ?>