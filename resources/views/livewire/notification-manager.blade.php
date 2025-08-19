<div 
    id="notifications-container" 
    class="space-y-2"
    wire:ignore.self
>
    @foreach($notifications as $notification)
        <div 
            wire:key="notification-{{ $notification['id'] }}"
            class="w-full shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden backdrop-blur-sm transition-all duration-300 transform
            @if($notification['type'] === 'success') bg-green-50/95 dark:bg-green-900/90 ring-green-200 dark:ring-green-700 border border-green-200 dark:border-green-700
            @elseif($notification['type'] === 'error') bg-red-50/95 dark:bg-red-900/90 ring-red-200 dark:ring-red-700 border border-red-200 dark:border-red-700
            @elseif($notification['type'] === 'warning') bg-yellow-50/95 dark:bg-yellow-900/90 ring-yellow-200 dark:ring-yellow-700 border border-yellow-200 dark:border-yellow-700
            @elseif($notification['type'] === 'info') bg-blue-50/95 dark:bg-blue-900/90 ring-blue-200 dark:ring-blue-700 border border-blue-200 dark:border-blue-700
            @endif"
            x-data="{ show: true }"
            x-show="show"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <div class="p-3">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        @if($notification['type'] === 'success')
                            <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @elseif($notification['type'] === 'error')
                            <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                        @elseif($notification['type'] === 'warning')
                            <svg class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        @elseif($notification['type'] === 'info')
                            <svg class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                        @endif
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-xs font-medium notification-content leading-relaxed
                        @if($notification['type'] === 'success') text-green-800 dark:text-green-200
                        @elseif($notification['type'] === 'error') text-red-800 dark:text-red-200
                        @elseif($notification['type'] === 'warning') text-yellow-800 dark:text-yellow-200
                        @elseif($notification['type'] === 'info') text-blue-800 dark:text-blue-200
                        @endif">
                            {{ $notification['message'] }}
                        </p>
                    </div>
                    <div class="ml-3 flex-shrink-0 flex">
                        <button 
                            wire:click="removeNotification('{{ $notification['id'] }}')"
                            class="inline-flex rounded-md focus:outline-none focus:ring-1 focus:ring-offset-1 p-1
                            @if($notification['type'] === 'success') text-green-400 hover:text-green-500 focus:ring-green-600
                            @elseif($notification['type'] === 'error') text-red-400 hover:text-red-500 focus:ring-red-600
                            @elseif($notification['type'] === 'warning') text-yellow-400 hover:text-yellow-500 focus:ring-yellow-600
                            @elseif($notification['type'] === 'info') text-blue-400 hover:text-blue-500 focus:ring-blue-600
                            @endif"
                        >
                            <span class="sr-only">Close</span>
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Wire events for auto-removal -->
    @script
    <script>
        // Auto-remove notifications after 5 seconds
        $wire.on('auto-remove-notification', (event) => {
            setTimeout(() => {
                $wire.call('removeNotification', event.id);
            }, 5000);
        });
    </script>
    @endscript
</div>
