<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent">
                Notification System Demo
            </h1>
            <p class="mt-4 text-lg text-slate-600 dark:text-slate-400">
                Test the notification system with different types of messages.
            </p>
        </div>

        <!-- Demo Content -->
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Success Notification -->
                <button 
                    wire:click="showSuccess"
                    class="flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-green-500/25 transform hover:scale-105 transition-all duration-200"
                    wire:loading.attr="disabled"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span>Show Success</span>
                </button>

                <!-- Error Notification -->
                <button 
                    wire:click="showError"
                    class="flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-rose-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-red-500/25 transform hover:scale-105 transition-all duration-200"
                    wire:loading.attr="disabled"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    <span>Show Error</span>
                </button>

                <!-- Warning Notification -->
                <button 
                    wire:click="showWarning"
                    class="flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-yellow-600 to-orange-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-yellow-500/25 transform hover:scale-105 transition-all duration-200"
                    wire:loading.attr="disabled"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>Show Warning</span>
                </button>

                <!-- Info Notification -->
                <button 
                    wire:click="showInfo"
                    class="flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-blue-500/25 transform hover:scale-105 transition-all duration-200"
                    wire:loading.attr="disabled"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <span>Show Info</span>
                </button>
            </div>

            <!-- Multiple Notifications -->
            <div class="mt-6 pt-6 border-t border-slate-200/60 dark:border-slate-700/60">
                <button 
                    wire:click="showMultiple"
                    class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-purple-500/25 transform hover:scale-105 transition-all duration-200"
                    wire:loading.attr="disabled"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    <span>Show Multiple Notifications</span>
                </button>
            </div>

            <!-- JavaScript Example -->
            <div class="mt-6 pt-6 border-t border-slate-200/60 dark:border-slate-700/60">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">JavaScript API Example</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <button 
                        onclick="window.showNotification('success', 'JS Success! Auto-disappears in 5 seconds!')"
                        class="flex items-center justify-center gap-2 px-4 py-2 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 font-medium rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 transition-all duration-200"
                    >
                        <span>JS Success</span>
                    </button>
                    <button 
                        onclick="window.showNotification('error', 'JS Error! Auto-disappears in 5 seconds!')"
                        class="flex items-center justify-center gap-2 px-4 py-2 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 font-medium rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 transition-all duration-200"
                    >
                        <span>JS Error</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
