<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Dynamic SEO Meta Tags -->
    @if(isset($seoData))
        <x-seo.meta-tags v-bind="$seoData" />
    @else
        <!-- Fallback Meta Tags -->
        <title>{{ $title ?? 'phpuzem - Modern PHP & Laravel Development' }}</title>
        <meta name="description" content="Practical screencasts and complete learning paths for modern PHP & Laravel development. Learn by building real projects, at your own pace.">
        <meta name="keywords" content="Laravel, PHP, JavaScript, Vue.js, React, Web Development, Coding, Tailwind, Livewire">
        <meta name="author" content="phpuzem">
        <link rel="canonical" href="{{ request()->url() }}">
        
        <!-- Open Graph -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ request()->url() }}">
        <meta property="og:title" content="{{ $title ?? 'phpuzem - Modern PHP & Laravel Development' }}">
        <meta property="og:description" content="Practical screencasts and complete learning paths for modern PHP & Laravel development.">
        <meta property="og:site_name" content="phpuzem">
        
        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:title" content="{{ $title ?? 'phpuzem - Modern PHP & Laravel Development' }}">
        <meta property="twitter:description" content="Practical screencasts and complete learning paths for modern PHP & Laravel development.">
    @endif
    
    <!-- Sitemap for search engines -->
    <link rel="sitemap" type="application/xml" href="{{ route('sitemap') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

        <!-- Theme bootstrap: set initial light/dark before CSS to avoid FOUC -->
        <script>
            (function () {
                try {
                    var stored = localStorage.getItem('theme');
                    var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                    if (stored === 'dark' || (!stored && prefersDark)) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                } catch (e) { /* no-op */ }
            })();
        </script>
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles
    
    <!-- Syntax Highlighting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <style>
        .code-block {
            position: relative;
        }
        .copy-button {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            padding: 0.25rem 0.5rem;
            background-color: #4a5568;
            color: white;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            font-size: 0.8rem;
            opacity: 0;
            transition: opacity 0.2s;
        }
        .code-block:hover .copy-button {
            opacity: 1;
        }
        .copy-button:hover {
            background-color: #2d3748;
        }
        
        /* Notification positioning fix */
        #notifications-container {
            position: fixed !important;
            top: 1rem !important;
            right: 1rem !important;
            z-index: 9999 !important;
            pointer-events: none !important;
            max-width: 320px !important;
            width: 100% !important;
        }
        
        #notifications-container > * {
            pointer-events: auto !important;
        }
        
        #notifications-container .notification-content {
            word-wrap: break-word !important;
            overflow-wrap: break-word !important;
            hyphens: auto !important;
            max-width: 100% !important;
        }
        
        @media (max-width: 640px) {
            #notifications-container {
                left: 1rem !important;
                right: 1rem !important;
                max-width: none !important;
                width: auto !important;
            }
        }
    </style>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    {{ $slot }}
    
    <!-- Notifications -->
    <div class="fixed top-4 right-4 z-50 max-w-sm">
        <livewire:notification-manager />
    </div>
    
        @livewireScripts
        @stack('scripts')

        <!-- Syntax Highlighting & Copy-to-Clipboard -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
        <script>
            document.addEventListener('livewire:navigated', () => {
                // Initialize highlighting on all code blocks
                hljs.highlightAll();

                // Add copy buttons to all pre > code blocks
                document.querySelectorAll('pre code').forEach(function(block) {
                    // Check if a button has already been added
                    if (block.parentNode.querySelector('.copy-button')) {
                        return;
                    }

                    // Create a wrapper div
                    let wrapper = document.createElement('div');
                    wrapper.className = 'code-block';

                    // Wrap the pre element
                    block.parentNode.parentNode.replaceChild(wrapper, block.parentNode);
                    wrapper.appendChild(block.parentNode);

                    // Create the copy button
                    let button = document.createElement('button');
                    button.className = 'copy-button';
                    button.textContent = 'Copy';

                    // Append the button to the wrapper
                    wrapper.appendChild(button);

                    // Add click event listener
                    button.addEventListener('click', function() {
                        let codeText = block.innerText;
                        navigator.clipboard.writeText(codeText).then(function() {
                            button.textContent = 'Copied!';
                            setTimeout(function() {
                                button.textContent = 'Copy';
                            }, 2000); // Reset text after 2 seconds
                        }, function(err) {
                            console.error('Could not copy text: ', err);
                            button.textContent = 'Error';
                        });
                    });
                });
            });
        </script>

        <!-- Global notification API -->
        <script>
            // Global notification function
            window.showNotification = function(type, message) {
                Livewire.dispatch('show-notification', { type: type, message: message });
            };

            // Listen for custom notification events
            window.addEventListener('notification', function(event) {
                window.showNotification(event.detail.type || 'info', event.detail.message);
            });
        </script>

        <!-- Global theme toggle handler -->
        <script>
            (function () {
                function setTheme(next) {
                    var html = document.documentElement;
                    if (next === 'dark') {
                        html.classList.add('dark');
                    } else {
                        html.classList.remove('dark');
                    }
                    try { localStorage.setItem('theme', next); } catch (e) {}
                }

                // Delegate clicks so it survives Livewire re-renders
                document.addEventListener('click', function (e) {
                    var btn = e.target.closest && e.target.closest('#theme-toggle');
                    if (!btn) return;
                    var isDark = document.documentElement.classList.contains('dark');
                    setTheme(isDark ? 'light' : 'dark');
                });

                // Optional: sync across tabs
                window.addEventListener('storage', function (e) {
                    if (e.key !== 'theme') return;
                    if (e.newValue === 'dark') {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                });
            })();
        </script>
</body>
</html>