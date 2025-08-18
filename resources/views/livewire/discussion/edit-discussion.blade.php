<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
    <x-shared.header current-page="discussion" />
    <x-shared.announcements />

    <!-- Main Content -->
    <main class="relative py-12 sm:py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex items-center gap-4 text-sm text-slate-600 dark:text-slate-400 mb-4">
                    <a href="{{ route('discussions.index') }}" class="hover:text-red-600 dark:hover:text-red-400 transition-colors">
                        Discussion Forum
                    </a>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <a href="{{ route('discussions.show', $discussion->slug) }}" class="hover:text-red-600 dark:hover:text-red-400 transition-colors">
                        {{ $discussion->title }}
                    </a>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-slate-900 dark:text-white font-medium">Edit</span>
                </div>
                <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent">
                    Edit Discussion
                </h1>
                <p class="mt-4 text-lg text-slate-600 dark:text-slate-400 max-w-2xl">
                    Update your discussion details.
                </p>
            </div>

            <!-- Edit Form -->
            <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                <form wire:submit="save" class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            Discussion Title *
                        </label>
                        <input
                            wire:model="title"
                            type="text"
                            id="title"
                            placeholder="What would you like to discuss?"
                            class="w-full px-4 py-3 text-sm border border-slate-200/60 dark:border-slate-600/60 rounded-lg bg-white/50 dark:bg-slate-700/50 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500/50 transition-all"
                        >
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            Category *
                        </label>
                        <div class="relative">
                            <select
                                wire:model="category_id"
                                id="category_id"
                                class="w-full px-4 py-3 pr-10 text-sm border border-slate-200/60 dark:border-slate-600/60 rounded-lg bg-white/50 dark:bg-slate-700/50 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500/50 transition-all appearance-none"
                            >
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            Discussion Content *
                        </label>
                        
                        <!-- Rich Text Editor -->
                        <div wire:ignore class="rounded-lg border border-slate-200/60 dark:border-slate-600/60 overflow-hidden">
                            <!-- Quill CSS & JS -->
                            <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
                            <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
                            
                            <!-- Rich Editor -->
                            <div 
                                x-data="{ 
                                    content: @entangle('content'),
                                    editor: null,
                                    init() {
                                        this.initQuill();
                                    },
                                    initQuill() {
                                        if (this.editor || !this.$refs.editor) {
                                            return;
                                        }
                                        
                                        try {
                                            this.editor = new Quill(this.$refs.editor, {
                                                theme: 'snow',
                                                placeholder: 'Describe your question or topic in detail...',
                                                modules: {
                                                    toolbar: [
                                                        [{ 'header': [1, 2, 3, false] }],
                                                        ['bold', 'italic', 'underline', 'strike'],
                                                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                                        [{ 'indent': '-1'}, { 'indent': '+1' }],
                                                        ['blockquote', 'code-block'],
                                                        ['link'],
                                                        ['clean']
                                                    ]
                                                }
                                            });
                                            
                                            // Set initial content
                                            if (this.content) {
                                                this.editor.root.innerHTML = this.content;
                                            }
                                            
                                            // Auto-resize editor based on content
                                            const adjustHeight = () => {
                                                const editorContainer = this.$refs.editor;
                                                const editorContent = editorContainer.querySelector('.ql-editor');
                                                if (editorContent) {
                                                    const minHeight = 300;
                                                    const maxHeight = 800;
                                                    const scrollHeight = editorContent.scrollHeight;
                                                    const newHeight = Math.min(Math.max(scrollHeight + 50, minHeight), maxHeight);
                                                    editorContainer.style.height = newHeight + 'px';
                                                }
                                            };
                                            
                                            // Update content and adjust height
                                            this.editor.on('text-change', () => {
                                                const html = this.editor.root.innerHTML;
                                                this.content = html === '<p><br></p>' ? '' : html;
                                                setTimeout(adjustHeight, 50);
                                            });
                                            
                                            // Initial height adjustment
                                            setTimeout(adjustHeight, 100);
                                            
                                        } catch (error) {
                                            console.error('Quill initialization failed:', error);
                                        }
                                    }
                                }"
                                x-ref="editor" 
                                style="height: 300px;" 
                                class="bg-white dark:bg-slate-800"
                            ></div>
                        </div>
                        
                        @error('content')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-slate-200/60 dark:border-slate-700/60">
                        <button
                            type="submit"
                            class="flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-red-500/25 transform hover:scale-105 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                            wire:loading.attr="disabled"
                        >
                            <svg wire:loading.remove class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <div wire:loading class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>
                            <span wire:loading.remove>Update Discussion</span>
                            <span wire:loading>Updating...</span>
                        </button>
                        <a
                            href="{{ route('discussions.show', $discussion->slug) }}"
                            class="flex items-center justify-center gap-2 px-6 py-3 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 transition-all duration-200"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span>Cancel</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <x-shared.mobile-nav-script />
</div>