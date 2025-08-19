<div>
    <button 
        wire:click="copyToClipboard"
        class="flex items-center gap-2 px-3 py-2 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 transition-all text-sm font-medium {{ $copied ? 'bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300' : '' }}"
    >
        @if(!$copied)
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
            </svg>
        @else
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
        @endif
        <span>{{ $copied ? 'Copied!' : 'Share' }}</span>
    </button>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('copy-url', (event) => {
                navigator.clipboard.writeText(event.url).catch(err => {
                    console.error('Failed to copy: ', err);
                });
            });

            Livewire.on('reset-copied-state', () => {
                setTimeout(() => {
                    @this.call('resetCopiedState');
                }, 2000);
            });
        });
    </script>
</div>
