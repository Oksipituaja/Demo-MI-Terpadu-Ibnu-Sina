{{-- Admin Form Submit Button with Double-Click Protection --}}
{{-- Usage: @include('components.admin-submit-btn', ['label' => 'Save', 'loading' => 'Saving...']) --}}

<button type="submit" 
        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium disabled:opacity-50 disabled:cursor-not-allowed transition"
        id="submitBtn">
    <span class="submit-label">
        <i class="fas fa-save mr-2"></i> {{ $label ?? 'Save' }}
    </span>
    <span class="submit-loading hidden">
        <i class="fas fa-spinner fa-spin mr-2"></i> {{ $loading ?? 'Processing...' }}
    </span>
</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const submitBtn = document.getElementById('submitBtn');
    if (!submitBtn) return;
    
    const form = submitBtn.closest('form');
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        // Check if already disabled (prevent double submit)
        if (submitBtn.disabled) {
            e.preventDefault();
            return false;
        }

        // Disable button
        submitBtn.disabled = true;
        
        // Toggle text
        const label = submitBtn.querySelector('.submit-label');
        const loading = submitBtn.querySelector('.submit-loading');
        
        if (label) label.classList.add('hidden');
        if (loading) loading.classList.remove('hidden');

        // Re-enable if form is not submitted after 5 seconds (safety)
        setTimeout(() => {
            if (submitBtn.disabled) {
                submitBtn.disabled = false;
                if (label) label.classList.remove('hidden');
                if (loading) loading.classList.add('hidden');
            }
        }, 5000);
    });
});
</script>
