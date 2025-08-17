<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
    
    <x-shared.header current-page="posts" />
    <x-shared.announcements />

    <!-- Main Content -->
    <main class="relative">
        <!-- Article Header -->
        <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm text-slate-600 dark:text-slate-400">
                    <li><a href="{{ route('home') }}" class="hover:text-red-600 dark:hover:text-red-400">Home</a></li>
                    <li><span>/</span></li>
                    <li><a href="/posts" class="hover:text-red-600 dark:hover:text-red-400">Posts</a></li>
                    <li><span>/</span></li>
                    <li><a href="/category/{{ $post->category->slug }}" class="hover:text-red-600 dark:hover:text-red-400">{{ $post->category->name }}</a></li>
                    <li><span>/</span></li>
                    <li class="text-slate-500 dark:text-slate-400 truncate">{{ $post->title }}</li>
                </ol>
            </nav>

            <!-- Article Header -->
            <header class="mb-12">
                <div class="mb-6">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                        {{ $post->category->name }}
                    </span>
                </div>
                
                <h1 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white mb-6 leading-tight">
                    {{ $post->title }}
                </h1>
                
                @if($post->excerpt)
                <p class="text-xl text-slate-600 dark:text-slate-400 mb-8 leading-relaxed">
                    {{ $post->excerpt }}
                </p>
                @endif

                <!-- Author & Meta -->
                <div class="flex items-center justify-between py-6 border-y border-slate-200 dark:border-slate-700">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-red-600 to-orange-500 flex items-center justify-center text-white font-bold text-lg">
                            {{ substr($post->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900 dark:text-white">{{ $post->user->name }}</p>
                            <p class="text-sm text-slate-600 dark:text-slate-400">{{ $post->published_at->format('F j, Y') }} • {{ $post->reading_time }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4 text-sm text-slate-600 dark:text-slate-400">
                        <span>{{ number_format($post->views_count) }} views</span>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            @if($post->featured_image)
            <div class="mb-12">
                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" 
                     class="w-full h-96 object-cover rounded-2xl shadow-lg">
            </div>
            @endif

            <!-- Article Content -->
            <div class="prose prose-lg prose-slate dark:prose-invert max-w-none">
                {!! $post->content !!}
            </div>

            <!-- Tags -->
            @if($post->tags && count($post->tags) > 0)
            <div class="mt-12 pt-8 border-t border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($post->tags as $tag)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        #{{ $tag }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif
        </article>

        <!-- Related Posts -->
        @if($relatedPosts->count() > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 border-t border-slate-200 dark:border-slate-700">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-8">Related Posts</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($relatedPosts as $relatedPost)
                <article class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden hover:shadow-lg transition-shadow">
                    @if($relatedPost->featured_image)
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ $relatedPost->featured_image }}" alt="{{ $relatedPost->title }}" 
                             class="w-full h-full object-cover">
                    </div>
                    @endif
                    <div class="p-6">
                        <div class="mb-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                {{ $relatedPost->category->name }}
                            </span>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2 line-clamp-2">
                            <a href="/posts/{{ $relatedPost->slug }}" class="hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                {{ $relatedPost->title }}
                            </a>
                        </h3>
                        @if($relatedPost->excerpt)
                        <p class="text-slate-600 dark:text-slate-400 text-sm mb-4 line-clamp-2">
                            {{ $relatedPost->excerpt }}
                        </p>
                        @endif
                        <div class="flex items-center justify-between text-sm text-slate-500 dark:text-slate-400">
                            <span>{{ $relatedPost->user->name }}</span>
                            <span>{{ $relatedPost->reading_time }}</span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </section>
        @endif
    </main>

    <x-shared.footer />
    <x-shared.mobile-nav-script />
</div>