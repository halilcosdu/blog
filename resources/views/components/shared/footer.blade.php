@props(['topLessons' => collect()])

<!-- Footer -->
<footer class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-gradient-to-br from-purple-600/10 to-indigo-600/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-gradient-to-br from-red-600/10 to-orange-600/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-16">
            
            <!-- Brand & Description -->
            <div class="md:col-span-2">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-r from-red-600 to-orange-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                        <svg class="w-6 h-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <span class="text-3xl font-bold bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent">phpuzem</span>
                </div>
                <p class="text-slate-300 leading-relaxed text-lg mb-6 max-w-md">
                    Master Laravel development with AI-powered learning. From fundamentals to advanced concepts, 
                    <span class="font-semibold text-purple-400">your AI Avatar teacher</span> guides you every step of the way.
                </p>
                
                <!-- Social Links with improved styling -->
                <div class="flex items-center gap-3">
                    <a href="#" class="group w-11 h-11 rounded-xl bg-slate-800/60 hover:bg-purple-600/20 border border-slate-700/50 hover:border-purple-500/50 flex items-center justify-center transition-all duration-300 hover:-translate-y-1" aria-label="X">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-purple-400 transition-colors" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.244 2H21l-6.5 7.43L22.5 22H15.9l-4.8-6.2L5.5 22H2.744l7.07-8.08L1.5 2h6.76l4.31 5.6L18.244 2zm-2.34 18h1.38L8.22 4h-1.4l9.083 16z"/>
                        </svg>
                    </a>
                    <a href="#" class="group w-11 h-11 rounded-xl bg-slate-800/60 hover:bg-red-600/20 border border-slate-700/50 hover:border-red-500/50 flex items-center justify-center transition-all duration-300 hover:-translate-y-1" aria-label="YouTube">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-red-400 transition-colors" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.5 6.2a3 3 0 00-2.1-2.1C19.6 3.5 12 3.5 12 3.5s-7.6 0-9.4.6A3 3 0 00.5 6.2 31.5 31.5 0 000 12a31.5 31.5 0 00.5 5.8 3 3 0 002.1 2.1c1.8.6 9.4.6 9.4.6s7.6 0 9.4-.6a3 3 0 002.1-2.1A31.5 31.5 0 0024 12a31.5 31.5 0 00-.5-5.8zM9.75 15.5v-7L15.5 12l-5.75 3.5z"/>
                        </svg>
                    </a>
                    <a href="#" class="group w-11 h-11 rounded-xl bg-slate-800/60 hover:bg-gray-600/20 border border-slate-700/50 hover:border-gray-500/50 flex items-center justify-center transition-all duration-300 hover:-translate-y-1" aria-label="GitHub">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-gray-300 transition-colors" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 .5A12 12 0 000 12.7c0 5.37 3.44 9.93 8.2 11.54.6.13.82-.26.82-.58v-2.17c-3.34.75-4.05-1.6-4.05-1.6-.55-1.43-1.35-1.81-1.35-1.81-1.1-.77.08-.75.08-.75 1.22.09 1.86 1.26 1.86 1.26 1.08 1.89 2.83 1.35 3.52 1.03.11-.8.42-1.35.76-1.66-2.67-.31-5.49-1.38-5.49-6.14 0-1.36.46-2.46 1.23-3.32-.12-.3-.53-1.55.12-3.24 0 0 1.01-.33 3.3 1.26a11.3 11.3 0 016.01 0c2.29-1.6 3.3-1.26 3.3-1.26.65 1.69.24 2.94.12 3.24.77.86 1.23 1.96 1.23 3.32 0 4.78-2.83 5.82-5.52 6.13.43.37.81 1.1.81 2.22v3.3c0 .32.21.71.82.58A12.1 12.1 0 0024 12.7 12 12 0 0012 .5z"/>
                        </svg>
                    </a>
                    <a href="#" class="group w-11 h-11 rounded-xl bg-slate-800/60 hover:bg-pink-600/20 border border-slate-700/50 hover:border-pink-500/50 flex items-center justify-center transition-all duration-300 hover:-translate-y-1" aria-label="Instagram">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-pink-400 transition-colors" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm0 2a3 3 0 00-3 3v10a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H7zm5 3.5A5.5 5.5 0 1111.999 19.5 5.5 5.5 0 0112 7.5zm0 2A3.5 3.5 0 1015.5 13 3.5 3.5 0 0012 9.5zM18 6.75a1.25 1.25 0 11-1.25 1.25A1.25 1.25 0 0118 6.75z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-bold mb-6 bg-gradient-to-r from-purple-400 to-indigo-400 bg-clip-text text-transparent">Platform</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 group">
                        <svg class="w-4 h-4 text-orange-500 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        Home
                    </a></li>
                    <li><a href="/posts" class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 group">
                        <svg class="w-4 h-4 text-blue-500 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"/>
                        </svg>
                        Posts
                    </a></li>
                    <li><a href="{{ route('watch') }}" class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 group">
                        <svg class="w-4 h-4 text-green-500 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                        </svg>
                        Watch
                    </a></li>
                    <li><a href="/discussions" class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 group">
                        <svg class="w-4 h-4 text-yellow-500 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                        </svg>
                        Discussions
                    </a></li>
                    <li><a href="/avatar" class="text-slate-400 hover:text-purple-400 transition-colors flex items-center gap-2 group">
                        <div class="relative">
                            <svg class="w-4 h-4 text-purple-500 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2Z"/>
                            </svg>
                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center">
                                <svg class="w-1.5 h-1.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <span>AI Avatar</span>
                            <div class="text-xs text-purple-400 font-medium">Premium</div>
                        </div>
                    </a></li>
                </ul>
            </div>

            <!-- Learning Paths -->
            <div>
                <h4 class="text-lg font-bold mb-6 bg-gradient-to-r from-green-400 to-emerald-400 bg-clip-text text-transparent">Learning</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('pricing') }}" class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 group">
                        <svg class="w-4 h-4 text-amber-500 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Pricing Plans
                    </a></li>
                    <li><a href="/sponsors" class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 group">
                        <svg class="w-4 h-4 text-pink-500 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                        Sponsors
                    </a></li>
                    <li><a href="#" class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 group">
                        <svg class="w-4 h-4 text-indigo-500 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z" clip-rule="evenodd"/>
                        </svg>
                        Announcements
                    </a></li>
                    <li><a href="#" class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 group">
                        <svg class="w-4 h-4 text-cyan-500 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Help Center
                    </a></li>
                </ul>
            </div>
        </div>

        <!-- Top Lessons Section -->
        @if($topLessons->isNotEmpty())
        <div class="mb-16">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <h4 class="text-2xl font-bold bg-gradient-to-r from-orange-400 to-red-400 bg-clip-text text-transparent">Popular Lessons</h4>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($topLessons->take(10) as $t)
                    <a href="{{ route('watch.lessons.show', ['slug' => $t->slug]) }}" class="group block rounded-2xl border border-slate-700/60 bg-slate-800/40 overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-orange-500/10 hover:border-orange-500/40 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-500/0 to-red-500/0 group-hover:from-orange-500/10 group-hover:to-red-500/10 transition-all duration-300 rounded-2xl"></div>
                        <div class="relative">
                        <div class="aspect-video overflow-hidden rounded-t-2xl relative">
                            <img src="{{ $t->thumbnail }}" alt="{{ $t->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                                        <svg class="w-5 h-5 text-slate-900 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                </div>

                                @if($t->duration_minutes)
                                <div class="absolute bottom-3 right-3 px-2 py-1 bg-black/80 backdrop-blur-sm text-white text-xs font-medium rounded-lg">
                                    {{ $t->duration_minutes }}m
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="text-sm font-semibold text-slate-100 line-clamp-2 group-hover:text-white transition-colors mb-2">{{ $t->title }}</div>
                            <div class="flex items-center gap-2 text-xs text-slate-400">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ number_format($t->views_count ?? 0) }}
                                </span>
                                @if($t->category)
                                <span>•</span>
                                <span class="text-orange-400">{{ $t->category->name }}</span>
                                @endif
                            </div>
                        </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Newsletter -->
        <div class="relative bg-gradient-to-r from-purple-900/20 via-indigo-900/20 to-purple-900/20 backdrop-blur-xl rounded-3xl border border-purple-500/20 p-8 overflow-hidden">
            <!-- Background decoration -->
            <div class="absolute inset-0 bg-gradient-to-br from-purple-600/10 to-indigo-600/10 rounded-3xl"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/20 to-indigo-500/20 rounded-full blur-2xl"></div>
            
            <div class="relative grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <h5 class="text-xl font-bold bg-gradient-to-r from-purple-400 to-indigo-400 bg-clip-text text-transparent">Unlock Premium AI Learning</h5>
                    </div>
                    <p class="text-slate-300 text-sm">Get exclusive updates about <span class="font-semibold text-purple-400">AI Avatar Teacher</span> premium features, early access to new content, and special discounts for Pro subscribers.</p>
                </div>
                <form class="flex gap-3">
                    <input type="email" placeholder="Enter your email"
                           class="flex-1 px-4 py-3 rounded-xl bg-slate-900/60 backdrop-blur-sm border border-slate-700/60 text-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500/40 focus:border-purple-500/60 transition-all">
                    <button type="submit" class="px-6 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-indigo-600 font-semibold text-white hover:from-purple-600 hover:to-indigo-700 hover:shadow-lg hover:shadow-purple-500/25 transition-all transform hover:scale-105">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="mt-16 flex flex-col gap-6">
            <!-- Tech Stack & Features -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-4 border border-slate-700/40">
                    <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-orange-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.61 12c0 6.627-5.373 12-12 12S-.39 18.627-.39 12 4.983 0 11.61 0s12 5.373 12 12zm-4.115-6.485L11.61 17.4 5.115 5.515h13.38z"/>
                        </svg>
                    </div>
                    <p class="text-red-400 font-semibold text-sm">Laravel</p>
                    <p class="text-slate-500 text-xs">Framework</p>
                </div>
                <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-4 border border-slate-700/40">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.04c-5.5 0-9.96 4.46-9.96 9.96 0 5.5 4.46 9.96 9.96 9.96 5.5 0 9.96-4.46 9.96-9.96 0-5.5-4.46-9.96-9.96-9.96zm4.43 8.65l-4.75 4.75c-.39.39-1.02.39-1.41 0l-2.34-2.34c-.39-.39-.39-1.02 0-1.41.39-.39 1.02-.39 1.41 0l1.63 1.63 4.04-4.04c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02.01 1.41z"/>
                        </svg>
                    </div>
                    <p class="text-blue-400 font-semibold text-sm">Livewire</p>
                    <p class="text-slate-500 text-xs">Interactive</p>
                </div>
                <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-4 border border-slate-700/40">
                    <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2Z"/>
                        </svg>
                    </div>
                    <p class="text-purple-400 font-semibold text-sm">AI Avatar</p>
                    <p class="text-slate-500 text-xs">Powered</p>
                </div>
                <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-4 border border-slate-700/40">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="text-green-400 font-semibold text-sm">Secure</p>
                    <p class="text-slate-500 text-xs">& Fast</p>
                </div>
            </div>

            <!-- Copyright & Links -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 border-t border-slate-700/50 pt-8 text-slate-400 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-gradient-to-r from-red-600 to-orange-500 rounded-lg flex items-center justify-center">
                        <svg class="w-3 h-3 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <p>© {{ date('Y') }} <span class="font-semibold text-white">phpuzem</span>. All rights reserved.</p>
                </div>
                
                <div class="flex flex-wrap items-center justify-center gap-6">
                    <a href="/privacy" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="/terms" class="hover:text-white transition-colors">Terms of Service</a>
                    <div class="flex items-center gap-3 pl-6 border-l border-slate-700/50">
                        <span class="text-xs">We accept:</span>
                        <div class="flex items-center gap-2">
                            <div class="px-3 py-1 rounded-lg bg-slate-800/60 border border-slate-700/60 text-xs font-medium">💳 Visa</div>
                            <div class="px-3 py-1 rounded-lg bg-slate-800/60 border border-slate-700/60 text-xs font-medium">💳 MC</div>
                            <div class="px-3 py-1 rounded-lg bg-slate-800/60 border border-slate-700/60 text-xs font-medium">💳 Amex</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
