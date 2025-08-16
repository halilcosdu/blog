<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
    <!-- Header -->
    <header class="relative">
        <!-- Background with glassmorphism -->
        <div class="absolute inset-0 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-200/50 dark:border-slate-700/50"></div>

        <nav class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-red-600 to-orange-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent">
                            CodeBlog
                        </span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="relative px-3 py-2 text-sm font-medium text-red-600 dark:text-red-400">
                        Ana Sayfa
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gradient-to-r from-red-600 to-orange-500 rounded-full"></div>
                    </a>
                    <a href="/posts" class="px-3 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400 transition-colors">Yazılar</a>
                    <a href="/categories" class="px-3 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400 transition-colors">Kategoriler</a>
                    <a href="/about" class="px-3 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400 transition-colors">Hakkında</a>
                </nav>

                <!-- Search & Actions -->
                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <div class="relative hidden md:block">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" placeholder="Ara..." class="pl-9 pr-4 py-2 w-64 text-sm bg-slate-100/50 dark:bg-slate-800/50 border border-slate-200/50 dark:border-slate-700/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500/50 transition-all">
                    </div>

                    <!-- Theme Toggle -->
                    <button id="theme-toggle" class="p-2 rounded-xl bg-slate-100/50 dark:bg-slate-800/50 hover:bg-slate-200/50 dark:hover:bg-slate-700/50 border border-slate-200/50 dark:border-slate-700/50 transition-all">
                        <svg class="w-4 h-4 text-slate-600 dark:text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                            <path class="dark:hidden" d="M10 2L13.09 8.26L20 9L14 14.74L15.18 21.02L10 17.77L4.82 21.02L6 14.74L0 9L6.91 8.26L10 2Z"/>
                            <path class="hidden dark:block" d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                    </button>

                    @if (Route::has('filament.hammer.auth.login'))
                        @auth
                            <a href="{{ url('/hammer') }}" class="hidden sm:inline-flex items-center px-4 py-2 rounded-xl bg-slate-100/50 dark:bg-slate-800/50 border border-slate-200/50 dark:border-slate-700/50 text-slate-700 dark:text-slate-300 hover:bg-slate-200/50 dark:hover:bg-slate-700/50 transition-all text-sm font-medium">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('filament.hammer.auth.login') }}" class="inline-flex items-center px-4 py-2 rounded-xl bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 text-slate-800 dark:text-slate-200 hover:bg-white/80 dark:hover:bg-slate-800/80 transition-all text-sm font-medium">
                                Giriş Yap
                            </a>
                            @if (Route::has('filament.hammer.auth.login'))
                                <a href="{{ route('filament.hammer.auth.login') }}" class="inline-flex items-center px-4 py-2 rounded-xl bg-gradient-to-r from-red-600 to-orange-500 text-white hover:shadow-lg hover:shadow-red-500/25 transition-all text-sm font-semibold">
                                    Kayıt Ol
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative py-20 lg:py-32 overflow-hidden">
        <!-- Background decorations -->
        <div class="absolute inset-0 bg-gradient-to-br from-red-50/50 via-orange-50/30 to-yellow-50/50 dark:from-red-950/20 dark:via-orange-950/10 dark:to-yellow-950/20"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-96 h-96 bg-gradient-to-r from-red-400/20 to-orange-400/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-gradient-to-l from-orange-400/20 to-yellow-400/20 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-4xl mx-auto">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 mb-8">
                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Aktif olarak yayınlanıyor</span>
                </div>

                <!-- Main headline -->
                <h1 class="text-5xl lg:text-7xl font-bold mb-6">
                    <span class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 dark:from-white dark:via-slate-100 dark:to-white bg-clip-text text-transparent">
                        Modern Web
                    </span>
                    <br>
                    <span class="bg-gradient-to-r from-red-600 via-orange-500 to-red-600 bg-clip-text text-transparent">
                        Geliştirme
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl lg:text-2xl text-slate-600 dark:text-slate-400 mb-12 leading-relaxed">
                    Laravel, PHP, JavaScript ve modern web teknolojileri hakkında
                    <span class="font-semibold text-slate-800 dark:text-slate-200">güncel yazılar</span>,
                    kod örnekleri ve rehberler.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                    <a href="#latest-posts" class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-600 to-orange-500 text-white font-semibold rounded-2xl hover:shadow-lg hover:shadow-red-500/25 transition-all duration-300 hover:-translate-y-0.5">
                        <span>Son Yazıları Keşfet</span>
                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    <a href="/subscribe" class="group inline-flex items-center px-8 py-4 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 text-slate-800 dark:text-slate-200 font-semibold rounded-2xl hover:bg-white/80 dark:hover:bg-slate-800/80 transition-all duration-300 hover:-translate-y-0.5">
                        <span>Abone Ol</span>
                        <svg class="ml-2 w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-8 max-w-md mx-auto">
                    <div class="text-center">
                        <div class="text-2xl lg:text-3xl font-bold text-slate-800 dark:text-slate-200">50+</div>
                        <div class="text-sm text-slate-600 dark:text-slate-400">Yazı</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl lg:text-3xl font-bold text-slate-800 dark:text-slate-200">10K+</div>
                        <div class="text-sm text-slate-600 dark:text-slate-400">Okuyucu</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl lg:text-3xl font-bold text-slate-800 dark:text-slate-200">4</div>
                        <div class="text-sm text-slate-600 dark:text-slate-400">Kategori</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent mb-4">
                    Popüler Kategoriler
                </h2>
                <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                    En sevilen konularda derinlemesine içerikler ve güncel yazılar
                </p>
            </div>

            @if($categories->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($categories as $category)
                        <a href="/category/{{ $category->slug }}" class="group relative">
                            <div class="absolute inset-0 bg-gradient-to-r opacity-0 group-hover:opacity-100 rounded-2xl blur transition-opacity duration-300" style="background: linear-gradient(135deg, {{ $category->color }}40, {{ $category->color }}20);"></div>
                            <div class="relative bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 rounded-2xl p-6 hover:border-slate-300/50 dark:hover:border-slate-600/50 transition-all duration-300 group-hover:-translate-y-1">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 transition-transform duration-300 group-hover:scale-110" style="background: linear-gradient(135deg, {{ $category->color }}20, {{ $category->color }}10);">
                                    @if($category->icon)
                                        <i class="{{ $category->icon }} w-6 h-6" style="color: {{ $category->color }};"></i>
                                    @else
                                        <svg class="w-6 h-6" style="color: {{ $category->color }};" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                        </svg>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-2">{{ $category->name }}</h3>
                                <p class="text-slate-600 dark:text-slate-400 mb-4 text-sm leading-relaxed">{{ $category->description ?? 'Kategori açıklaması' }}</p>
                                <div class="flex items-center font-medium transition-colors group-hover:translate-x-1 duration-300" style="color: {{ $category->color }};">
                                    <span class="text-sm">Yazıları Gör</span>
                                    <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Laravel -->
                    <a href="/category/laravel" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-500/20 to-orange-500/20 opacity-0 group-hover:opacity-100 rounded-2xl blur transition-opacity duration-300"></div>
                        <div class="relative bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 rounded-2xl p-6 hover:border-slate-300/50 dark:hover:border-slate-600/50 transition-all duration-300 group-hover:-translate-y-1">
                            <div class="w-12 h-12 bg-gradient-to-br from-red-500/20 to-orange-500/20 rounded-xl flex items-center justify-center mb-4 transition-transform duration-300 group-hover:scale-110">
                                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-2">Laravel</h3>
                            <p class="text-slate-600 dark:text-slate-400 mb-4 text-sm leading-relaxed">Modern PHP framework'ü ile web uygulaması geliştirme</p>
                            <div class="flex items-center text-red-600 font-medium transition-colors group-hover:translate-x-1 duration-300">
                                <span class="text-sm">Yazıları Gör</span>
                                <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- PHP -->
                    <a href="/category/php" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 rounded-2xl blur transition-opacity duration-300"></div>
                        <div class="relative bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 rounded-2xl p-6 hover:border-slate-300/50 dark:hover:border-slate-600/50 transition-all duration-300 group-hover:-translate-y-1">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-xl flex items-center justify-center mb-4 transition-transform duration-300 group-hover:scale-110">
                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-2">PHP</h3>
                            <p class="text-slate-600 dark:text-slate-400 mb-4 text-sm leading-relaxed">PHP 8+ özellikleri, best practices ve tips</p>
                            <div class="flex items-center text-blue-600 font-medium transition-colors group-hover:translate-x-1 duration-300">
                                <span class="text-sm">Yazıları Gör</span>
                                <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- Frontend -->
                    <a href="/category/frontend" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-green-500/20 to-emerald-500/20 opacity-0 group-hover:opacity-100 rounded-2xl blur transition-opacity duration-300"></div>
                        <div class="relative bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 rounded-2xl p-6 hover:border-slate-300/50 dark:hover:border-slate-600/50 transition-all duration-300 group-hover:-translate-y-1">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500/20 to-emerald-500/20 rounded-xl flex items-center justify-center mb-4 transition-transform duration-300 group-hover:scale-110">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-2">Frontend</h3>
                            <p class="text-slate-600 dark:text-slate-400 mb-4 text-sm leading-relaxed">Vue.js, React, Tailwind CSS ve modern frontend</p>
                            <div class="flex items-center text-green-600 font-medium transition-colors group-hover:translate-x-1 duration-300">
                                <span class="text-sm">Yazıları Gör</span>
                                <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- DevOps -->
                    <a href="/category/devops" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-500/20 to-pink-500/20 opacity-0 group-hover:opacity-100 rounded-2xl blur transition-opacity duration-300"></div>
                        <div class="relative bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 rounded-2xl p-6 hover:border-slate-300/50 dark:hover:border-slate-600/50 transition-all duration-300 group-hover:-translate-y-1">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-xl flex items-center justify-center mb-4 transition-transform duration-300 group-hover:scale-110">
                                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z"/>
                                    <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V9a1 1 0 00-1-1h-1v-1z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-2">DevOps</h3>
                            <p class="text-slate-600 dark:text-slate-400 mb-4 text-sm leading-relaxed">Docker, deployment, testing ve otomasyon</p>
                            <div class="flex items-center text-purple-600 font-medium transition-colors group-hover:translate-x-1 duration-300">
                                <span class="text-sm">Yazıları Gör</span>
                                <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Latest Posts -->
    <section id="latest-posts" class="py-16 lg:py-24 bg-slate-50/50 dark:bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-16">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent mb-2">
                        Son Yazılar
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400">En yeni ve güncel içeriklerimiz</p>
                </div>
                <a href="/posts" class="hidden sm:inline-flex items-center px-6 py-3 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 text-slate-700 dark:text-slate-300 font-medium rounded-xl hover:bg-white/80 dark:hover:bg-slate-800/80 transition-all duration-300 group">
                    <span>Tümünü Gör</span>
                    <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>

            @if($featuredPost)
                <!-- Featured Post -->
                <div class="mb-16">
                    <article class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-500/10 to-orange-500/10 opacity-0 group-hover:opacity-100 rounded-3xl blur transition-opacity duration-500"></div>
                        <div class="relative bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 rounded-3xl overflow-hidden hover:border-slate-300/50 dark:hover:border-slate-600/50 transition-all duration-500 group-hover:-translate-y-1">
                            <div class="grid grid-cols-1 lg:grid-cols-2">
                                <div class="aspect-video lg:aspect-auto">
                                    <img src="{{ $featuredPost->featured_image ?? 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800&h=600&fit=crop' }}"
                                         alt="{{ $featuredPost->title }}"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                                <div class="p-8 lg:p-12">
                                    <div class="flex items-center mb-6">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase"
                                              style="background-color: {{ $featuredPost->category->color }}20; color: {{ $featuredPost->category->color }};">
                                            {{ $featuredPost->category->name }}
                                        </span>
                                        <span class="ml-4 text-slate-500 dark:text-slate-400 text-sm">{{ $featuredPost->formatted_published_date }}</span>
                                    </div>
                                    <h3 class="text-2xl lg:text-3xl font-bold text-slate-800 dark:text-slate-200 mb-4 leading-tight">
                                        <a href="/post/{{ $featuredPost->slug }}" class="hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                            {{ $featuredPost->title }}
                                        </a>
                                    </h3>
                                    <p class="text-slate-600 dark:text-slate-400 mb-8 text-lg leading-relaxed">
                                        {{ $featuredPost->excerpt }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=48&h=48&fit=crop&crop=face"
                                                 alt="{{ $featuredPost->user->name }}"
                                                 class="w-12 h-12 rounded-full">
                                            <div class="ml-4">
                                                <p class="font-semibold text-slate-800 dark:text-slate-200">{{ $featuredPost->user->name }}</p>
                                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $featuredPost->reading_time }}</p>
                                            </div>
                                        </div>
                                        <a href="/post/{{ $featuredPost->slug }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-red-500/25 transition-all duration-300 group">
                                            <span>Oku</span>
                                            <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            @endif

            <!-- Post Grid -->
            @if($latestPosts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($latestPosts as $post)
                        <article class="group">
                            <div class="relative bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 rounded-2xl overflow-hidden hover:border-slate-300/50 dark:hover:border-slate-600/50 transition-all duration-300 group-hover:-translate-y-1">
                                <div class="aspect-video overflow-hidden">
                                    <img src="{{ $post->featured_image ?? 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=400&h=250&fit=crop' }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold"
                                              style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }};">
                                            {{ $post->category->name }}
                                        </span>
                                        <span class="ml-3 text-slate-500 dark:text-slate-400 text-sm">{{ $post->formatted_published_date }}</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-3 leading-tight">
                                        <a href="/post/{{ $post->slug }}" class="hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <p class="text-slate-600 dark:text-slate-400 text-sm mb-6 leading-relaxed">
                                        {{ Str::limit($post->excerpt, 120) }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=32&h=32&fit=crop&crop=face"
                                                 alt="{{ $post->user->name }}"
                                                 class="w-8 h-8 rounded-full">
                                            <span class="ml-2 text-sm font-medium text-slate-700 dark:text-slate-300">{{ $post->user->name }}</span>
                                        </div>
                                        <span class="text-sm text-slate-500 dark:text-slate-400">{{ $post->reading_time }}</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <div class="w-16 h-16 bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-2">Henüz yazı yok</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-6">Admin panelinden yeni yazılar ekleyebilirsiniz.</p>
                    <a href="/admin" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-red-500/25 transition-all duration-300">
                        Admin Paneli
                        <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 lg:py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-red-600 via-orange-500 to-red-600"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="3" cy="3" r="3"/%3E%3Ccircle cx="13" cy="13" r="3"/%3E%3C/g%3E%3C/svg%3E')]"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm mb-8">
                <svg class="w-5 h-5 text-white mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                </svg>
                <span class="text-white font-medium">Newsletter</span>
            </div>

            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
                Güncel kalın!
            </h2>
            <p class="text-red-100 mb-12 text-lg lg:text-xl leading-relaxed max-w-2xl mx-auto">
                Haftalık bültenimizle en son yazılar, tips ve teknoloji haberleri doğrudan e-postanızda.
            </p>

            <form class="max-w-md mx-auto">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <input type="email"
                               placeholder="E-posta adresiniz"
                               class="w-full px-6 py-4 bg-white/90 backdrop-blur-sm border border-white/20 rounded-2xl text-slate-900 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-white/50 focus:bg-white transition-all">
                    </div>
                    <button type="submit"
                            class="px-8 py-4 bg-white text-red-600 font-bold rounded-2xl hover:bg-red-50 hover:scale-105 transition-all duration-300 shadow-lg">
                        Abone Ol
                    </button>
                </div>
                <p class="text-red-200 text-xs mt-4">Spam göndermiyoruz. İstediğiniz zaman abonelikten çıkabilirsiniz.</p>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 bg-gradient-to-r from-red-600 to-orange-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">CodeBlog</span>
                    </div>
                    <p class="text-slate-400 mb-8 max-w-md leading-relaxed">
                        Modern web geliştirme teknolojileri hakkında kaliteli içerik üreten bir platform.
                        Geliştiriciler için, geliştiriciler tarafından.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-slate-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-slate-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.347-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-bold mb-6">Kategoriler</h4>
                    <ul class="space-y-3">
                        <li><a href="/category/laravel" class="text-slate-400 hover:text-white transition-colors">Laravel</a></li>
                        <li><a href="/category/php" class="text-slate-400 hover:text-white transition-colors">PHP</a></li>
                        <li><a href="/category/frontend" class="text-slate-400 hover:text-white transition-colors">Frontend</a></li>
                        <li><a href="/category/devops" class="text-slate-400 hover:text-white transition-colors">DevOps</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-bold mb-6">Sayfalar</h4>
                    <ul class="space-y-3">
                        <li><a href="/about" class="text-slate-400 hover:text-white transition-colors">Hakkında</a></li>
                        <li><a href="/contact" class="text-slate-400 hover:text-white transition-colors">İletişim</a></li>
                        <li><a href="/privacy" class="text-slate-400 hover:text-white transition-colors">Gizlilik</a></li>
                        <li><a href="/terms" class="text-slate-400 hover:text-white transition-colors">Şartlar</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-800 mt-12 pt-8 text-center">
                <p class="text-slate-400">
                    © 2024 CodeBlog. Tüm hakları saklıdır. ❤️ ile
                    <span class="text-red-400">Laravel</span> ve
                    <span class="text-blue-400">Livewire</span> ile yapıldı.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Dark mode toggle
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;

        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                html.classList.toggle('dark');
                localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
            });
        }

        // Load saved theme
        if (localStorage.getItem('theme') === 'dark' ||
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
        }
    </script>
</div>
