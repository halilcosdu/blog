@props(['post'])

<article class="bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-200/80 dark:border-gray-700/60 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
    @if($post->featured_image)
    <a href="/posts/{{ $post->slug }}" class="block aspect-video overflow-hidden">
        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
    </a>
    @endif
    <div class="p-6">
        <div class="mb-3">
            <a href="/category/{{ $post->category->slug }}" class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900 transition-colors">
                {{ $post->category->name }}
            </a>
        </div>
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2 line-clamp-2">
            <a href="/posts/{{ $post->slug }}" class="hover:text-red-600 dark:hover:text-red-400 transition-colors">
                {{ $post->title }}
            </a>
        </h3>
        @if($post->excerpt)
        <p class="text-slate-600 dark:text-slate-400 text-sm mb-4 line-clamp-3">
            {{ $post->excerpt }}
        </p>
        @endif
        <div class="flex items-center justify-between text-sm text-slate-500 dark:text-slate-400 mt-4 pt-4 border-t border-slate-200 dark:border-slate-700">
            <span class="font-medium">{{ $post->user->name }}</span>
            <span>{{ $post->reading_time }}</span>
        </div>
    </div>
</article>