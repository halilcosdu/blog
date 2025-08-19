<div 
    id="notifications-container" 
    class="space-y-2"
    x-data="() => ({
        notifications: [],
        addNotification(type, message) {
            const id = Date.now() + Math.random();
            this.notifications.push({
                type: type,
                message: message,
                id: id
            });
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                this.notifications = this.notifications.filter(n => n.id !== id);
            }, 5000);
        },
        init() {
            // Store reference to this component
            const component = this;
            
            // Auto-add notifications from session flash messages
            @if(session()->has('success'))
                this.addNotification('success', {!! json_encode(session('success')) !!});
            @endif
            @if(session()->has('error'))
                this.addNotification('error', {!! json_encode(session('error')) !!});
            @endif
            @if(session()->has('warning'))
                this.addNotification('warning', {!! json_encode(session('warning')) !!});
            @endif
            @if(session()->has('info'))
                this.addNotification('info', {!! json_encode(session('info')) !!});
            @endif
            
            // Global function to add notifications from JavaScript
            window.showNotification = function(type, message) {
                component.addNotification(type, message);
            };
            
            // Listen for Livewire notifications
            window.addEventListener('notification', function(event) {
                component.addNotification(event.detail.type || 'info', event.detail.message);
            });
        }
    })"
>
    <template x-for="notification in notifications" :key="notification.id">
        <div 
            x-show="true"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="w-full shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden backdrop-blur-sm"
            :class="{
                'bg-green-50/95 dark:bg-green-900/90 ring-green-200 dark:ring-green-700 border border-green-200 dark:border-green-700': notification.type === 'success',
                'bg-red-50/95 dark:bg-red-900/90 ring-red-200 dark:ring-red-700 border border-red-200 dark:border-red-700': notification.type === 'error',
                'bg-yellow-50/95 dark:bg-yellow-900/90 ring-yellow-200 dark:ring-yellow-700 border border-yellow-200 dark:border-yellow-700': notification.type === 'warning',
                'bg-blue-50/95 dark:bg-blue-900/90 ring-blue-200 dark:ring-blue-700 border border-blue-200 dark:border-blue-700': notification.type === 'info'
            }"
        >
            <div class="p-3">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <!-- Success Icon -->
                        <svg x-show="notification.type === 'success'" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        
                        <!-- Error Icon -->
                        <svg x-show="notification.type === 'error'" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                        
                        <!-- Warning Icon -->
                        <svg x-show="notification.type === 'warning'" class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                        
                        <!-- Info Icon -->
                        <svg x-show="notification.type === 'info'" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p 
                            class="text-xs font-medium notification-content leading-relaxed"
                            :class="{
                                'text-green-800 dark:text-green-200': notification.type === 'success',
                                'text-red-800 dark:text-red-200': notification.type === 'error',
                                'text-yellow-800 dark:text-yellow-200': notification.type === 'warning',
                                'text-blue-800 dark:text-blue-200': notification.type === 'info'
                            }"
                            x-text="notification.message"
                        ></p>
                    </div>
                    <div class="ml-3 flex-shrink-0 flex">
                        <button 
                            @click="notifications = notifications.filter(n => n.id !== notification.id)"
                            class="inline-flex rounded-md focus:outline-none focus:ring-1 focus:ring-offset-1 p-1"
                            :class="{
                                'text-green-400 hover:text-green-500 focus:ring-green-600': notification.type === 'success',
                                'text-red-400 hover:text-red-500 focus:ring-red-600': notification.type === 'error',
                                'text-yellow-400 hover:text-yellow-500 focus:ring-yellow-600': notification.type === 'warning',
                                'text-blue-400 hover:text-blue-500 focus:ring-blue-600': notification.type === 'info'
                            }"
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
    </template>
</div>