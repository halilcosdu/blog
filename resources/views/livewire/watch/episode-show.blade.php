<div>
    {{-- Header --}}
    <x-shared.header current-page="watch" />

    <x-shared.announcements />

    {{-- Main Content --}}
    <div class="min-h-screen bg-slate-50 dark:bg-slate-950">

        {{-- Video and Episodes Section --}}
        <section class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 xl:grid-cols-4 gap-4">

                    {{-- Video Player --}}
                    <div class="xl:col-span-3">
                        {{-- Video Player Container --}}
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden p-4">
                            <div class="relative aspect-video bg-black rounded-lg overflow-hidden">
                                @if($episode->vimeo_id)
                                    {{-- Vimeo Embed --}}
                                    <iframe
                                        src="https://player.vimeo.com/video/{{ $episode->vimeo_id }}?h=0&title=0&byline=0&portrait=0&color=ef4444&autoplay=0&loop=0&muted=0&pip=1&responsive=1"
                                        class="absolute inset-0 w-full h-full"
                                        frameborder="0"
                                        allow="autoplay; fullscreen; picture-in-picture"
                                        allowfullscreen
                                        data-episode-id="{{ $episode->id }}"
                                        data-episode-duration="{{ $episode->duration_minutes * 60 }}"
                                    ></iframe>
                                @else
                                    {{-- Placeholder if no video --}}
                                    <div class="absolute inset-0 flex items-center justify-center bg-slate-900">
                                        <div class="text-center text-white">
                                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                            </svg>
                                            <p class="text-lg opacity-75">Video coming soon</p>
                                        </div>
                                    </div>
                                @endif

                                {{-- Progress Bar --}}
                                @auth
                                <div class="absolute bottom-0 left-0 right-0 h-1 bg-black/30">
                                    <div class="h-full bg-red-500 transition-all duration-300"
                                         style="width: {{ $this->userProgress }}%"></div>
                                </div>
                                @endauth
                            </div>
                        </div>

                        {{-- Episode Info --}}
                        <div class="mt-4 bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
                            {{-- Series breadcrumb --}}
                            @if($series)
                            <div class="mb-4">
                                <a href="{{ route('watch.series.show', $series->slug) }}" class="inline-flex items-center text-sm text-slate-600 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                    </svg>
                                    Back to {{ $series->title }}
                                </a>
                            </div>
                            @endif

                            {{-- Title and meta --}}
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">
                                        {{ $episode->title }}
                                    </h1>
                                    <div class="flex items-center gap-4 text-sm text-slate-600 dark:text-slate-400">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $episode->formatted_duration }}
                                        </span>
                                        @if($episode->level)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                                            </svg>
                                            {{ ucfirst($episode->level) }}
                                        </span>
                                        @endif
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            {{ number_format($episode->views_count) }} views
                                        </span>
                                    </div>
                                </div>
                                
                                {{-- Action Buttons --}}
                                @auth
                                <div class="flex items-center gap-2 ml-4">
                                    {{-- Watchlist Button --}}
                                    <button
                                        wire:click="toggleWatchlist"
                                        class="p-2 rounded-lg transition-colors {{ $this->isInWatchlist ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700' }}"
                                        title="{{ $this->isInWatchlist ? 'Remove from watchlist' : 'Add to watchlist' }}"
                                    >
                                        <svg class="w-4 h-4" fill="{{ $this->isInWatchlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                        </svg>
                                    </button>

                                    {{-- Mark Complete Button --}}
                                    @if($this->userProgress < 100)
                                    <button
                                        wire:click="markAsCompleted"
                                        class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded-lg text-xs font-medium transition-colors"
                                    >
                                        Complete
                                    </button>
                                    @else
                                    <div class="px-3 py-1.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg text-xs font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Done
                                    </div>
                                    @endif
                                </div>
                                @endauth
                            </div>

                            {{-- Description --}}
                            @if($episode->description)
                            <div class="prose prose-slate dark:prose-invert max-w-none">
                                {!! nl2br(e($episode->description)) !!}
                            </div>
                            @endif

                            {{-- Navigation --}}
                            @if($this->previousEpisode || $this->nextEpisode)
                            <div class="mt-6 pt-6 mb-6 border-t border-slate-200 dark:border-slate-700">
                                <div class="flex flex-col sm:flex-row gap-3">
                                    @if($this->previousEpisode)
                                    <a href="{{ route('watch.episode.show', [$series->slug, $this->previousEpisode->slug]) }}" 
                                       class="group flex-1 flex items-center gap-3 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 hover:from-blue-100 hover:to-indigo-100 dark:hover:from-blue-900/30 dark:hover:to-indigo-900/30 rounded-xl border border-blue-200 dark:border-blue-800 transition-all duration-200 cursor-pointer">
                                        <div class="flex items-center justify-center w-10 h-10 bg-blue-100 dark:bg-blue-900/40 rounded-lg group-hover:bg-blue-200 dark:group-hover:bg-blue-900/60 transition-colors">
                                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-xs font-medium text-blue-600 dark:text-blue-400 uppercase tracking-wide">Previous Episode</div>
                                            <div class="text-sm font-semibold text-slate-900 dark:text-white group-hover:text-blue-700 dark:group-hover:text-blue-300 transition-colors truncate">
                                                {{ $this->previousEpisode->title }}
                                            </div>
                                        </div>
                                    </a>
                                    @endif

                                    @if($this->nextEpisode)
                                    <a href="{{ route('watch.episode.show', [$series->slug, $this->nextEpisode->slug]) }}" 
                                       class="group flex-1 flex items-center gap-3 p-4 bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 cursor-pointer">
                                        <div class="flex-1 min-w-0 text-right">
                                            <div class="text-xs font-medium text-emerald-100 uppercase tracking-wide">Next Episode</div>
                                            <div class="text-sm font-semibold text-white group-hover:text-emerald-50 transition-colors truncate">
                                                {{ $this->nextEpisode->title }}
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-center w-10 h-10 bg-white/20 rounded-lg group-hover:bg-white/30 transition-colors">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </div>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endif

                            {{-- Instructor Info --}}
                            @if($episode->user)
                            <div class="flex items-center gap-3 pt-3 border-t border-slate-200 dark:border-slate-700">
                                <div class="w-8 h-8 bg-gradient-to-r from-red-600 to-orange-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-xs">
                                        {{ substr($episode->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-900 dark:text-white text-sm">{{ $episode->user->name }}</p>
                                    <p class="text-xs text-slate-600 dark:text-slate-400">Instructor</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- Comments Section --}}
                        <div class="mt-4 bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                            {{-- Comments Header --}}
                            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Discussion</h2>
                                    <span class="text-sm text-slate-500 dark:text-slate-400">{{ $this->commentsCount }} {{ Str::plural('comment', $this->commentsCount) }}</span>
                                </div>
                            </div>

                            {{-- Comments Content --}}
                            <div class="p-6">

                            {{-- Add Comment Form --}}
                            @auth
                            <div class="mb-6 pb-6 border-b border-slate-200 dark:border-slate-700">
                                <div class="flex-1">
                                    @livewire('simple-markdown-editor', [
                                        'name' => 'newComment',
                                        'value' => $newComment,
                                        'placeholder' => 'Share your thoughts about this episode... (Markdown supported)',
                                        'rows' => 4
                                    ])
                                    @error('newComment')
                                        <div class="mt-2 px-3 py-2 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                        </div>
                                    @enderror
                                    <div class="flex items-center justify-end mt-3">
                                        <button
                                            wire:click="postComment"
                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors cursor-pointer"
                                        >
                                            Post Comment
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="mb-6 pb-6 border-b border-slate-200 dark:border-slate-700">
                                <div class="text-center py-4 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                    <p class="text-slate-600 dark:text-slate-400 mb-3">Join the discussion</p>
                                    <a href="{{ route('filament.dashboard.auth.login') }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors">
                                        Login to Comment
                                    </a>
                                </div>
                            </div>
                            @endauth

                            {{-- Comments List --}}
                            <div class="space-y-6">
                                @forelse($episode->comments as $comment)
                                    <div class="flex gap-3" wire:key="comment-{{ $comment->id }}">
                                        <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                                            <span class="text-white font-semibold text-xs">{{ strtoupper(substr($comment->user->name, 0, 1)) }}</span>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="font-medium text-slate-900 dark:text-white text-sm">{{ $comment->user->name }}</span>
                                                @if($comment->user_id === $episode->user_id)
                                                    <span class="bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 px-2 py-0.5 rounded-full text-xs font-medium">Author</span>
                                                @endif
                                                @if($comment->is_best_answer)
                                                    <span class="bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 px-2 py-0.5 rounded-full text-xs font-medium flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                        </svg>
                                                        Best Answer
                                                    </span>
                                                @endif
                                                <span class="text-xs text-slate-500 dark:text-slate-400">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            
                                            @if($editingCommentId === $comment->id)
                                                {{-- Edit Form --}}
                                                <div class="mb-4">
                                                    @livewire('simple-markdown-editor', [
                                                        'name' => 'editCommentContent',
                                                        'value' => $editCommentContent,
                                                        'placeholder' => 'Edit your comment...',
                                                        'rows' => 6,
                                                        'required' => true
                                                    ], key('edit-comment-' . $comment->id))
                                                    @error('editCommentContent')
                                                        <div class="mt-2 px-3 py-2 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                                                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                                        </div>
                                                    @enderror
                                                    <div class="flex items-center gap-3 mt-3">
                                                        <button 
                                                            wire:click="updateComment"
                                                            wire:loading.attr="disabled"
                                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium disabled:opacity-50 cursor-pointer"
                                                        >
                                                            <span wire:loading.remove wire:target="updateComment">Update Comment</span>
                                                            <span wire:loading wire:target="updateComment">Updating...</span>
                                                        </button>
                                                        <button 
                                                            wire:click="cancelEditingComment"
                                                            class="px-4 py-2 text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 transition-colors text-sm cursor-pointer"
                                                        >
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                            @else
                                                {{-- Comment Content --}}
                                                <div class="prose prose-sm prose-slate dark:prose-invert max-w-none">
                                                    {!! 
                                                        preg_replace(
                                                            '/@([a-zA-Z0-9._-]+)/',
                                                            '<span class="mention inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">@$1</span>',
                                                            Str::markdown($comment->content, [
                                                                'html_input' => 'strip',
                                                                'allow_unsafe_links' => false,
                                                            ])
                                                        )
                                                    !!}
                                                </div>
                                            @endif
                                            
                                            <div class="flex items-center gap-2 mt-3">
                                                @auth
                                                    @if($comment->user_id === auth()->id())
                                                        <button 
                                                            wire:click="startEditingComment({{ $comment->id }})"
                                                            class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-all text-xs font-medium cursor-pointer"
                                                        >
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                            </svg>
                                                            Edit
                                                        </button>
                                                        <button 
                                                            onclick="showDeleteModal({{ $comment->id }})"
                                                            class="flex items-center gap-1.5 px-3 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/30 transition-all text-xs font-medium cursor-pointer"
                                                        >
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    @endif
                                                    
                                                    @if($episode->user_id === auth()->id() && !$comment->is_best_answer)
                                                        <button 
                                                            wire:click="markAsBestAnswer({{ $comment->id }})"
                                                            class="flex items-center gap-1.5 px-3 py-1.5 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/30 transition-all text-xs font-medium cursor-pointer"
                                                        >
                                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                            </svg>
                                                            Best Answer
                                                        </button>
                                                    @endif
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-12">
                                        <svg class="w-12 h-12 text-slate-400 dark:text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10m0 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2m8 0v10a2 2 0 01-2 2H9a2 2 0 01-2-2V8m8 0H7"/>
                                        </svg>
                                        <p class="text-slate-500 dark:text-slate-400 mb-2">No comments yet</p>
                                        <p class="text-sm text-slate-400 dark:text-slate-500">Be the first to share your thoughts!</p>
                                    </div>
                                @endforelse
                            </div>
                            </div>
                        </div>

                    </div>

                    {{-- Right Sidebar --}}
                    <div class="xl:col-span-1">
                        <div class="space-y-4">
                            {{-- Episodes List --}}
                            @if($series && $series->episodes->count() > 0)
                            <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                                <div class="px-5 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                        <div class="w-5 h-5 bg-gradient-to-br from-red-500 to-orange-600 rounded-full flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M7 4V2a1 1 0 011-1h4a1 1 0 011 1v2h4a1 1 0 110 2h-1v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4z"/>
                                            </svg>
                                        </div>
                                        Episodes
                                        <span class="text-sm text-slate-500 dark:text-slate-400 font-normal">
                                            ({{ $series->episodes->count() }})
                                        </span>
                                    </h2>
                                </div>
                                <div class="h-[400px] overflow-y-auto">
                                    <div class="p-2 min-h-full">
                                        @foreach($series->episodes as $ep)
                                        <a href="{{ route('watch.episode.show', [$series->slug, $ep->slug]) }}" class="block group p-2 rounded-lg transition-colors
                                            @if($ep->id === $episode->id) 
                                                bg-slate-50 dark:bg-slate-800
                                            @else
                                                hover:bg-slate-50 dark:hover:bg-slate-800
                                            @endif">
                                            <div class="flex gap-3">
                                                {{-- Thumbnail --}}
                                                <div class="relative w-24 h-16 bg-slate-200 dark:bg-slate-700 rounded-lg overflow-hidden flex-shrink-0">
                                                    @if($ep->thumbnail)
                                                    <img src="{{ $ep->thumbnail }}" alt="{{ $ep->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                                                    @else
                                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-800">
                                                        <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                        </svg>
                                                    </div>
                                                    @endif

                                                    {{-- Duration Overlay --}}
                                                    <div class="absolute bottom-1 right-1 bg-black/80 text-white text-xs px-1.5 py-0.5 rounded">
                                                        {{ $ep->formatted_duration }}
                                                    </div>
                                                    
                                                    {{-- Current Episode Play Overlay --}}
                                                    @if($ep->id === $episode->id)
                                                        <div class="absolute inset-0 bg-red-600/20 flex items-center justify-center">
                                                            <div class="w-6 h-6 bg-red-600 rounded-full flex items-center justify-center">
                                                                <svg class="w-3 h-3 text-white ml-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                {{-- Content --}}
                                                <div class="flex-1 min-w-0">
                                                    <h3 class="font-medium text-slate-900 dark:text-white transition-colors text-sm leading-tight mb-1 line-clamp-2
                                                        @if($ep->id === $episode->id) 
                                                            !text-red-600 dark:!text-red-400
                                                        @else
                                                            group-hover:text-red-600 dark:group-hover:text-red-400
                                                        @endif">
                                                        {{ $ep->title }}
                                                    </h3>

                                                    <div class="flex items-center gap-1 text-xs text-slate-500 dark:text-slate-500 mb-1">
                                                        <div class="w-4 h-4 bg-gradient-to-r from-red-600 to-orange-500 rounded-full flex items-center justify-center">
                                                            <span class="text-white font-semibold text-xs">{{ strtoupper(substr($ep->user->name, 0, 1)) }}</span>
                                                        </div>
                                                        <span>{{ $ep->user->name }}</span>
                                                    </div>

                                                    <div class="flex items-center gap-2 text-xs text-slate-600 dark:text-slate-400">
                                                        <span>{{ number_format($ep->views_count) }} views</span>
                                                        <span>•</span>
                                                        <span class="capitalize">{{ $ep->level ?? 'All levels' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            @endif

                            {{-- Episode Details --}}
                            <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                                <div class="px-5 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                        <div class="w-5 h-5 bg-gradient-to-br from-red-500 to-orange-600 rounded-full flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        Episode Details
                                    </h2>
                                </div>
                                <div class="p-4 space-y-3">
                                    {{-- Views --}}
                                    <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">VIEWS</div>
                                                <div class="text-xl font-bold text-slate-900 dark:text-white">{{ number_format($episode->views_count) }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Duration --}}
                                    <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">DURATION</div>
                                                <div class="text-xl font-bold text-slate-900 dark:text-white">{{ $episode->formatted_duration }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Level --}}
                                    @if($episode->level)
                                    <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2v8h8V6H6z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">LEVEL</div>
                                                <div class="text-xl font-bold text-slate-900 dark:text-white">{{ ucfirst($episode->level) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    {{-- Published --}}
                                    <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">PUBLISHED</div>
                                                <div class="text-xl font-bold text-slate-900 dark:text-white">{{ $episode->published_at->format('M j, Y') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Category --}}
                                    @if($episode->category)
                                    <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">CATEGORY</div>
                                                <div class="text-xl font-bold text-slate-900 dark:text-white">{{ $episode->category->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    {{-- Tags --}}
                                    @if($episode->tags && $episode->tags->count() > 0)
                                    <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4">
                                        <div class="flex items-start gap-3">
                                            <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center mt-1">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">TAGS</div>
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($episode->tags as $tag)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300">
                                                        {{ $tag->name }}
                                                    </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- JavaScript for video progress tracking --}}
    @auth
    @script
    <script>
        // Video progress tracking
        document.addEventListener('DOMContentLoaded', function() {
            const iframe = document.querySelector('[data-episode-id]');
            if (!iframe) return;
            
            const episodeId = iframe.dataset.episodeId;
            const episodeDuration = parseInt(iframe.dataset.episodeDuration);
            
            // Vimeo Player API
            if (typeof Vimeo !== 'undefined') {
                const player = new Vimeo.Player(iframe);
                
                player.on('timeupdate', function(data) {
                    const watchedSeconds = Math.floor(data.seconds);
                    // Update progress every 5 seconds
                    if (watchedSeconds % 5 === 0) {
                        $wire.call('updateProgress', watchedSeconds, Math.floor(data.duration));
                    }
                });
                
                player.on('ended', function() {
                    $wire.call('markAsCompleted');
                });
            }
        });
    </script>
    @endscript
    @endauth

    {{-- Vimeo Player API --}}
    <script src="https://player.vimeo.com/api/player.js"></script>

    {{-- Modern Delete Confirmation Modal --}}
    <div id="deleteModal" class="fixed inset-0 z-[9999] hidden opacity-0 transition-opacity duration-300" style="pointer-events: none;">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
        
        <!-- Modal Container -->
        <div class="relative flex items-center justify-center min-h-screen px-4 py-8" onclick="hideDeleteModal()">
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-2xl w-full max-w-md mx-auto transform scale-95 transition-transform duration-300" onclick="event.stopPropagation()">
                <!-- Icon -->
                <div class="flex justify-center pt-6 pb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/20">
                        <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="px-6 pb-6 text-center">
                    <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-3">Delete Comment</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed mb-6">
                        Are you sure you want to delete this comment? This action cannot be undone.
                    </p>
                    
                    <!-- Actions -->
                    <div class="flex gap-3 justify-center">
                        <button 
                            onclick="hideDeleteModal()" 
                            class="px-6 py-2.5 text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-lg transition-colors font-medium text-sm border border-slate-200 dark:border-slate-600 cursor-pointer"
                        >
                            Cancel
                        </button>
                        <button 
                            id="confirmDeleteBtn"
                            class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors font-medium text-sm shadow-sm cursor-pointer"
                        >
                            Delete Comment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let deleteCommentId = null;
        
        function showDeleteModal(commentId) {
            deleteCommentId = commentId;
            const modal = document.getElementById('deleteModal');
            const modalContent = modal.querySelector('.transform');
            
            // Show modal
            modal.classList.remove('hidden');
            modal.style.pointerEvents = 'auto';
            
            // Trigger animations
            requestAnimationFrame(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            });
            
            // Set up the confirm button click handler
            document.getElementById('confirmDeleteBtn').onclick = function() {
                if (deleteCommentId) {
                    @this.call('deleteComment', deleteCommentId);
                    hideDeleteModal();
                }
            };
        }
        
        function hideDeleteModal() {
            const modal = document.getElementById('deleteModal');
            const modalContent = modal.querySelector('.transform');
            
            // Animate out
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            
            // Hide after animation
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.style.pointerEvents = 'none';
                deleteCommentId = null;
            }, 300);
        }
        
        // Close modal when clicking backdrop
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideDeleteModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
                hideDeleteModal();
            }
        });
    </script>
</div>