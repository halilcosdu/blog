<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
    
    <x-shared.header current-page="pricing" />

    <x-shared.announcements />

    <!-- Main Content -->
    <main class="relative">
        <!-- Hero Section -->
        <section class="relative pt-16 pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="mx-auto max-w-4xl">
                    <h1 class="text-4xl md:text-6xl font-bold bg-gradient-to-r from-slate-900 via-slate-700 to-slate-900 dark:from-white dark:via-slate-200 dark:to-white bg-clip-text text-transparent mb-6">
                        Choose Your Learning Plan
                    </h1>
                    <p class="text-xl text-slate-600 dark:text-slate-400 mb-8 max-w-2xl mx-auto">
                        Unlock premium content, exclusive tutorials, and personalized learning paths. Start your coding journey today.
                    </p>
                </div>
            </div>
        </section>

        <!-- Pricing Cards -->
        <section class="pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    
                    <!-- Free Plan -->
                    <div class="relative bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-8 hover:shadow-2xl hover:shadow-slate-200/50 dark:hover:shadow-slate-900/50 transition-all duration-300">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Free</h3>
                            <div class="text-4xl font-bold text-slate-900 dark:text-white mb-4">
                                $0<span class="text-lg font-normal text-slate-600 dark:text-slate-400">/month</span>
                            </div>
                            <p class="text-slate-600 dark:text-slate-400">Perfect for getting started</p>
                        </div>
                        
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">Access to basic tutorials</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">Community forum access</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">Weekly newsletter</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">Code examples & snippets</span>
                            </li>
                        </ul>
                        
                        <button class="w-full py-3 px-6 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                            Get Started Free
                        </button>
                    </div>

                    <!-- Pro Plan (Most Popular) -->
                    <div class="relative bg-gradient-to-br from-orange-500/20 to-red-500/20 dark:from-orange-400/20 dark:to-red-400/20 backdrop-blur-xl rounded-2xl border border-orange-200/60 dark:border-orange-700/60 p-8 hover:shadow-2xl hover:shadow-orange-200/50 dark:hover:shadow-orange-900/50 transition-all duration-300 scale-105">
                        <!-- Popular Badge -->
                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                            <span class="bg-gradient-to-r from-orange-500 to-red-500 text-white text-sm font-semibold px-4 py-2 rounded-full">
                                Most Popular
                            </span>
                        </div>
                        
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Pro</h3>
                            <div class="text-4xl font-bold text-slate-900 dark:text-white mb-4">
                                $29<span class="text-lg font-normal text-slate-600 dark:text-slate-400">/month</span>
                            </div>
                            <p class="text-slate-600 dark:text-slate-400">For serious learners</p>
                        </div>
                        
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">Everything in Free</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">Premium video tutorials</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">Downloadable source code</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">Priority support</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">Ad-free experience</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">Monthly Q&A sessions</span>
                            </li>
                        </ul>
                        
                        <button class="w-full py-3 px-6 rounded-xl bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold hover:from-orange-600 hover:to-red-600 transition-all transform hover:scale-105">
                            Start Pro Trial
                        </button>
                    </div>

                    <!-- Enterprise Plan -->
                    <div class="relative bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-8 hover:shadow-2xl hover:shadow-slate-200/50 dark:hover:shadow-slate-900/50 transition-all duration-300">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Enterprise</h3>
                            <div class="text-4xl font-bold text-slate-900 dark:text-white mb-4">
                                $99<span class="text-lg font-normal text-slate-600 dark:text-slate-400">/month</span>
                            </div>
                            <p class="text-slate-600 dark:text-slate-400">For teams and organizations</p>
                        </div>
                        
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">Everything in Pro</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">Team management tools</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">Custom learning paths</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">1-on-1 mentoring sessions</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">API access</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300">24/7 dedicated support</span>
                            </li>
                        </ul>
                        
                        <button class="w-full py-3 px-6 rounded-xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-semibold hover:bg-slate-800 dark:hover:bg-slate-100 transition-colors">
                            Contact Sales
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Comparison -->
        <section class="py-24 bg-slate-50/50 dark:bg-slate-800/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mb-4">Compare Plans</h2>
                    <p class="text-xl text-slate-600 dark:text-slate-400">See what's included in each plan</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60">
                        <thead>
                            <tr class="border-b border-slate-200/60 dark:border-slate-700/60">
                                <th class="text-left p-6 text-slate-900 dark:text-white font-semibold">Features</th>
                                <th class="text-center p-6 text-slate-900 dark:text-white font-semibold">Free</th>
                                <th class="text-center p-6 text-orange-600 dark:text-orange-400 font-semibold">Pro</th>
                                <th class="text-center p-6 text-slate-900 dark:text-white font-semibold">Enterprise</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-slate-200/60 dark:border-slate-700/60">
                                <td class="p-6 text-slate-700 dark:text-slate-300">Basic Tutorials</td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </td>
                            </tr>
                            <tr class="border-b border-slate-200/60 dark:border-slate-700/60">
                                <td class="p-6 text-slate-700 dark:text-slate-300">Premium Video Content</td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-slate-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </td>
                            </tr>
                            <tr class="border-b border-slate-200/60 dark:border-slate-700/60">
                                <td class="p-6 text-slate-700 dark:text-slate-300">Source Code Downloads</td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-slate-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </td>
                                <td class="p-6 text-center">
                                    <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </td>
                            </tr>
                            <tr class="border-b border-slate-200/60 dark:border-slate-700/60">
                                <td class="p-6 text-slate-700 dark:text-slate-300">Team Management</td>
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
                                    <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-6 text-slate-700 dark:text-slate-300">1-on-1 Mentoring</td>
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
                                    <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
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
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mb-4">Frequently Asked Questions</h2>
                    <p class="text-xl text-slate-600 dark:text-slate-400">Get answers to common questions about our pricing plans</p>
                </div>

                <div class="space-y-8">
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-4">Can I switch plans anytime?</h3>
                        <p class="text-slate-600 dark:text-slate-400">Yes, you can upgrade or downgrade your plan at any time. Changes will be reflected in your next billing cycle.</p>
                    </div>

                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-4">Is there a free trial for Pro plans?</h3>
                        <p class="text-slate-600 dark:text-slate-400">Yes, we offer a 14-day free trial for all Pro and Enterprise plans. No credit card required to start.</p>
                    </div>

                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-4">What payment methods do you accept?</h3>
                        <p class="text-slate-600 dark:text-slate-400">We accept all major credit cards, PayPal, and bank transfers for Enterprise plans.</p>
                    </div>

                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-4">Do you offer refunds?</h3>
                        <p class="text-slate-600 dark:text-slate-400">Yes, we offer a 30-day money-back guarantee for all paid plans. Contact support for refund requests.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-gradient-to-r from-orange-500/10 to-red-500/10 dark:from-orange-400/10 dark:to-red-400/10">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mb-4">Ready to Start Learning?</h2>
                <p class="text-xl text-slate-600 dark:text-slate-400 mb-8">Join thousands of developers who are accelerating their careers with CodeBlog</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="py-3 px-8 rounded-xl bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold hover:from-orange-600 hover:to-red-600 transition-all transform hover:scale-105">
                        Start Free Trial
                    </button>
                    <button class="py-3 px-8 rounded-xl bg-white/60 dark:bg-slate-800/60 text-slate-700 dark:text-slate-300 font-semibold hover:bg-white/80 dark:hover:bg-slate-800/80 transition-colors">
                        View Demo
                    </button>
                </div>
            </div>
        </section>
    </main>

    <x-shared.footer :top-lessons="$topLessons" />

    <x-shared.mobile-nav-script />
</div>