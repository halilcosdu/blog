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

                <!-- Mention -->
                <button type="button" wire:click="insertText('@', '')" @disabled($activeTab === 'preview')
                    class="p-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-700 rounded transition-colors disabled:opacity-50"
                    title="Mention User (@)">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"/>
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
            
            <!-- Mention Dropdown -->
            @if($showMentionDropdown)
            <div class="mention-dropdown-{{ $name }} fixed bg-white/98 dark:bg-slate-800/98 backdrop-blur-xl border border-slate-200/80 dark:border-slate-700/80 rounded-lg shadow-2xl max-h-60 overflow-y-auto min-w-[300px] z-[99999]"
                 style="top: 120px; left: 60px; position: fixed;"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-2">
                
                <!-- Header -->
                <div class="px-4 py-3 border-b border-slate-200/60 dark:border-slate-700/60 bg-slate-50/90 dark:bg-slate-900/90">
                    <div class="text-xs font-semibold text-slate-700 dark:text-slate-300 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"/>
                        </svg>
                        Mention a user
                    </div>
                </div>

                <!-- User List -->
                <div class="py-2">
                    @forelse($mentionUsers as $index => $user)
                        <div wire:click="selectMentionByIndex({{ $index }})" 
                             class="group flex items-center gap-3 px-4 py-2 cursor-pointer transition-all duration-200 hover:bg-slate-100 dark:hover:bg-slate-700
                             {{ $index === $mentionSelectedIndex ? 'bg-red-50 dark:bg-red-900/20 border-l-2 border-red-500' : '' }}">
                            
                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-red-500 to-orange-500 flex items-center justify-center text-white font-bold text-xs">
                                {{ strtoupper(substr($user['name'] ?? 'UN', 0, 2)) }}
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-medium text-slate-900 dark:text-white truncate">
                                    {{ $user['name'] ?? 'Unknown User' }}
                                </div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">
                                    {{ '@' . ($user['username'] ?? 'unknown') }}
                                </div>
                            </div>
                            
                            @if($index === $mentionSelectedIndex)
                            <div class="text-red-500">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            @endif
                        </div>
                    @empty
                        <div class="px-4 py-6 text-center">
                            <svg class="w-8 h-8 text-slate-400 dark:text-slate-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <p class="text-sm text-slate-500 dark:text-slate-400">No users found</p>
                        </div>
                    @endforelse
                </div>
            </div>
            @endif
            @endif

            @if($activeTab === 'preview')
            <!-- Preview -->
            <div class="p-4">
                <div id="preview-content-{{ $name }}" class="prose prose-slate dark:prose-invert max-w-none">
                    @if($content)
                        {!! 
                            preg_replace(
                                '/@([a-zA-Z0-9._-]+)/',
                                '<span class="mention inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">@$1</span>',
                                Str::markdown($content, [
                                    'html_input' => 'strip',
                                    'allow_unsafe_links' => false,
                                ])
                            )
                        !!}
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
        
        // Initialize mention detection - use a more reliable approach
        function initializeMentionDetection() {
            const textarea = document.getElementById('markdown-textarea-' + componentId);
            if (textarea && !textarea.hasAttribute('data-mention-initialized')) {
                textarea.addEventListener('input', handleMentionDetection);
                textarea.addEventListener('keydown', handleMentionKeydown);
                textarea.setAttribute('data-mention-initialized', 'true');
                console.log('Mention detection initialized for', componentId);
            }
        }

        // Try to initialize immediately and also after DOM is ready
        initializeMentionDetection();
        document.addEventListener('DOMContentLoaded', initializeMentionDetection);
        
        // Also initialize after Livewire updates
        document.addEventListener('livewire:updated', function() {
            initializeMentionDetection();
            // Update dropdown position if it's visible
            if ($wire.get('showMentionDropdown')) {
                const textarea = document.getElementById('markdown-textarea-' + componentId);
                if (textarea) {
                    updateDropdownPosition(textarea);
                }
            }
        });
        
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

        // Mention functionality
        function handleMentionDetection(event) {
            const textarea = event.target;
            const cursorPos = textarea.selectionStart;
            const textBeforeCursor = textarea.value.substring(0, cursorPos);
            
            console.log('Input detected:', textBeforeCursor.slice(-10)); // Debug log
            
            // Check if we're typing after an @ symbol
            const mentionMatch = textBeforeCursor.match(/@([a-zA-Z0-9._-]*)$/);
            
            if (mentionMatch) {
                console.log('Mention detected:', mentionMatch[1]); // Debug log
                const query = mentionMatch[1];
                const startPos = cursorPos - mentionMatch[0].length + 1;
                
                // Calculate dropdown position
                updateDropdownPosition(textarea);
                
                // Use $wire.set() for better reliability
                $wire.set('mentionStartPos', startPos);
                $wire.call('searchUsers', query);
                
                // Show dropdown if not already shown
                if (!$wire.get('showMentionDropdown')) {
                    $wire.set('showMentionDropdown', true);
                }
            } else {
                // Hide dropdown if showing and no mention pattern
                if ($wire.get('showMentionDropdown')) {
                    $wire.call('hideMentionDropdown');
                }
            }
        }
        
        function updateDropdownPosition(textarea) {
            const rect = textarea.getBoundingClientRect();
            const dropdown = document.querySelector('.mention-dropdown-' + componentId);
            if (dropdown) {
                const top = rect.bottom + window.scrollY + 5;
                const left = rect.left + window.scrollX + 40; // 40px sağa kaydır
                dropdown.style.top = top + 'px';
                dropdown.style.left = left + 'px';
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