{{-- Auto Slug Generator Component --}}
{{-- Usage: @include('components.auto-slug', ['titleSelector' => '#title', 'slugSelector' => '#slug']) --}}

<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.querySelector('{{ $titleSelector ?? "#title" }}');
    const slugInput = document.querySelector('{{ $slugSelector ?? "#slug" }}');

    if (titleInput && slugInput) {
        titleInput.addEventListener('keyup', function() {
            // Only generate slug if slug field is empty or disabled (readonly)
            if (!slugInput.value || slugInput.readOnly) {
                slugInput.value = generateSlug(this.value);
            }
        });

        // Allow manual slug edit by removing readonly
        slugInput.addEventListener('focus', function() {
            this.readOnly = false;
            this.style.backgroundColor = '#ffffff';
        });
    }
});

function generateSlug(text) {
    return text
        .toLowerCase()
        .trim()
        .replace(/[^\w\s\-]/g, '') // Remove special chars except hyphen
        .replace(/[\s_]+/g, '-')    // Replace spaces/underscores with hyphen
        .replace(/\-+/g, '-')       // Multiple hyphens to single
        .replace(/^\-+|\-+$/g, ''); // Remove leading/trailing hyphens
}
</script>
