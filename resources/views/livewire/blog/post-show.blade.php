<div class="min-h-screen bg-white dark:bg-gray-900">

    <x-shared.header current-page="posts" />
    <x-shared.announcements />

    <!-- Main Content -->
    <main class="relative py-16 sm:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Article -->
            <article>
                <!-- Header -->
                <header class="mb-12 text-center">
                    <!-- Category -->
                    <a href="/category/{{ $post->category->slug }}" class="text-base font-semibold text-red-600 dark:text-red-400 uppercase tracking-wider hover:underline">
                        {{ $post->category->name }}
                    </a>

                    <!-- Title -->
                    <h1 class="mt-4 text-4xl md:text-6xl font-extrabold text-gray-900 dark:text-white leading-tight tracking-tighter">
                        {{ $post->title }}
                    </h1>

                    <!-- Meta -->
                    <div class="mt-8 flex items-center justify-center space-x-6 text-sm text-gray-500 dark:text-gray-400">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-red-500 to-orange-400 flex items-center justify-center text-white font-bold">
                                {{ substr($post->user->name, 0, 1) }}
                            </div>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $post->user->name }}</span>
                        </div>
                        <span class="text-gray-400 dark:text-gray-600">|</span>
                        <span>{{ $post->published_at->format('F j, Y') }}</span>
                        <span class="text-gray-400 dark:text-gray-600">|</span>
                        <span>{{ $post->reading_time }}</span>
                        <span class="text-gray-400 dark:text-gray-600">|</span>
                        <span>{{ number_format($post->views_count) }} views</span>
                    </div>

                    <!-- Share Button -->
                    <div x-data="{
                        copied: false,
                        sharePost() {
                            const shareData = {
                                title: '{{ addslashes($post->title) }}',
                                text: '{{ addslashes($post->excerpt ?? '') }}',
                                url: '{{ url()->current() }}',
                            };

                            if (navigator.share && navigator.canShare(shareData)) {
                                navigator.share(shareData).catch((err) => {
                                    if (err.name !== 'AbortError') {
                                        console.error('Share failed:', err);
                                    }
                                });
                            } else {
                                navigator.clipboard.writeText(shareData.url);
                                this.copied = true;
                                setTimeout(() => { this.copied = false }, 2000);
                            }
                        }
                    }" class="mt-8 flex justify-center">
                        <button @click="sharePost"
                                class="relative w-36 h-11 inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-100 dark:bg-slate-800 rounded-full text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-slate-900 overflow-hidden">
                            <span :class="{ '-translate-y-full opacity-0': copied }" class="flex items-center gap-2 transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"/></svg>
                                <span>Share Post</span>
                            </span>
                            <span x-cloak :class="{ 'translate-y-0 opacity-100': copied, 'translate-y-full opacity-0': !copied }" class="absolute inset-0 flex items-center justify-center transition-all duration-300">
                                Link Copied!
                            </span>
                        </button>
                    </div>
                </header>

                <!-- Featured Image -->
                @if($post->featured_image)
                <figure class="mb-12 rounded-3xl overflow-hidden shadow-2xl">
                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                         class="w-full h-auto object-cover transition-transform duration-300 hover:scale-105">
                </figure>
                @endif

                <!-- Article Body -->
                <div class="prose prose-lg lg:prose-xl prose-gray dark:prose-invert max-w-none mx-auto">
                    {!! $post->content !!}
                </div>

                <!-- Tags -->
                @if($post->tags && count($post->tags) > 0)
                <div class="mt-16 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex flex-wrap items-center gap-3">
                        <h3 class="text-sm font-semibold text-gray-600 dark:text-gray-400 mr-2">Tags:</h3>
                        @foreach($post->tags as $tag)
                        <span class="inline-block bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-sm font-medium px-4 py-2 rounded-full hover:bg-red-100 dark:hover:bg-red-900/50 hover:text-red-700 dark:hover:text-red-300 transition-colors duration-200 cursor-pointer">
                            <a href="/tags/{{ $tag->slug }}"> #{{ $tag->name }}</a>
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

            </article>
        </div>

        <!-- Related Posts -->
        @if($relatedPosts->count() > 0)
        <section class="mt-24 pt-16 border-t border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">
                    Related Posts
                </h2>
                <div class="grid md:grid-cols-3 gap-x-8 gap-y-12">
                    @foreach($relatedPosts as $relatedPost)
                    <x-blog.post-card :post="$relatedPost" />
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </main>

    <x-shared.footer :top-lessons="$topLessons" />
    <x-shared.mobile-nav-script />
</div>
