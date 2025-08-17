@props(['topLessons' => collect()])

<!-- Footer -->
<footer class="bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            <!-- Brand -->
            <div class="md:col-span-4">
                <div class="flex items-center mb-6">
                    <div class="w-8 h-8 bg-gradient-to-r from-red-600 to-orange-500 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/></svg>
                    </div>
                    <span class="text-2xl font-bold">phpuzem</span>
                </div>
                <p class="text-slate-400 leading-relaxed">
                    Practical screencasts and complete learning paths for modern PHP & Laravel development.
                    Learn by building real projects, at your own pace.
                </p>
                <div class="mt-6 flex items-center gap-3 text-slate-400">
                    <!-- X (formerly Twitter) -->
                    <a href="#" class="w-9 h-9 rounded-lg bg-slate-800/80 hover:bg-slate-700/80 grid place-items-center transition-colors cursor-pointer" aria-label="X">
                        <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2H21l-6.5 7.43L22.5 22H15.9l-4.8-6.2L5.5 22H2.744l7.07-8.08L1.5 2h6.76l4.31 5.6L18.244 2zm-2.34 18h1.38L8.22 4h-1.4l9.083 16z"/></svg>
                    </a>
                    <!-- YouTube -->
                    <a href="#" class="w-9 h-9 rounded-lg bg-slate-800/80 hover:bg-slate-700/80 grid place-items-center transition-colors cursor-pointer" aria-label="YouTube">
                        <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 6.2a3 3 0 00-2.1-2.1C19.6 3.5 12 3.5 12 3.5s-7.6 0-9.4.6A3 3 0 00.5 6.2 31.5 31.5 0 000 12a31.5 31.5 0 00.5 5.8 3 3 0 002.1 2.1c1.8.6 9.4.6 9.4.6s7.6 0 9.4-.6a3 3 0 002.1-2.1A31.5 31.5 0 0024 12a31.5 31.5 0 00-.5-5.8zM9.75 15.5v-7L15.5 12l-5.75 3.5z"/></svg>
                    </a>
                    <!-- GitHub -->
                    <a href="#" class="w-9 h-9 rounded-lg bg-slate-800/80 hover:bg-slate-700/80 grid place-items-center transition-colors cursor-pointer" aria-label="GitHub">
                        <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .5A12 12 0 000 12.7c0 5.37 3.44 9.93 8.2 11.54.6.13.82-.26.82-.58v-2.17c-3.34.75-4.05-1.6-4.05-1.6-.55-1.43-1.35-1.81-1.35-1.81-1.1-.77.08-.75.08-.75 1.22.09 1.86 1.26 1.86 1.26 1.08 1.89 2.83 1.35 3.52 1.03.11-.8.42-1.35.76-1.66-2.67-.31-5.49-1.38-5.49-6.14 0-1.36.46-2.46 1.23-3.32-.12-.3-.53-1.55.12-3.24 0 0 1.01-.33 3.3 1.26a11.3 11.3 0 016.01 0c2.29-1.6 3.3-1.26 3.3-1.26.65 1.69.24 2.94.12 3.24.77.86 1.23 1.96 1.23 3.32 0 4.78-2.83 5.82-5.52 6.13.43.37.81 1.1.81 2.22v3.3c0 .32.21.71.82.58A12.1 12.1 0 0024 12.7 12 12 0 0012 .5z"/></svg>
                    </a>
                    <!-- Instagram -->
                    <a href="#" class="w-9 h-9 rounded-lg bg-slate-800/80 hover:bg-slate-700/80 grid place-items-center transition-colors cursor-pointer" aria-label="Instagram">
                        <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm0 2a3 3 0 00-3 3v10a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H7zm5 3.5A5.5 5.5 0 1111.999 19.5 5.5 5.5 0 0112 7.5zm0 2A3.5 3.5 0 1015.5 13 3.5 3.5 0 0012 9.5zM18 6.75a1.25 1.25 0 11-1.25 1.25A1.25 1.25 0 0118 6.75z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Top Lessons (horizontal) -->
            @if($topLessons->isNotEmpty())
            <div class="md:col-span-4">
                <h4 class="text-lg font-bold mb-6">Top Lessons</h4>
                <div id="footer-top-lessons" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                    @foreach($topLessons->take(10) as $t)
                        <a href="/posts/{{ $t->slug }}" class="group rounded-xl border border-slate-800/80 bg-slate-800/40 hover:bg-orange-500/20 hover:border-orange-500/40 transition-colors cursor-pointer">
                            <div class="aspect-video overflow-hidden rounded-t-xl relative">
                                <img src="{{ $t->featured_image }}" alt="{{ $t->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                
                                <!-- Video Play Overlay -->
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors">
                                    <!-- Play Button -->
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-10 h-10 bg-white/90 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                                            <svg class="w-4 h-4 text-slate-900 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    
                                    <!-- Video Duration -->
                                    @if($t->reading_time)
                                    <div class="absolute bottom-2 right-2 px-2 py-1 bg-black/80 text-white text-xs font-medium rounded">
                                        {{ $t->reading_time }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="text-sm font-semibold text-slate-100 line-clamp-2 group-hover:text-white transition-colors">{{ $t->title }}</div>
                                <div class="mt-1 flex items-center gap-2 text-[12px] text-slate-400">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ number_format($t->views_count ?? 0) }} views
                                    </span>
                                    @if($t->category)
                                    <span>•</span>
                                    <span>{{ $t->category->name }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Newsletter -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 items-center rounded-2xl border border-slate-800/80 bg-slate-800/40 p-6">
            <div class="md:col-span-2">
                <h5 class="text-lg font-semibold">Stay in the loop</h5>
                <p class="text-slate-400 text-sm mt-1">Get new lessons, series releases, and discounts straight to your inbox.</p>
            </div>
            <form class="flex gap-3">
                <input type="email" placeholder="Your email"
                       class="flex-1 px-4 py-3 rounded-xl bg-slate-900/60 border border-slate-700/80 text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500/50">
                <button type="submit" class="px-5 py-3 rounded-xl bg-gradient-to-r from-red-600 to-orange-500 font-semibold hover:shadow-lg hover:shadow-red-500/20 transition cursor-pointer">Subscribe</button>
            </form>
        </div>

        <div class="mt-10 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-slate-800 pt-6 text-slate-400 text-sm">
            <p>© {{ date('Y') }} phpuzem. All rights reserved.</p>
            <div class="flex items-center gap-4">
                <a href="/privacy" class="hover:text-white transition cursor-pointer">Privacy</a>
                <a href="/terms" class="hover:text-white transition cursor-pointer">Terms</a>
                <span class="hidden sm:inline">·</span>
                <span>Built with <span class="text-red-400">Laravel</span> & <span class="text-blue-400">Livewire</span></span>
                <span class="hidden sm:inline">·</span>
                <div class="flex items-center gap-2 opacity-80">
                    <span class="text-[11px]">We accept</span>
                    <span class="px-2 py-0.5 rounded bg-slate-800 border border-slate-700 text-[11px]">Visa</span>
                    <span class="px-2 py-0.5 rounded bg-slate-800 border border-slate-700 text-[11px]">Mastercard</span>
                    <span class="px-2 py-0.5 rounded bg-slate-800 border border-slate-700 text-[11px]">Amex</span>
                </div>
            </div>
        </div>
    </div>
</footer>