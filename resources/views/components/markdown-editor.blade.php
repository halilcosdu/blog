@props([
    'name' => 'content',
    'value' => '',
    'placeholder' => 'Write something...',
    'rows' => '8',
    'required' => false,
    'wireModel' => null,
])

<div class="markdown-editor-wrapper" x-data="markdownEditor('{{ $wireModel ?? $name }}', @js($value))">
    <!-- Editor Container -->
    <div class="markdown-editor bg-white/50 dark:bg-slate-700/50 border border-slate-200/60 dark:border-slate-600/60 rounded-lg overflow-hidden transition-all focus-within:ring-2 focus-within:ring-red-500/50 focus-within:border-red-500/50">
        
        <!-- Toolbar -->
        <div class="editor-toolbar flex items-center gap-1 p-3 border-b border-slate-200/60 dark:border-slate-600/60 bg-slate-50/50 dark:bg-slate-800/50">
            <!-- Bold -->
            <button type="button" @click="insertText('**', '**')" class="toolbar-btn p-2 hover:bg-slate-200/70 dark:hover:bg-slate-600/70 rounded-lg transition-all" title="Bold">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6 2a1 1 0 000 2h1v12H6a1 1 0 000 2h8a1 1 0 100-2h-1V4h1a1 1 0 100-2H6z"/>
                </svg>
            </button>

            <!-- Italic -->
            <button type="button" @click="insertText('*', '*')" class="toolbar-btn p-2 hover:bg-slate-200/70 dark:hover:bg-slate-600/70 rounded-lg transition-all" title="Italic">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8 2a1 1 0 000 2h1.5l-3 12H6a1 1 0 000 2h4a1 1 0 100-2h-1.5l3-12H12a1 1 0 100-2H8z"/>
                </svg>
            </button>

            <!-- Heading -->
            <button type="button" @click="insertText('## ', '')" class="toolbar-btn p-2 hover:bg-slate-200/70 dark:hover:bg-slate-600/70 rounded-lg transition-all" title="Heading">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h2a1 1 0 011 1v4h6V4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 11-2 0v-4H7v4a1 1 0 11-2 0V4z"/>
                </svg>
            </button>

            <!-- Code -->
            <button type="button" @click="insertText('`', '`')" class="toolbar-btn p-2 hover:bg-slate-200/70 dark:hover:bg-slate-600/70 rounded-lg transition-all" title="Inline Code">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>

            <!-- Code Block -->
            <button type="button" @click="insertCodeBlock()" class="toolbar-btn p-2 hover:bg-slate-200/70 dark:hover:bg-slate-600/70 rounded-lg transition-all" title="Code Block">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                </svg>
            </button>

            <!-- Link -->
            <button type="button" @click="insertLink()" class="toolbar-btn p-2 hover:bg-slate-200/70 dark:hover:bg-slate-600/70 rounded-lg transition-all" title="Link">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                </svg>
            </button>

            <div class="border-l border-slate-200/60 dark:border-slate-600/60 h-6 mx-2"></div>

            <!-- Tabs -->
            <div class="flex bg-slate-100/70 dark:bg-slate-800/70 rounded-lg p-1">
                <button type="button" @click="activeTab = 'write'" :class="{'bg-white dark:bg-slate-600 text-slate-900 dark:text-white shadow-sm': activeTab === 'write', 'text-slate-600 dark:text-slate-400': activeTab !== 'write'}" class="px-3 py-1 text-sm font-medium rounded-md transition-all">
                    Write
                </button>
                <button type="button" @click="activeTab = 'preview'; updatePreview()" :class="{'bg-white dark:bg-slate-600 text-slate-900 dark:text-white shadow-sm': activeTab === 'preview', 'text-slate-600 dark:text-slate-400': activeTab !== 'preview'}" class="px-3 py-1 text-sm font-medium rounded-md transition-all">
                    Preview
                </button>
            </div>
        </div>

        <!-- Editor Content -->
        <div class="editor-content relative">
            <!-- Textarea -->
            <div x-show="activeTab === 'write'" class="relative">
                <textarea
                    x-ref="textarea"
                    {{ $wireModel ? 'wire:model=' . $wireModel : '' }}
                    name="{{ $name }}"
                    rows="{{ $rows }}"
                    placeholder="{{ $placeholder }}"
                    {{ $required ? 'required' : '' }}
                    @input="handleInput($event)"
                    @keydown.tab.prevent="handleTab($event)"
                    @keydown="handleKeydown($event)"
                    @click="if(mentionDropdown.show) mentionDropdown.show = false"
                    class="w-full p-4 text-sm text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 bg-transparent border-0 resize-y focus:outline-none font-mono leading-relaxed"
                    x-model="content"
                ></textarea>

                <!-- Mention Dropdown -->
                <div x-show="mentionDropdown.show" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="transform opacity-0 scale-95 translate-y-1"
                     x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="transform opacity-0 scale-95 translate-y-1"
                     class="absolute bg-white/95 dark:bg-slate-800/95 backdrop-blur-sm border border-slate-200 dark:border-slate-600 rounded-xl shadow-2xl max-h-64 overflow-y-auto min-w-[250px]"
                     style="z-index: 9999;"
                     :style="`top: ${mentionDropdown.top}px; left: ${mentionDropdown.left}px;`">
                    
                    <!-- Header -->
                    <div class="px-4 py-2 border-b border-slate-200 dark:border-slate-700 bg-slate-50/80 dark:bg-slate-900/80">
                        <div class="text-xs font-medium text-slate-500 dark:text-slate-400">Mention a user</div>
                    </div>
                    
                    <!-- User List -->
                    <div class="py-1">
                        <template x-for="(user, index) in mentionDropdown.users" :key="user.id">
                            <div @click="selectMention(user)" 
                                 :class="{
                                     'bg-red-50 dark:bg-red-900/30 border-l-2 border-red-500': index === mentionDropdown.selectedIndex,
                                     'hover:bg-slate-50 dark:hover:bg-slate-700/50': index !== mentionDropdown.selectedIndex
                                 }"
                                 class="flex items-center gap-3 px-4 py-3 cursor-pointer transition-all duration-150">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-r from-red-500 to-orange-400 flex items-center justify-center text-white font-bold text-sm shadow-sm"
                                     x-text="user.name.substring(0, 2).toUpperCase()">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-medium text-slate-900 dark:text-white truncate" x-text="user.name"></div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400" x-text="'@' + user.username"></div>
                                </div>
                                <div x-show="index === mentionDropdown.selectedIndex" class="text-red-500">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        </template>
                        
                        <!-- No users found -->
                        <div x-show="mentionDropdown.users.length === 0" class="px-4 py-8 text-center">
                            <svg class="w-8 h-8 text-slate-400 dark:text-slate-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <div class="text-sm text-slate-500 dark:text-slate-400">No users found</div>
                        </div>
                    </div>
                    
                    <!-- Footer -->
                    <div class="px-4 py-2 border-t border-slate-200 dark:border-slate-700 bg-slate-50/80 dark:bg-slate-900/80">
                        <div class="text-xs text-slate-400 dark:text-slate-500">Use ↑↓ to navigate, Enter to select</div>
                    </div>
                </div>
            </div>

            <!-- Preview -->
            <div x-show="activeTab === 'preview'" class="p-4">
                <div x-show="previewContent" class="prose prose-slate dark:prose-invert max-w-none" x-html="previewContent"></div>
                <div x-show="!previewContent" class="text-slate-500 dark:text-slate-400 text-center py-8">
                    Nothing to preview yet. Write something in the editor!
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Global copy function for code blocks -->
<script>
window.copyCodeToClipboard = async function(button) {
    const codeBlock = button.closest('.code-block-wrapper').querySelector('code');
    const copyIcon = button.querySelector('.copy-icon');
    const checkIcon = button.querySelector('.check-icon');
    
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

<script>
// Markdown Editor Alpine.js Component
document.addEventListener('alpine:init', () => {
    Alpine.data('markdownEditor', (wireModel, initialValue = '') => ({
        content: initialValue,
        activeTab: 'write',
        previewContent: '',
        mentionDropdown: {
            show: false,
            users: [],
            selectedIndex: 0,
            top: 0,
            left: 0,
            query: '',
            startPos: 0
        },

        init() {
            this.updatePreview();
            this.loadMarkdownLibraries();
        },

        loadMarkdownLibraries() {
            if (typeof marked === 'undefined') {
                const markedScript = document.createElement('script');
                markedScript.src = 'https://cdn.jsdelivr.net/npm/marked@9.1.6/marked.min.js';
                markedScript.onload = () => this.updatePreview();
                document.head.appendChild(markedScript);
            }

            if (typeof hljs === 'undefined') {
                const hljsScript = document.createElement('script');
                hljsScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js';
                document.head.appendChild(hljsScript);

                const hljsCSS = document.createElement('link');
                hljsCSS.rel = 'stylesheet';
                hljsCSS.href = 'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css';
                document.head.appendChild(hljsCSS);
            }
        },

        insertText(before, after = '') {
            const textarea = this.$refs.textarea;
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            
            const replacement = before + selectedText + after;
            
            textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
            this.content = textarea.value;
            
            // Set cursor position
            const newPos = start + before.length + selectedText.length + after.length;
            this.$nextTick(() => {
                textarea.focus();
                textarea.setSelectionRange(newPos, newPos);
            });
            
            this.debouncePreview();
        },

        insertCodeBlock() {
            const textarea = this.$refs.textarea;
            const start = textarea.selectionStart;
            const selectedText = textarea.value.substring(start, textarea.selectionEnd);
            
            const codeBlock = '\n```\n' + (selectedText || 'Your code here') + '\n```\n';
            
            textarea.value = textarea.value.substring(0, start) + codeBlock + textarea.value.substring(textarea.selectionEnd);
            this.content = textarea.value;
            
            this.$nextTick(() => {
                textarea.focus();
                textarea.setSelectionRange(start + 5, start + 5 + (selectedText || 'Your code here').length);
            });
            
            this.debouncePreview();
        },

        insertLink() {
            const textarea = this.$refs.textarea;
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            
            const linkText = selectedText || 'Link text';
            const replacement = `[${linkText}](https://example.com)`;
            
            textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
            this.content = textarea.value;
            
            this.$nextTick(() => {
                textarea.focus();
                const urlStart = start + linkText.length + 3;
                textarea.setSelectionRange(urlStart, urlStart + 19);
            });
            
            this.debouncePreview();
        },

        handleTab(event) {
            const textarea = this.$refs.textarea;
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;

            textarea.value = textarea.value.substring(0, start) + '\t' + textarea.value.substring(end);
            this.content = textarea.value;
            textarea.selectionStart = textarea.selectionEnd = start + 1;
        },

        handleKeydown(event) {
            // Handle mention dropdown navigation
            if (this.mentionDropdown.show) {
                if (event.key === 'ArrowDown') {
                    event.preventDefault();
                    this.mentionDropdown.selectedIndex = Math.min(this.mentionDropdown.selectedIndex + 1, this.mentionDropdown.users.length - 1);
                } else if (event.key === 'ArrowUp') {
                    event.preventDefault();
                    this.mentionDropdown.selectedIndex = Math.max(this.mentionDropdown.selectedIndex - 1, 0);
                } else if (event.key === 'Enter') {
                    event.preventDefault();
                    if (this.mentionDropdown.users[this.mentionDropdown.selectedIndex]) {
                        this.selectMention(this.mentionDropdown.users[this.mentionDropdown.selectedIndex]);
                    }
                } else if (event.key === 'Escape') {
                    this.mentionDropdown.show = false;
                }
                return;
            }

            // Detect @ mentions - trigger after @ is typed
            if (event.key === '@') {
                this.$nextTick(() => {
                    const textarea = this.$refs.textarea;
                    const pos = textarea.selectionStart;
                    this.mentionDropdown.startPos = pos;
                    this.showMentionDropdown(textarea, pos);
                });
            }
        },

        // New method to handle input changes for mention detection
        handleInput(event) {
            this.content = event.target.value;
            
            const textarea = this.$refs.textarea;
            
            if (!textarea) {
                return;
            }
            
            const cursorPos = textarea.selectionStart;
            const textBeforeCursor = textarea.value.substring(0, cursorPos);
            
            // Check if we're currently typing after an @
            const mentionMatch = textBeforeCursor.match(/@(\w*)$/);
            
            if (mentionMatch) {
                const query = mentionMatch[1];
                this.mentionDropdown.query = query;
                this.mentionDropdown.startPos = cursorPos - mentionMatch[0].length + 1;
                
                if (!this.mentionDropdown.show) {
                    // Use $nextTick to ensure DOM is ready
                    this.$nextTick(() => {
                        this.showMentionDropdown(textarea, cursorPos);
                    });
                } else {
                    // Update search if dropdown already showing
                    this.searchUsers(query);
                }
            } else if (this.mentionDropdown.show) {
                this.mentionDropdown.show = false;
            }
            
            this.debouncePreview();
        },

        showMentionDropdown(textarea, pos) {
            if (!this.$el || !textarea) {
                return;
            }
            
            // Position dropdown at a fixed location relative to textarea
            this.mentionDropdown.top = 50; // 50px from top of textarea
            this.mentionDropdown.left = 20; // 20px from left
            
            this.mentionDropdown.show = true;
            this.mentionDropdown.selectedIndex = 0;
            
            this.searchUsers('');
        },

        async searchUsers(query) {
            // TODO: Replace with actual API call
            // Mock data for now
            const mockUsers = [
                { id: 1, name: 'John Doe', username: 'johndoe' },
                { id: 2, name: 'Jane Smith', username: 'janesmith' },
                { id: 3, name: 'Bob Johnson', username: 'bobjohnson' },
                { id: 4, name: 'Alice Cooper', username: 'alicecooper' },
                { id: 5, name: 'Mike Wilson', username: 'mikewilson' },
                { id: 6, name: 'Sarah Davis', username: 'sarahdavis' },
                { id: 7, name: 'David Brown', username: 'davidbrown' },
                { id: 8, name: 'Emma Thompson', username: 'emmathompson' }
            ];

            if (!query || query.length === 0) {
                this.mentionDropdown.users = mockUsers.slice(0, 5);
                return;
            }
            
            const filteredUsers = mockUsers.filter(user => 
                user.name.toLowerCase().includes(query.toLowerCase()) || 
                user.username.toLowerCase().includes(query.toLowerCase())
            );
            
            this.mentionDropdown.users = filteredUsers.slice(0, 5);
        },

        selectMention(user) {
            const textarea = this.$refs.textarea;
            const beforeMention = textarea.value.substring(0, this.mentionDropdown.startPos - 1);
            const afterCursor = textarea.value.substring(textarea.selectionStart);
            
            const mention = `@${user.username} `;
            textarea.value = beforeMention + mention + afterCursor;
            this.content = textarea.value;
            
            const newPos = this.mentionDropdown.startPos + mention.length - 1;
            textarea.setSelectionRange(newPos, newPos);
            
            this.mentionDropdown.show = false;
            this.debouncePreview();
        },

        updatePreview() {
            if (typeof marked !== 'undefined') {
                // Configure marked with custom renderer
                const renderer = new marked.Renderer();
                
                // Custom code block renderer with language indicator
                renderer.code = function(code, language) {
                    const validLang = language && hljs?.getLanguage(language) ? language : 'plaintext';
                    const highlightedCode = hljs?.highlight(code, { language: validLang })?.value || code;
                    
                    return `
                        <div class="code-block-wrapper relative group mb-4">
                            <div class="code-header flex items-center justify-between bg-slate-800 dark:bg-slate-900 text-slate-300 px-4 py-2 text-sm font-mono rounded-t-lg">
                                <span class="text-slate-400">${language || 'text'}</span>
                                <button class="copy-btn opacity-0 group-hover:opacity-100 transition-opacity hover:bg-slate-700 p-1 rounded" onclick="copyCodeToClipboard(this)">
                                    <svg class="copy-icon w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    <svg class="check-icon w-4 h-4 hidden" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                            <pre class="bg-slate-900 dark:bg-slate-950 text-slate-100 p-4 rounded-b-lg overflow-x-auto"><code class="hljs language-${validLang}">${highlightedCode}</code></pre>
                        </div>
                    `;
                };

                // Custom blockquote renderer
                renderer.blockquote = function(quote) {
                    return `
                        <blockquote class="border-l-4 border-red-500 pl-4 py-2 my-4 bg-slate-50 dark:bg-slate-800/50 rounded-r-lg">
                            ${quote}
                        </blockquote>
                    `;
                };

                // Custom table renderer
                renderer.table = function(header, body) {
                    return `
                        <div class="overflow-x-auto my-4">
                            <table class="min-w-full border border-slate-200 dark:border-slate-700 rounded-lg">
                                <thead class="bg-slate-50 dark:bg-slate-800">
                                    ${header}
                                </thead>
                                <tbody>
                                    ${body}
                                </tbody>
                            </table>
                        </div>
                    `;
                };

                marked.setOptions({
                    renderer: renderer,
                    highlight: function(code, lang) {
                        if (typeof hljs !== 'undefined' && lang && hljs.getLanguage(lang)) {
                            try {
                                return hljs.highlight(code, { language: lang }).value;
                            } catch (__) {}
                        }
                        return code;
                    },
                    breaks: true,
                    gfm: true,
                    tables: true,
                    sanitize: false
                });
                
                // Process content with improved mention and link handling
                let processedContent = this.content
                    // Process mentions with hover cards
                    .replace(/@(\w+)/g, '<span class="mention inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold cursor-pointer hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors" title="User: $1">@$1</span>')
                    // Process task lists
                    .replace(/^\s*- \[ \] (.+)$/gm, '<li class="flex items-center gap-2"><input type="checkbox" disabled class="rounded"> <span>$1</span></li>')
                    .replace(/^\s*- \[x\] (.+)$/gm, '<li class="flex items-center gap-2"><input type="checkbox" checked disabled class="rounded"> <span class="line-through text-slate-500">$1</span></li>');
                
                this.previewContent = marked.parse(processedContent);
                
                // Enhance preview after rendering
                this.$nextTick(() => {
                    this.enhancePreview();
                });
            }
        },

        enhancePreview() {
            // Add syntax highlighting if hljs is loaded
            if (typeof hljs !== 'undefined') {
                this.$el.querySelectorAll('pre code:not(.hljs)').forEach((block) => {
                    hljs.highlightElement(block);
                });
            }

            // Add smooth animations to elements
            this.$el.querySelectorAll('.code-block-wrapper, blockquote, table').forEach((el) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    el.style.transition = 'all 0.3s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, 50);
            });

            // Add click-to-expand for long code blocks
            this.$el.querySelectorAll('pre').forEach((pre) => {
                if (pre.scrollHeight > 400) {
                    pre.style.maxHeight = '400px';
                    pre.style.overflow = 'hidden';
                    pre.classList.add('expandable-code');
                    
                    const expandBtn = document.createElement('button');
                    expandBtn.className = 'expand-code-btn absolute bottom-2 right-2 bg-slate-700 hover:bg-slate-600 text-white text-xs px-2 py-1 rounded';
                    expandBtn.textContent = 'Show more';
                    expandBtn.onclick = () => {
                        if (pre.style.maxHeight === '400px') {
                            pre.style.maxHeight = 'none';
                            pre.style.overflow = 'auto';
                            expandBtn.textContent = 'Show less';
                        } else {
                            pre.style.maxHeight = '400px';
                            pre.style.overflow = 'hidden';
                            expandBtn.textContent = 'Show more';
                        }
                    };
                    pre.appendChild(expandBtn);
                }
            });
        },

        debouncePreview() {
            clearTimeout(this.previewTimeout);
            this.previewTimeout = setTimeout(() => {
                this.updatePreview();
            }, 300);
        }
    }));
});
</script>