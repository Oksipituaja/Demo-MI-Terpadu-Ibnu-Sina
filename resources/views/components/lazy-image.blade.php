@props(['src', 'alt', 'title' => null, 'class' => 'w-full h-auto'])

<img
    src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"
    data-src="{{ $src }}"
    alt="{{ $alt }}"
    @if($title) title="{{ $title }}" @endif
    class="lazy-image {{ $class }}"
    loading="lazy"
/>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.lazy-image');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px'
        });
        
        images.forEach(img => {
            imageObserver.observe(img);
        });
    } else {
        // Fallback untuk browser lama
        images.forEach(img => {
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
        });
    }
});
</script>
