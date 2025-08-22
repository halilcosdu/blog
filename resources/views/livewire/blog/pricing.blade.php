<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-indigo-50 dark:from-slate-900 dark:via-purple-900/20 dark:to-slate-900">
    
    <x-shared.header current-page="pricing" />

    <x-shared.announcements />

    <!-- Main Content -->
    <main class="relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-purple-400/20 to-pink-400/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-blue-400/20 to-cyan-400/20 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-br from-purple-400/10 to-indigo-400/10 rounded-full blur-3xl"></div>
        </div>

        <!-- Hero Section -->
        <section class="relative pt-20 pb-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="mx-auto max-w-5xl">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-100 to-indigo-100 dark:from-purple-900/30 dark:to-indigo-900/30 rounded-full text-sm font-medium text-purple-700 dark:text-purple-300 mb-8 border border-purple-200 dark:border-purple-700/50">
                        <div class="w-2 h-2 bg-purple-500 rounded-full animate-pulse"></div>
                        AI-Powered Learning Experience
                    </div>

                    <h1 class="text-5xl md:text-7xl font-bold bg-gradient-to-r from-purple-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent mb-8 leading-tight">
                        Learn with Your
                        <span class="relative">
                            AI Avatar
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full animate-bounce"></div>
                        </span>
                        Teacher
                    </h1>
                    
                    <p class="text-xl md:text-2xl text-slate-600 dark:text-slate-300 mb-12 max-w-3xl mx-auto leading-relaxed">
                        Experience the future of coding education with <strong class="text-purple-600 dark:text-purple-400">HeyGen AI Avatar</strong> integration. 
                        Get personalized, one-on-one tutoring that adapts to your learning style.
                    </p>

                    <!-- Avatar Demo Preview -->
                    <div class="relative mx-auto w-64 h-64 mb-16">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full opacity-20 animate-pulse"></div>
                        <div class="absolute inset-4 bg-gradient-to-br from-purple-400 to-indigo-500 rounded-full opacity-40 animate-pulse animation-delay-75"></div>
                        <div class="absolute inset-8 bg-gradient-to-br from-purple-600 to-indigo-700 rounded-full flex items-center justify-center">
                            <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1L13.5 2.5L16.17 5.17L10.59 10.75C10.21 10.37 9.7 10.17 9.17 10.17H4C2.9 10.17 2 11.07 2 12.17V14.17H4V22H10V14.17H11V13C11 12.65 11.04 12.31 11.1 11.97L16.5 6.5L19 9H21ZM6 12.17H8V14.17H6V12.17Z"/>
                            </svg>
                        </div>
                        <!-- Floating Icons -->
                        <div class="absolute -top-4 left-8 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center animate-bounce animation-delay-200">
                            <span class="text-yellow-900 text-xs">💡</span>
                        </div>
                        <div class="absolute top-8 -right-4 w-8 h-8 bg-blue-400 rounded-full flex items-center justify-center animate-bounce animation-delay-300">
                            <span class="text-blue-900 text-xs">🚀</span>
                        </div>
                        <div class="absolute bottom-8 -left-4 w-8 h-8 bg-green-400 rounded-full flex items-center justify-center animate-bounce animation-delay-500">
                            <span class="text-green-900 text-xs">✨</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing Cards -->
        <section class="pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent mb-4">
                        Choose Your AI Learning Journey
                    </h2>
                    <p class="text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                        Each plan includes revolutionary AI Avatar teaching. Upgrade to unlock personalized learning experiences.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    
                    <!-- Free Plan -->
                    <div class="relative group bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl border border-slate-200/60 dark:border-slate-700/60 p-8 hover:shadow-2xl hover:shadow-purple-200/20 dark:hover:shadow-purple-900/20 transition-all duration-500 hover:-translate-y-2">
                        <!-- Plan Icon -->
                        <div class="absolute -top-6 left-8">
                            <div class="w-12 h-12 bg-gradient-to-br from-slate-400 to-slate-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.87 2 10l6.91-1.74L12 2z"/>
                                </svg>
                            </div>
                        </div>

                        <div class="pt-8 text-center mb-8">
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Starter</h3>
                            <div class="text-4xl font-bold text-slate-900 dark:text-white mb-4">
                                $0<span class="text-lg font-normal text-slate-600 dark:text-slate-400">/month</span>
                            </div>
                            <p class="text-slate-600 dark:text-slate-400">Perfect for exploring AI learning</p>
                        </div>
                        
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300">Basic AI Avatar sessions (5/month)</span>
                            </li>
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300">Access to basic tutorials</span>
                            </li>
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300">Community forum access</span>
                            </li>
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300">Code examples & snippets</span>
                            </li>
                        </ul>
                        
                        <button class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-600 text-slate-700 dark:text-slate-300 font-semibold hover:from-slate-200 hover:to-slate-300 dark:hover:from-slate-600 dark:hover:to-slate-500 transition-all duration-300 group-hover:shadow-lg">
                            Start Free Journey
                        </button>
                    </div>

                    <!-- Pro Plan (Most Popular) -->
                    <div class="relative group bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 backdrop-blur-xl rounded-3xl border-2 border-purple-300/60 dark:border-purple-600/60 p-8 hover:shadow-2xl hover:shadow-purple-500/30 dark:hover:shadow-purple-400/20 transition-all duration-500 hover:-translate-y-3 scale-105">
                        <!-- Popular Badge -->
                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                            <div class="flex items-center gap-2 bg-gradient-to-r from-purple-500 to-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded-full shadow-lg">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Most Popular
                            </div>
                        </div>

                        <!-- Plan Icon -->
                        <div class="absolute -top-6 left-8">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1L13.5 2.5L16.17 5.17L10.59 10.75C10.21 10.37 9.7 10.17 9.17 10.17H4C2.9 10.17 2 11.07 2 12.17V14.17H4V22H10V14.17H11V13C11 12.65 11.04 12.31 11.1 11.97L16.5 6.5L19 9H21ZM6 12.17H8V14.17H6V12.17Z"/>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="pt-8 text-center mb-8">
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent mb-2">AI Pro</h3>
                            <div class="text-4xl font-bold text-slate-900 dark:text-white mb-4">
                                $29<span class="text-lg font-normal text-slate-600 dark:text-slate-400">/month</span>
                            </div>
                            <p class="text-slate-600 dark:text-slate-400">Advanced AI-powered learning</p>
                        </div>
                        
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300"><strong>Unlimited AI Avatar sessions</strong></span>
                            </li>
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300">Personalized AI learning paths</span>
                            </li>
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300">Premium video tutorials</span>
                            </li>
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300">Real-time code analysis by AI</span>
                            </li>
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300">Priority support & ad-free</span>
                            </li>
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300">Monthly live AI Q&A sessions</span>
                            </li>
                        </ul>
                        
                        <button class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-semibold hover:from-purple-600 hover:to-indigo-700 transition-all duration-300 transform group-hover:scale-105 shadow-lg hover:shadow-xl">
                            Start AI Pro Trial
                        </button>
                    </div>

                    <!-- Enterprise Plan -->
                    <div class="relative group bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 backdrop-blur-xl rounded-3xl border border-amber-200/60 dark:border-amber-600/60 p-8 hover:shadow-2xl hover:shadow-amber-500/20 dark:hover:shadow-amber-400/10 transition-all duration-500 hover:-translate-y-2">
                        <!-- Plan Icon -->
                        <div class="absolute -top-6 left-8">
                            <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.87 2 10l6.91-1.74L12 2z"/>
                                </svg>
                            </div>
                        </div>

                        <div class="pt-8 text-center mb-8">
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent mb-2">Enterprise</h3>
                            <div class="text-4xl font-bold text-slate-900 dark:text-white mb-4">
                                $99<span class="text-lg font-normal text-slate-600 dark:text-slate-400">/month</span>
                            </div>
                            <p class="text-slate-600 dark:text-slate-400">Scale AI learning across your organization</p>
                        </div>
                        
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300"><strong>Everything in AI Pro</strong></span>
                            </li>
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300">Multiple AI Avatar trainers</span>
                            </li>
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300">Team progress analytics</span>
                            </li>
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300">Custom AI training models</span>
                            </li>
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300">API integration & SSO</span>
                            </li>
                            <li class="flex items-center">
                                <div class="w-5 h-5 bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-slate-700 dark:text-slate-300">24/7 dedicated support</span>
                            </li>
                        </ul>
                        
                        <button class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 text-white font-semibold hover:from-amber-600 hover:to-orange-700 transition-all duration-300 transform group-hover:scale-105 shadow-lg hover:shadow-xl">
                            Contact Sales Team
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Comparison -->
        <section class="py-24 bg-gradient-to-br from-purple-50/50 via-slate-50/30 to-indigo-50/50 dark:bg-gradient-to-br dark:from-purple-900/10 dark:via-slate-800/20 dark:to-indigo-900/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent mb-4">
                        AI Avatar Features Comparison
                    </h2>
                    <p class="text-xl text-slate-600 dark:text-slate-400">Discover how AI-powered learning scales with each plan</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl border border-slate-200/60 dark:border-slate-700/60 shadow-2xl">
                        <thead>
                            <tr class="border-b border-slate-200/60 dark:border-slate-700/60 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700">
                                <th class="text-left p-6 text-slate-900 dark:text-white font-semibold">AI Avatar Features</th>
                                <th class="text-center p-6 text-slate-600 dark:text-slate-400 font-semibold">Starter</th>
                                <th class="text-center p-6 bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent font-bold">AI Pro</th>
                                <th class="text-center p-6 bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent font-bold">Enterprise</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-slate-200/60 dark:border-slate-700/60 hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="p-6 text-slate-700 dark:text-slate-300 font-medium">AI Avatar Sessions</td>
                                <td class="p-6 text-center text-slate-600 dark:text-slate-400">5/month</td>
                                <td class="p-6 text-center">
                                    <span class="inline-flex items-center gap-1 text-purple-600 dark:text-purple-400 font-semibold">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Unlimited
                                    </span>
                                </td>
                                <td class="p-6 text-center">
                                    <span class="inline-flex items-center gap-1 text-amber-600 dark:text-amber-400 font-semibold">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Unlimited
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-slate-200/60 dark:border-slate-700/60 hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="p-6 text-slate-700 dark:text-slate-300 font-medium">Personalized Learning Paths</td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-slate-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-purple-500 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-amber-500 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </td>
                            </tr>
                            <tr class="border-b border-slate-200/60 dark:border-slate-700/60 hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="p-6 text-slate-700 dark:text-slate-300 font-medium">Real-time Code Analysis</td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-slate-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-purple-500 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-amber-500 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </td>
                            </tr>
                            <tr class="border-b border-slate-200/60 dark:border-slate-700/60 hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="p-6 text-slate-700 dark:text-slate-300 font-medium">Multiple AI Avatar Trainers</td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-slate-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-slate-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-amber-500 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="p-6 text-slate-700 dark:text-slate-300 font-medium">Custom AI Training Models</td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-slate-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-slate-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-amber-500 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-24">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent mb-4">
                        AI Avatar FAQ
                    </h2>
                    <p class="text-xl text-slate-600 dark:text-slate-400">Everything you need to know about AI-powered learning</p>
                </div>

                <div class="space-y-6">
                    <div class="group bg-gradient-to-r from-purple-50/50 to-indigo-50/50 dark:from-purple-900/20 dark:to-indigo-900/20 backdrop-blur-xl rounded-3xl border border-purple-200/60 dark:border-purple-700/60 p-8 hover:shadow-xl hover:shadow-purple-200/20 dark:hover:shadow-purple-900/20 transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2Z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-3">How does the AI Avatar teaching work?</h3>
                                <p class="text-slate-600 dark:text-slate-400">Our AI Avatar teachers use HeyGen technology to provide personalized, interactive coding sessions. Each avatar adapts to your learning pace and style, offering real-time feedback and guidance.</p>
                            </div>
                        </div>
                    </div>

                    <div class="group bg-gradient-to-r from-green-50/50 to-emerald-50/50 dark:from-green-900/20 dark:to-emerald-900/20 backdrop-blur-xl rounded-3xl border border-green-200/60 dark:border-green-700/60 p-8 hover:shadow-xl hover:shadow-green-200/20 dark:hover:shadow-green-900/20 transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-3">Can I try AI Avatar sessions before upgrading?</h3>
                                <p class="text-slate-600 dark:text-slate-400">Yes! The Starter plan includes 5 free AI Avatar sessions per month. You can also enjoy a 14-day free trial for AI Pro and Enterprise plans.</p>
                            </div>
                        </div>
                    </div>

                    <div class="group bg-gradient-to-r from-amber-50/50 to-orange-50/50 dark:from-amber-900/20 dark:to-orange-900/20 backdrop-blur-xl rounded-3xl border border-amber-200/60 dark:border-amber-700/60 p-8 hover:shadow-xl hover:shadow-amber-200/20 dark:hover:shadow-amber-900/20 transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-3">What payment methods are supported?</h3>
                                <p class="text-slate-600 dark:text-slate-400">We accept all major credit cards, PayPal, and bank transfers for Enterprise plans. All payments are secure and encrypted.</p>
                            </div>
                        </div>
                    </div>

                    <div class="group bg-gradient-to-r from-slate-50/50 to-zinc-50/50 dark:from-slate-900/20 dark:to-zinc-900/20 backdrop-blur-xl rounded-3xl border border-slate-200/60 dark:border-slate-700/60 p-8 hover:shadow-xl hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20 transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-gradient-to-br from-slate-500 to-zinc-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-3">Can I upgrade or downgrade my plan?</h3>
                                <p class="text-slate-600 dark:text-slate-400">Absolutely! You can change your plan at any time. Upgrades take effect immediately, while downgrades will be applied at your next billing cycle.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-gradient-to-r from-purple-500/10 via-indigo-500/10 to-purple-500/10 dark:from-purple-400/10 dark:via-indigo-400/10 dark:to-purple-400/10 relative overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0 bg-gradient-to-br from-purple-50/30 to-indigo-50/30 dark:from-purple-900/20 dark:to-indigo-900/20"></div>
            <div class="absolute top-0 left-1/4 w-64 h-64 bg-gradient-to-br from-purple-400/20 to-indigo-400/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-gradient-to-br from-indigo-400/20 to-purple-400/20 rounded-full blur-3xl"></div>
            
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <!-- Avatar Icon -->
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-3xl mb-8 shadow-xl">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1L13.5 2.5L16.17 5.17L10.59 10.75C10.21 10.37 9.7 10.17 9.17 10.17H4C2.9 10.17 2 11.07 2 12.17V14.17H4V22H10V14.17H11V13C11 12.65 11.04 12.31 11.1 11.97L16.5 6.5L19 9H21ZM6 12.17H8V14.17H6V12.17Z"/>
                    </svg>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-purple-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent mb-4">
                    Ready to Meet Your AI Teacher?
                </h2>
                <p class="text-xl text-slate-600 dark:text-slate-400 mb-8 max-w-2xl mx-auto">
                    Join thousands of developers who are revolutionizing their learning with AI Avatar technology. Start your personalized coding journey today.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="group py-4 px-8 rounded-xl bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-semibold hover:from-purple-600 hover:to-indigo-700 transition-all transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 group-hover:animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                        </svg>
                        Start AI Learning Now
                    </button>
                    <button class="py-4 px-8 rounded-xl bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl text-slate-700 dark:text-slate-300 font-semibold hover:bg-white/90 dark:hover:bg-slate-800/90 transition-all border border-slate-200/60 dark:border-slate-700/60 hover:shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Watch AI Demo
                    </button>
                </div>
                
                <!-- Trust Indicators -->
                <div class="mt-12 flex items-center justify-center gap-8 text-slate-500 dark:text-slate-400">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">14-day free trial</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">No credit card required</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">Cancel anytime</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <x-shared.footer :top-lessons="$topLessons" />

    <x-shared.mobile-nav-script />
</div>