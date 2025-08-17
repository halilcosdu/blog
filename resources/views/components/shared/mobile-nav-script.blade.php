@push('scripts')
<script>
    // Mobile nav toggle
    (function initMobileNav() {
        const btn = document.querySelector('[data-mobile-toggle]');
        const nav = document.getElementById('mobile-nav');
        if (!btn || !nav) return;
        const iconOpen = btn.querySelector('[data-mobile-icon="open"]');
        const iconClose = btn.querySelector('[data-mobile-icon="close"]');
        
        let open = false;
        function setState(isOpen) {
            open = isOpen;
            nav.classList.toggle('hidden', !open);
            iconOpen.classList.toggle('hidden', open);
            iconClose.classList.toggle('hidden', !open);
            btn.setAttribute('aria-expanded', open);
        }
        
        btn.addEventListener('click', () => setState(!open));
        document.addEventListener('click', (e) => {
            const t = e.target;
            const isEl = t && typeof t === 'object' && 'closest' in t;
            if (!isEl) return;
            if (!t.closest('#mobile-nav') && !t.closest('[data-mobile-toggle]')) { open = false; setState(false); }
        });
    })();
</script>
@endpush