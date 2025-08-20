<div class="markdown-editor-wrapper">
    <!-- Editor Container -->
    <div class="markdown-editor bg-transparent border-0 overflow-hidden">
        <!-- Toolbar -->
        <div class="editor-toolbar flex items-center justify-between p-4 border-b border-slate-200/60 dark:border-slate-700/60 bg-slate-50/80 dark:bg-slate-900/80">
            <!-- Left side - Format buttons -->
            <div class="flex items-center gap-1">
                <!-- Bold -->
                <button type="button" wire:click="insertText('**', '**')" @disabled($activeTab === 'preview')
                    class="p-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-700 rounded transition-colors disabled:opacity-50"
                    title="Bold">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6 2a1 1 0 000 2h1v12H6a1 1 0 000 2h8a1 1 0 100-2h-1V4h1a1 1 0 100-2H6z"/>
                    </svg>
                </button>

                <!-- Italic -->
                <button type="button" wire:click="insertText('*', '*')" @disabled($activeTab === 'preview')
                    class="p-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-700 rounded transition-colors disabled:opacity-50"
                    title="Italic">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 2a1 1 0 000 2h1.5l-3 12H6a1 1 0 000 2h4a1 1 0 100-2h-1.5l3-12H12a1 1 0 100-2H8z"/>
                    </svg>
                </button>

                <!-- Heading -->
                <button type="button" wire:click="insertText('## ', '')" @disabled($activeTab === 'preview')
                    class="p-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-700 rounded transition-colors disabled:opacity-50"
                    title="Heading">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h2a1 1 0 011 1v4h6V4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 11-2 0v-4H7v4a1 1 0 11-2 0V4z"/>
                    </svg>
                </button>

                <!-- Code -->
                <button type="button" wire:click="insertText('`', '`')" @disabled($activeTab === 'preview')
                    class="p-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-700 rounded transition-colors disabled:opacity-50"
                    title="Inline Code">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>

                <!-- Code Block -->
                <button type="button" wire:click="insertCodeBlock()" @disabled($activeTab === 'preview')
                    class="p-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-700 rounded transition-colors disabled:opacity-50"
                    title="Code Block">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                </button>

                <!-- Link -->
                <button type="button" wire:click="insertLink()" @disabled($activeTab === 'preview')
                    class="p-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-700 rounded transition-colors disabled:opacity-50"
                    title="Link">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </button>

            </div>

            <!-- Right side - Tab controls -->
            <div class="flex bg-slate-100/80 dark:bg-slate-800/80 rounded-lg p-1">
                <button type="button" wire:click="setActiveTab('write')" @class([
                    'px-3 py-1 text-sm font-medium rounded transition-colors',
                    'bg-white dark:bg-slate-600 text-slate-900 dark:text-white shadow-sm' => $activeTab === 'write',
                    'text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200' => $activeTab !== 'write'
                ])>
                    Write
                </button>
                <button type="button" wire:click="setActiveTab('preview')" @class([
                    'px-3 py-1 text-sm font-medium rounded transition-colors',
                    'bg-white dark:bg-slate-600 text-slate-900 dark:text-white shadow-sm' => $activeTab === 'preview',
                    'text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200' => $activeTab !== 'preview'
                ])>
                    Preview
                </button>
            </div>
        </div>

        <!-- Editor Content -->
        <div class="editor-content relative">
            @if($activeTab === 'write')
            <!-- Textarea -->
            <textarea
                id="markdown-textarea-{{ $name }}"
                wire:model.live="content"
                name="{{ $name }}"
                rows="{{ $rows }}"
                placeholder="{{ $placeholder }}"
                @if($required) required @endif
                class="w-full p-4 text-sm border-0 bg-transparent text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none resize-y font-mono"
            ></textarea>
            
            <!-- Modern Mention Dropdown -->
            @if($showMentionDropdown)
            <div id="mention-dropdown-{{ $name }}" 
                 class="mention-dropdown-{{ $name }} fixed bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-slate-200/80 dark:border-slate-700/80 rounded-2xl shadow-2xl shadow-slate-900/10 dark:shadow-slate-900/40 max-h-80 overflow-hidden min-w-[320px] z-[99999] ring-1 ring-slate-200/20 dark:ring-slate-700/20"
                 style="top: 50%; left: 50%; transform: translate(-50%, -50%);"
                 
                <!-- Header with search info -->
                <div class="px-5 py-4 border-b border-slate-200/20 dark:border-slate-700/20 bg-gradient-to-r from-slate-50/80 via-white/80 to-slate-50/80 dark:from-slate-800/80 dark:via-slate-700/80 dark:to-slate-800/80">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-slate-900 dark:text-white">Mention User</div>
                                @if($mentionQuery)
                                    <div class="text-xs text-slate-500 dark:text-slate-400">Searching for "{{ $mentionQuery }}"</div>
                                @else
                                    <div class="text-xs text-slate-500 dark:text-slate-400">Type to search</div>
                                @endif
                            </div>
                        </div>
                        <div class="text-xs text-slate-400 dark:text-slate-500 flex items-center gap-1">
                            <kbd class="px-1.5 py-0.5 bg-slate-100 dark:bg-slate-800 rounded text-xs">↑↓</kbd>
                            <kbd class="px-1.5 py-0.5 bg-slate-100 dark:bg-slate-800 rounded text-xs">Enter</kbd>
                        </div>
                    </div>
                </div>

                <!-- User List -->
                <div class="max-h-64 overflow-y-auto">
                    @forelse($mentionUsers as $index => $user)
                        <div wire:click="selectMentionByIndex({{ $index }})" 
                             class="group relative flex items-center gap-4 px-5 py-4 cursor-pointer transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-indigo-50/50 dark:hover:from-blue-900/10 dark:hover:to-indigo-900/10
                             {{ $index === $mentionSelectedIndex ? 'bg-gradient-to-r from-blue-50 via-blue-50/80 to-indigo-50 dark:from-blue-900/20 dark:via-blue-900/15 dark:to-indigo-900/20 shadow-sm' : '' }}">
                            
                            @if($index === $mentionSelectedIndex)
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-blue-500 to-indigo-600 rounded-r"></div>
                            @endif
                            
                            <div class="relative w-12 h-12 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-800 flex items-center justify-center shadow-sm ring-1 ring-slate-200/50 dark:ring-slate-600/50 group-hover:shadow-md transition-all duration-200">
                                <div class="text-slate-600 dark:text-slate-300 font-bold text-lg">
                                    {{ strtoupper(substr($user['name'] ?? 'U', 0, 1)) }}
                                </div>
                                @if($index === $mentionSelectedIndex)
                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                @endif
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="text-base font-semibold text-slate-900 dark:text-white truncate group-hover:text-slate-950 dark:group-hover:text-slate-50 transition-colors">
                                    {{ $user['name'] ?? 'Unknown User' }}
                                </div>
                                <div class="text-sm text-slate-500 dark:text-slate-400 flex items-center gap-1 mt-0.5">
                                    <span class="text-blue-600 dark:text-blue-400">@</span>
                                    <span>{{ $user['username'] ?? 'unknown' }}</span>
                                </div>
                            </div>
                            
                            <div class="text-slate-300 dark:text-slate-600 group-hover:text-slate-400 dark:group-hover:text-slate-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-12 text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-800 rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-inner">
                                <svg class="w-8 h-8 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">No users found</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Try typing a different name or username</p>
                        </div>
                    @endforelse
                </div>

                <!-- Footer -->
                <div class="px-5 py-3 border-t border-slate-200/20 dark:border-slate-700/20 bg-gradient-to-r from-slate-50/80 via-white/80 to-slate-50/80 dark:from-slate-800/80 dark:via-slate-700/80 dark:to-slate-800/80">
                    <div class="text-xs text-slate-500 dark:text-slate-400 text-center">
                        Use <kbd class="px-1 bg-slate-100 dark:bg-slate-800 rounded">↑</kbd><kbd class="px-1 bg-slate-100 dark:bg-slate-800 rounded">↓</kbd> to navigate • <kbd class="px-1 bg-slate-100 dark:bg-slate-800 rounded">Enter</kbd> to select • <kbd class="px-1 bg-slate-100 dark:bg-slate-800 rounded">Esc</kbd> to close
                    </div>
                </div>
            </div>
            @endif
            @endif

            @if($activeTab === 'preview')
            <!-- Preview -->
            <div class="p-4">
                <div id="preview-content-{{ $name }}" class="prose prose-slate dark:prose-invert max-w-none prose-headings:text-slate-900 dark:prose-headings:text-white prose-p:text-slate-700 dark:prose-p:text-slate-300 prose-strong:text-slate-900 dark:prose-strong:text-white prose-code:text-red-600 dark:prose-code:text-red-400 prose-code:bg-slate-100 dark:prose-code:bg-slate-800 prose-pre:bg-slate-100 dark:prose-pre:bg-slate-800 prose-pre:text-slate-900 dark:prose-pre:text-slate-100">
                    @if($content)
                        <div id="markdown-preview-{{ $name }}">
                            <!-- Preview content will be rendered here -->
                            <div class="text-center py-4 text-slate-500 dark:text-slate-400">
                                <p>Loading preview...</p>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8 text-slate-500 dark:text-slate-400">
                            <p>Nothing to preview yet. Start writing in the editor!</p>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Global copy function for code blocks -->
    <script>
    window.copyCodeToClipboard = async function(event) {
        // Prevent event from bubbling up and triggering form submission
        event.preventDefault();
        event.stopPropagation();
        
        const button = event.currentTarget;
        const codeBlock = button.closest('.code-block-wrapper').querySelector('code');
        const copyIcon = button.querySelector('.copy-icon');
        const checkIcon = button.querySelector('.check-icon');

        if (!codeBlock) {
            console.error('Code block not found');
            return;
        }

        try {
            await navigator.clipboard.writeText(codeBlock.textContent);
            copyIcon.classList.add('hidden');
            checkIcon.classList.remove('hidden');

            setTimeout(() => {
                copyIcon.classList.remove('hidden');
                checkIcon.classList.add('hidden');
            }, 2000);
        } catch (err) {
            console.error('Failed to copy code:', err);
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = codeBlock.textContent;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);

            copyIcon.classList.add('hidden');
            checkIcon.classList.remove('hidden');
            setTimeout(() => {
                copyIcon.classList.remove('hidden');
                checkIcon.classList.add('hidden');
            }, 2000);
        }
    };
    </script>

    <!-- JavaScript -->
    @script
    <script>
        const componentId = '{{ $name }}';
        
        // Initialize mention detection - more robust approach
        function initializeMentionDetection() {
            const textarea = document.getElementById('markdown-textarea-' + componentId);
            if (textarea) {
                // Remove existing listeners to avoid duplicates
                textarea.removeEventListener('input', handleMentionDetection);
                textarea.removeEventListener('keydown', handleMentionKeydown);
                textarea.removeEventListener('focus', initializeMentionDetection);
                
                // Add fresh listeners
                textarea.addEventListener('input', handleMentionDetection);
                textarea.addEventListener('keydown', handleMentionKeydown);
                textarea.addEventListener('focus', initializeMentionDetection);
                
                console.log('Mention detection (re)initialized for', componentId, 'textarea found:', !!textarea);
            } else {
                console.log('Textarea not found for component:', componentId);
            }
        }

        // Try to initialize immediately and also after DOM is ready
        initializeMentionDetection();
        document.addEventListener('DOMContentLoaded', initializeMentionDetection);
        
        // Also initialize after Livewire updates
        document.addEventListener('livewire:updated', function() {
            // Small delay to ensure DOM is fully updated
            setTimeout(() => {
                initializeMentionDetection();
                
                // Update dropdown position if it's visible
                if ($wire.get('showMentionDropdown')) {
                    const textarea = document.getElementById('markdown-textarea-' + componentId);
                    if (textarea) {
                        updateDropdownPosition(textarea);
                    }
                }
                
                // Update preview if in preview mode
                if ($wire.get('activeTab') === 'preview') {
                    updateMarkdownPreview();
                }
            }, 50);
        });

        // Load markdown libraries
        function loadMarkdownLibraries() {
            return new Promise((resolve) => {
                if (typeof marked !== 'undefined') {
                    resolve();
                    return;
                }

                const markedScript = document.createElement('script');
                markedScript.src = 'https://cdn.jsdelivr.net/npm/marked@9.1.6/marked.min.js';
                markedScript.onload = () => {
                    // Load highlight.js
                    if (typeof hljs === 'undefined') {
                        const hljsScript = document.createElement('script');
                        hljsScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js';
                        hljsScript.onload = resolve;
                        document.head.appendChild(hljsScript);

                        const hljsCSS = document.createElement('link');
                        hljsCSS.rel = 'stylesheet';
                        hljsCSS.href = 'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css';
                        document.head.appendChild(hljsCSS);
                    } else {
                        resolve();
                    }
                };
                document.head.appendChild(markedScript);
            });
        }

        // Update markdown preview
        async function updateMarkdownPreview() {
            const previewContainer = document.getElementById('markdown-preview-' + componentId);
            if (!previewContainer) return;

            const content = $wire.get('content');
            if (!content) {
                previewContainer.innerHTML = '<div class="text-center py-8 text-slate-500 dark:text-slate-400"><p>Nothing to preview yet. Start writing in the editor!</p></div>';
                return;
            }

            // Show loading
            previewContainer.innerHTML = '<div class="text-center py-4 text-slate-500 dark:text-slate-400"><p>Loading preview...</p></div>';

            try {
                await loadMarkdownLibraries();

                // Configure marked
                const renderer = new marked.Renderer();
                
                // Custom code block renderer
                renderer.code = function(code, language) {
                    const validLang = language && hljs?.getLanguage(language) ? language : 'plaintext';
                    const highlightedCode = hljs?.highlight(code, { language: validLang })?.value || code;

                    return `<div class="code-block-wrapper relative group mb-4">
                        <div class="code-header flex items-center justify-between bg-slate-800 dark:bg-slate-900 text-slate-300 px-4 py-2 text-sm font-mono rounded-t-lg">
                            <span class="text-slate-400">${language || 'text'}</span>
                            <button type="button" class="copy-btn opacity-0 group-hover:opacity-100 transition-opacity hover:bg-slate-700 p-1 rounded" onclick="copyCodeToClipboard(event)">
                                <svg class="copy-icon w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                                <svg class="check-icon w-4 h-4 hidden" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                        <pre class="bg-slate-900 dark:bg-slate-950 text-slate-100 p-4 rounded-b-lg overflow-x-auto"><code class="hljs language-${validLang}">${highlightedCode}</code></pre>
                    </div>`;
                };

                marked.setOptions({
                    renderer: renderer,
                    breaks: true,
                    gfm: true,
                });

                // Parse markdown
                let htmlContent = marked.parse(content);

                // Process mentions
                htmlContent = htmlContent.replace(
                    /@([a-zA-Z0-9._-]+)/g,
                    '<span class="mention inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">@$1</span>'
                );

                previewContainer.innerHTML = htmlContent;

                // Apply syntax highlighting
                if (typeof hljs !== 'undefined') {
                    previewContainer.querySelectorAll('pre code:not(.hljs)').forEach((block) => {
                        hljs.highlightElement(block);
                    });
                }

            } catch (error) {
                console.error('Error rendering markdown preview:', error);
                previewContainer.innerHTML = '<div class="text-center py-4 text-red-500"><p>Error loading preview</p></div>';
            }
        }
        
        function insertTextAtCursor(before, after = '') {
            const textarea = document.getElementById('markdown-textarea-' + componentId);
            if (!textarea) return;

            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            const replacement = before + selectedText + after;

            textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
            
            // Trigger Livewire update
            textarea.dispatchEvent(new Event('input', { bubbles: true }));
            
            // Set cursor position
            const newPos = start + before.length + selectedText.length + after.length;
            setTimeout(() => {
                textarea.focus();
                textarea.setSelectionRange(newPos, newPos);
                
            }, 50);
        }

        function insertCodeBlockAtCursor() {
            const textarea = document.getElementById('markdown-textarea-' + componentId);
            if (!textarea) return;

            const start = textarea.selectionStart;
            const selectedText = textarea.value.substring(start, textarea.selectionEnd);
            const codeBlock = '\n```\n' + (selectedText || 'Your code here') + '\n```\n';

            textarea.value = textarea.value.substring(0, start) + codeBlock + textarea.value.substring(textarea.selectionEnd);
            textarea.dispatchEvent(new Event('input', { bubbles: true }));

            setTimeout(() => {
                textarea.focus();
                textarea.setSelectionRange(start + 5, start + 5 + (selectedText || 'Your code here').length);
            }, 0);
        }

        function insertLinkAtCursor() {
            const textarea = document.getElementById('markdown-textarea-' + componentId);
            if (!textarea) return;

            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            const linkText = selectedText || 'Link text';
            const replacement = `[${linkText}](https://example.com)`;

            textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
            textarea.dispatchEvent(new Event('input', { bubbles: true }));

            setTimeout(() => {
                textarea.focus();
                const urlStart = start + linkText.length + 3;
                textarea.setSelectionRange(urlStart, urlStart + 19);
            }, 0);
        }

        // Livewire event listeners
        $wire.on('insert-text', (event) => {
            insertTextAtCursor(event.before, event.after);
        });

        $wire.on('insert-code-block', () => {
            insertCodeBlockAtCursor();
        });

        $wire.on('insert-link', () => {
            insertLinkAtCursor();
        });

        // Clear editor content when requested
        $wire.on('clear-editor-content', () => {
            const textarea = document.getElementById('markdown-textarea-' + componentId);
            if (textarea) {
                textarea.value = '';
                textarea.dispatchEvent(new Event('input', { bubbles: true }));
            }
        });

        // Listen for preview tab activation
        $wire.on('preview-tab-activated', () => {
            // Small delay to ensure DOM is updated
            setTimeout(updateMarkdownPreview, 100);
        });

        // Listen for write tab activation - reinitialize mention detection
        $wire.on('write-tab-activated', () => {
            console.log('Write tab activated, reinitializing mention detection');
            setTimeout(initializeMentionDetection, 100);
        });

        // Listen for tab changes to reinitialize mention detection
        $wire.on('$refresh', () => {
            setTimeout(initializeMentionDetection, 50);
        });

        // Also listen for content changes while in preview mode
        document.addEventListener('livewire:updated', function(event) {
            if ($wire.get('activeTab') === 'preview') {
                updateMarkdownPreview();
            }
        });

        // Mention functionality
        let mentionDetectionTimeout;
        function handleMentionDetection(event) {
            const textarea = event.target;
            const cursorPos = textarea.selectionStart;
            const textBeforeCursor = textarea.value.substring(0, cursorPos);
            
            console.log('Mention detection triggered for:', componentId, 'Input:', textBeforeCursor.slice(-10));
            
            // Clear previous timeout to debounce
            clearTimeout(mentionDetectionTimeout);
            
            mentionDetectionTimeout = setTimeout(() => {
                // Check if we're typing after an @ symbol
                const mentionMatch = textBeforeCursor.match(/@([a-zA-Z0-9._-]*)$/);
                
                if (mentionMatch) {
                    console.log('Mention pattern found:', mentionMatch[1]); 
                    const query = mentionMatch[1];
                    const startPos = cursorPos - mentionMatch[0].length + 1;
                    
                    // Only update if values have changed to prevent unnecessary re-renders
                    if ($wire.get('mentionStartPos') !== startPos) {
                        $wire.set('mentionStartPos', startPos);
                    }
                    
                    // Call search with debouncing to prevent multiple calls
                    if ($wire.get('mentionQuery') !== query) {
                        $wire.call('searchUsers', query);
                    }
                    
                    // Show dropdown if not already shown
                    if (!$wire.get('showMentionDropdown')) {
                        $wire.set('showMentionDropdown', true);
                        console.log('Mention dropdown should be visible now');
                    }
                    
                } else {
                    // Hide dropdown if showing and no mention pattern
                    if ($wire.get('showMentionDropdown')) {
                        console.log('Hiding mention dropdown');
                        $wire.call('hideMentionDropdown');
                    }
                }
            }, 50); // Short delay to allow @ insertion to complete
        }
        
        function updateDropdownPosition(textarea) {
            const dropdown = document.querySelector('.mention-dropdown-' + componentId);
            if (dropdown) {
                // Simple stable positioning - dropdown is already positioned relative to editor container
                // It will appear below the textarea with margin-top: 8px
                console.log('Dropdown positioned below textarea with stable absolute positioning');
            }
        }

        function handleMentionKeydown(event) {
            if (!$wire.get('showMentionDropdown')) return;
            
            switch (event.key) {
                case 'ArrowDown':
                    event.preventDefault();
                    $wire.call('navigateMention', 'down');
                    break;
                case 'ArrowUp':
                    event.preventDefault();
                    $wire.call('navigateMention', 'up');
                    break;
                case 'Enter':
                    event.preventDefault();
                    $wire.call('selectMentionByIndex', $wire.get('mentionSelectedIndex'));
                    break;
                case 'Escape':
                    event.preventDefault();
                    $wire.call('hideMentionDropdown');
                    break;
            }
        }

        // Handle mention selection
        $wire.on('select-mention', (event) => {
            const textarea = document.getElementById('markdown-textarea-' + componentId);
            if (!textarea) return;
            
            const user = event.user;
            const startPos = event.startPos;
            const mention = `@${user.username} `;
            
            const beforeMention = textarea.value.substring(0, startPos - 1);
            const afterCursor = textarea.value.substring(textarea.selectionStart);
            
            textarea.value = beforeMention + mention + afterCursor;
            
            const newPos = startPos + mention.length - 1;
            textarea.setSelectionRange(newPos, newPos);
            
            textarea.dispatchEvent(new Event('input', { bubbles: true }));
            textarea.focus();
        });
    </script>
    @endscript
</div>