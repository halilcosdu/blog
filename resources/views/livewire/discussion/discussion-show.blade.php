<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
    <!-- Quill CSS & JS -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    
    <x-shared.header current-page="discussion" />
    <x-shared.announcements />

    <!-- Main Content -->
    <main class="relative py-12 sm:py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="flex items-center gap-4 text-sm text-slate-600 dark:text-slate-400 mb-8">
                <a href="{{ route('discussions.index') }}" class="hover:text-red-600 dark:hover:text-red-400 transition-colors">
                    Discussion Forum
                </a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-slate-900 dark:text-white font-medium">{{ $discussion->title }}</span>
            </div>

            <!-- Discussion Content -->
            <article class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-8 mb-8">
                <!-- Discussion Header -->
                <header class="mb-6 pb-6 border-b border-slate-200/60 dark:border-slate-700/60">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <!-- Title and Status -->
                            <div class="flex items-center gap-4 mb-4">
                                <h1 class="text-2xl lg:text-3xl font-bold text-slate-900 dark:text-white">
                                    {{ $discussion->title }}
                                </h1>
                                @if($discussion->is_resolved)
                                    <div class="flex items-center gap-2 px-3 py-1 bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300 rounded-full text-sm font-medium">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Resolved</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Meta Information -->
                            <div class="flex items-center gap-6 text-sm text-slate-500 dark:text-slate-400">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-red-500 to-orange-400 flex items-center justify-center text-white font-bold text-xs">
                                        {{ substr($discussion->user->name, 0, 2) }}
                                    </div>
                                    <span>by <span class="font-semibold">{{ $discussion->user->name }}</span></span>
                                </div>
                                <span>in <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $discussion->category->name }}</span></span>
                                <span>{{ $discussion->created_at->diffForHumans() }}</span>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>{{ number_format($discussion->views_count) }} views</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-3">
                            <!-- Share Button -->
                            <div x-data="{ 
                                copied: false,
                                shareUrl: '{{ request()->url() }}',
                                async copyToClipboard() {
                                    try {
                                        await navigator.clipboard.writeText(this.shareUrl);
                                        this.copied = true;
                                        setTimeout(() => { this.copied = false; }, 2000);
                                    } catch (err) {
                                        console.error('Failed to copy: ', err);
                                    }
                                }
                            }">
                                <button 
                                    @click="copyToClipboard()"
                                    class="flex items-center gap-2 px-3 py-2 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 transition-all text-sm font-medium"
                                    :class="{ 'bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300': copied }"
                                >
                                    <svg x-show="!copied" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                                    </svg>
                                    <svg x-show="copied" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" style="display: none;">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span x-text="copied ? 'Copied!' : 'Share'"></span>
                                </button>
                            </div>
                            
                            @auth
                                @if(auth()->id() === $discussion->user_id)
                                    <a href="{{ route('discussions.edit', $discussion->slug) }}" class="flex items-center gap-2 px-4 py-2 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 transition-all text-sm font-medium">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    @if(!$discussion->is_resolved)
                                        <button 
                                            wire:click="markAsResolved"
                                            wire:loading.attr="disabled"
                                            class="flex items-center gap-2 px-4 py-2 bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300 rounded-lg hover:bg-green-200 dark:hover:bg-green-900/30 transition-all text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <svg wire:loading.remove class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            <div wire:loading class="animate-spin rounded-full h-4 w-4 border-b-2 border-current"></div>
                                            <span wire:loading.remove>Mark as Resolved</span>
                                            <span wire:loading>Marking...</span>
                                        </button>
                                    @else
                                        <button 
                                            wire:click="markAsUnresolved"
                                            wire:loading.attr="disabled"
                                            class="flex items-center gap-2 px-4 py-2 bg-orange-100 dark:bg-orange-900/20 text-orange-700 dark:text-orange-300 rounded-lg hover:bg-orange-200 dark:hover:bg-orange-900/30 transition-all text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <svg wire:loading.remove class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            <div wire:loading class="animate-spin rounded-full h-4 w-4 border-b-2 border-current"></div>
                                            <span wire:loading.remove>Mark as Unresolved</span>
                                            <span wire:loading>Marking...</span>
                                        </button>
                                    @endif
                            @endif
                        @endauth
                        </div>
                    </div>
                </header>

                <!-- Discussion Content -->
                <div class="quill-content prose prose-slate dark:prose-invert max-w-none prose-headings:text-slate-900 dark:prose-headings:text-white prose-p:text-slate-700 dark:prose-p:text-slate-300 prose-strong:text-slate-900 dark:prose-strong:text-white prose-code:text-red-600 dark:prose-code:text-red-400 prose-code:bg-slate-100 dark:prose-code:bg-slate-800">
                    {!! $discussion->content !!}
                </div>
                
                <!-- Quill Content Styling -->
                <style>
                    /* Code blocks */
                    .ql-syntax {
                        background: #1e293b !important;
                        color: #e2e8f0 !important;
                        padding: 1rem !important;
                        border-radius: 0.5rem !important;
                        font-family: 'Monaco', 'Menlo', 'Consolas', 'Courier New', monospace !important;
                        font-size: 14px !important;
                        line-height: 1.6 !important;
                        border: 1px solid #374151 !important;
                        margin: 1rem 0 !important;
                        overflow-x: auto !important;
                    }
                    
                    .dark .ql-syntax {
                        background: #0f172a !important;
                        border-color: #1e293b !important;
                    }
                    
                    /* Quill formatting */
                    .quill-content ol {
                        list-style-type: decimal;
                        padding-left: 1.5rem;
                        margin: 1rem 0;
                    }
                    
                    .quill-content ul {
                        list-style-type: disc;
                        padding-left: 1.5rem;
                        margin: 1rem 0;
                    }
                    
                    .quill-content li {
                        margin: 0.25rem 0;
                        color: inherit;
                    }
                    
                    .quill-content blockquote {
                        border-left: 4px solid #e11d48;
                        padding-left: 1rem;
                        margin: 1rem 0;
                        font-style: italic;
                        background: #f8fafc;
                        padding: 1rem;
                        border-radius: 0.5rem;
                    }
                    
                    .dark .quill-content blockquote {
                        background: #1e293b;
                        border-left-color: #f43f5e;
                    }
                    
                    .quill-content h1, .quill-content h2, .quill-content h3 {
                        font-weight: bold;
                        margin: 1.5rem 0 1rem 0;
                        line-height: 1.2;
                    }
                    
                    .quill-content h1 {
                        font-size: 2rem;
                    }
                    
                    .quill-content h2 {
                        font-size: 1.5rem;
                    }
                    
                    .quill-content h3 {
                        font-size: 1.25rem;
                    }
                    
                    .quill-content p {
                        margin: 1rem 0;
                        line-height: 1.6;
                    }
                    
                    .quill-content strong {
                        font-weight: bold;
                    }
                    
                    .quill-content em {
                        font-style: italic;
                    }
                    
                    .quill-content u {
                        text-decoration: underline;
                    }
                    
                    .quill-content s {
                        text-decoration: line-through;
                    }
                    
                    .quill-content a {
                        color: #e11d48;
                        text-decoration: underline;
                    }
                    
                    .dark .quill-content a {
                        color: #f43f5e;
                    }
                    
                    .quill-content .ql-indent-1 { margin-left: 2rem; }
                    .quill-content .ql-indent-2 { margin-left: 4rem; }
                    .quill-content .ql-indent-3 { margin-left: 6rem; }
                    .quill-content .ql-indent-4 { margin-left: 8rem; }
                    .quill-content .ql-indent-5 { margin-left: 10rem; }
                </style>
            </article>

            <!-- Replies Section -->
            <section class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">
                        Replies ({{ $discussion->replies->count() }})
                    </h2>
                </div>

                <!-- Reply Form -->
                @auth
                    <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Add Your Reply</h3>
                        <form wire:submit="addReply" class="space-y-4">
                            <div wire:ignore class="rounded-lg border border-slate-200/60 dark:border-slate-600/60 overflow-hidden">
                                <!-- Rich Editor -->
                                <div 
                                    x-data="{ 
                                        content: @entangle('replyContent'),
                                        editor: null,
                                        init() {
                                            this.initQuill();
                                            
                                            // Re-initialize on Livewire updates
                                            Livewire.on('reply-added', () => {
                                                if (this.editor) {
                                                    this.editor.setText('');
                                                }
                                            });
                                        },
                                        initQuill() {
                                            if (this.editor || !this.$refs.replyEditor) {
                                                return;
                                            }
                                            
                                            try {
                                                this.editor = new Quill(this.$refs.replyEditor, {
                                                    theme: 'snow',
                                                    placeholder: 'Share your thoughts or help solve this discussion... (minimum 10 characters)',
                                                    modules: {
                                                        toolbar: [
                                                            [{ 'header': [1, 2, 3, false] }],
                                                            ['bold', 'italic', 'underline', 'strike'],
                                                            ['blockquote', 'code-block'],
                                                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                                            ['link'],
                                                            ['clean']
                                                        ]
                                                    }
                                                });
                                                
                                                // Set initial content
                                                if (this.content) {
                                                    this.editor.root.innerHTML = this.content;
                                                }
                                                
                                                // Update Livewire on text change
                                                this.editor.on('text-change', () => {
                                                    this.content = this.editor.root.innerHTML;
                                                });
                                                
                                                // Watch for content changes from Livewire
                                                this.$watch('content', (value) => {
                                                    if (this.editor && this.editor.root.innerHTML !== value) {
                                                        this.editor.root.innerHTML = value || '';
                                                    }
                                                });
                                            } catch (error) {
                                                console.error('Failed to initialize Quill:', error);
                                            }
                                        }
                                    }"
                                    x-init="init()"
                                >
                                    <div x-ref="replyEditor" style="min-height: 150px;"></div>
                                </div>
                            </div>
                            @error('replyContent')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            
                            <button 
                                type="submit" 
                                wire:loading.attr="disabled"
                                class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-red-500/25 transform hover:scale-105 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                            >
                                <svg wire:loading.remove class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                                </svg>
                                <div wire:loading class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>
                                <span wire:loading.remove>Post Reply</span>
                                <span wire:loading>Posting...</span>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-6 text-center">
                        <p class="text-slate-600 dark:text-slate-400 mb-4">
                            You need to be logged in to reply to this discussion.
                        </p>
                        <a href="/dashboard/login" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-red-500/25 transform hover:scale-105 transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            Login to Reply
                        </a>
                    </div>
                @endauth

                <!-- Replies List -->
                @forelse($discussion->replies as $reply)
                    <article class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <header class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                                    {{ substr($reply->user->name, 0, 2) }}
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 dark:text-white">{{ $reply->user->name }}</h4>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $reply->created_at->diffForHumans() }}</p>
                                </div>
                                @if($reply->is_best_answer)
                                    <div class="flex items-center gap-2 px-3 py-1 bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300 rounded-full text-sm font-medium">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Best Answer
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex items-center gap-2">
                                @auth
                                    @if(auth()->id() === $reply->user_id)
                                        @if($editingReplyId !== $reply->id)
                                            <button 
                                                wire:click="startEditingReply({{ $reply->id }})"
                                                class="flex items-center gap-2 px-3 py-2 bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-900/30 transition-all text-sm font-medium"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </button>
                                            <button 
                                                wire:click="deleteReply({{ $reply->id }})"
                                                wire:confirm="Are you sure you want to delete this reply?"
                                                class="flex items-center gap-2 px-3 py-2 bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-300 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/30 transition-all text-sm font-medium"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete
                                            </button>
                                        @endif
                                    @endif
                                    
                                    @if(auth()->id() === $discussion->user_id)
                                        @if(!$reply->is_best_answer && !$discussion->is_resolved)
                                        <button 
                                            wire:click="markAsBestAnswer({{ $reply->id }})"
                                            wire:loading.attr="disabled"
                                            class="flex items-center gap-2 px-3 py-2 bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300 rounded-lg hover:bg-green-200 dark:hover:bg-green-900/30 transition-all text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <svg wire:loading.remove wire:target="markAsBestAnswer({{ $reply->id }})" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            <div wire:loading wire:target="markAsBestAnswer({{ $reply->id }})" class="animate-spin rounded-full h-4 w-4 border-b-2 border-current"></div>
                                            <span wire:loading.remove wire:target="markAsBestAnswer({{ $reply->id }})">Mark as Best Answer</span>
                                            <span wire:loading wire:target="markAsBestAnswer({{ $reply->id }})">Marking...</span>
                                        </button>
                                    @elseif($reply->is_best_answer)
                                        <button 
                                            wire:click="removeBestAnswer({{ $reply->id }})"
                                            wire:loading.attr="disabled"
                                            class="flex items-center gap-2 px-3 py-2 bg-orange-100 dark:bg-orange-900/20 text-orange-700 dark:text-orange-300 rounded-lg hover:bg-orange-200 dark:hover:bg-orange-900/30 transition-all text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <svg wire:loading.remove wire:target="removeBestAnswer({{ $reply->id }})" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            <div wire:loading wire:target="removeBestAnswer({{ $reply->id }})" class="animate-spin rounded-full h-4 w-4 border-b-2 border-current"></div>
                                            <span wire:loading.remove wire:target="removeBestAnswer({{ $reply->id }})">Remove Best Answer</span>
                                            <span wire:loading wire:target="removeBestAnswer({{ $reply->id }})">Removing...</span>
                                        </button>
                                        @endif
                                    @endif
                                @endauth
                            </div>
                        </header>
                        
                        @if($editingReplyId === $reply->id)
                            <!-- Edit Reply Form -->
                            <div class="space-y-4">
                                <div wire:ignore class="rounded-lg border border-slate-200/60 dark:border-slate-600/60 overflow-hidden">
                                    <div 
                                        x-data="{ 
                                            editContent: @entangle('editReplyContent'),
                                            editEditor: null,
                                            init() {
                                                this.initEditQuill();
                                            },
                                            initEditQuill() {
                                                if (this.editEditor || !this.$refs.editReplyEditor) {
                                                    return;
                                                }
                                                
                                                try {
                                                    this.editEditor = new Quill(this.$refs.editReplyEditor, {
                                                        theme: 'snow',
                                                        modules: {
                                                            toolbar: [
                                                                [{ 'header': [1, 2, 3, false] }],
                                                                ['bold', 'italic', 'underline', 'strike'],
                                                                ['blockquote', 'code-block'],
                                                                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                                                ['link'],
                                                                ['clean']
                                                            ]
                                                        }
                                                    });
                                                    
                                                    // Set initial content
                                                    if (this.editContent) {
                                                        this.editEditor.root.innerHTML = this.editContent;
                                                    }
                                                    
                                                    // Update Livewire on text change
                                                    this.editEditor.on('text-change', () => {
                                                        this.editContent = this.editEditor.root.innerHTML;
                                                    });
                                                    
                                                    // Watch for content changes from Livewire
                                                    this.$watch('editContent', (value) => {
                                                        if (this.editEditor && this.editEditor.root.innerHTML !== value) {
                                                            this.editEditor.root.innerHTML = value || '';
                                                        }
                                                    });
                                                } catch (error) {
                                                    console.error('Failed to initialize edit Quill:', error);
                                                }
                                            }
                                        }"
                                        x-init="init()"
                                    >
                                        <div x-ref="editReplyEditor" style="min-height: 150px;"></div>
                                    </div>
                                </div>
                                @error('editReplyContent')
                                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                                
                                <div class="flex items-center gap-3">
                                    <button 
                                        wire:click="updateReply"
                                        wire:loading.attr="disabled"
                                        class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-blue-500/25 transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                                    >
                                        <svg wire:loading.remove class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <div wire:loading class="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></div>
                                        <span wire:loading.remove>Update Reply</span>
                                        <span wire:loading>Updating...</span>
                                    </button>
                                    <button 
                                        wire:click="cancelEditingReply"
                                        type="button"
                                        class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold rounded-lg hover:bg-slate-300 dark:hover:bg-slate-600 transition-all"
                                    >
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="prose prose-slate dark:prose-invert max-w-none quill-content">
                                {!! $reply->content !!}
                            </div>
                        @endif
                    </article>
                @empty
                    <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-12 text-center">
                        <svg class="h-16 w-16 text-slate-300 dark:text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">No replies yet</h3>
                        <p class="text-slate-600 dark:text-slate-400">
                            Be the first to share your thoughts on this discussion!
                        </p>
                    </div>
                @endforelse
            </section>
        </div>
    </main>

    <x-shared.mobile-nav-script />
</div>