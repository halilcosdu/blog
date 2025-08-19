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
        <div class="editor-content">
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
            @endif

            @if($activeTab === 'preview')
            <!-- Preview -->
            <div class="p-4">
                <div id="preview-content-{{ $name }}" class="prose prose-slate dark:prose-invert max-w-none">
                    @if($content)
                        {!! Str::markdown($content, [
                            'html_input' => 'strip',
                            'allow_unsafe_links' => false,
                        ]) !!}
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

    <!-- JavaScript -->
    @script
    <script>
        const componentId = '{{ $name }}';
        
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
            }, 0);
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
    </script>
    @endscript
</div>