<div class="markdown-editor-wrapper group">
    <!-- Editor Container -->
    <div class="markdown-editor relative bg-gradient-to-br from-white/95 via-white/98 to-slate-50/95 dark:from-slate-900/95 dark:via-slate-800/98 dark:to-slate-950/95 backdrop-blur-xl border border-slate-200/60 dark:border-slate-700/80 rounded-2xl overflow-hidden shadow-xl shadow-slate-200/25 dark:shadow-slate-900/60 transition-all duration-500 hover:shadow-2xl hover:shadow-slate-200/35 dark:hover:shadow-slate-900/70 focus-within:ring-2 focus-within:ring-gradient-to-r focus-within:ring-red-500/30 focus-within:border-red-500/50 transform hover:scale-[1.01]">

        <!-- Toolbar -->
        <div class="editor-toolbar flex items-center justify-between p-4 border-b border-slate-200/40 dark:border-slate-600/60 bg-gradient-to-r from-slate-50/90 via-white/90 to-slate-50/90 dark:from-slate-900/95 dark:via-slate-800/95 dark:to-slate-900/95 backdrop-blur-sm">
            <!-- Left side - Format buttons -->
            <div class="flex items-center gap-1">
            <!-- Bold -->
            <button type="button" wire:click="insertText('**', '**')" @disabled($activeTab === 'preview') @class([
                'group/btn relative p-2.5 bg-white/50 dark:bg-slate-700/50 rounded-xl shadow-sm hover:shadow-md border border-slate-200/50 dark:border-slate-600/50 transition-all duration-300',
                'opacity-50 cursor-not-allowed pointer-events-none' => $activeTab === 'preview',
                'hover:bg-gradient-to-r hover:from-red-50 hover:to-orange-50 dark:hover:from-red-900/20 dark:hover:to-orange-900/20 hover:border-red-300/50 dark:hover:border-red-600/50 hover:scale-105 active:scale-95' => $activeTab === 'write'
            ]) title="Bold">
                <svg @class([
                    'w-4 h-4 transition-colors',
                    'text-slate-300 dark:text-slate-600' => $activeTab === 'preview',
                    'text-slate-600 dark:text-slate-400 group-hover/btn:text-red-600 dark:group-hover/btn:text-red-400' => $activeTab === 'write'
                ]) fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6 2a1 1 0 000 2h1v12H6a1 1 0 000 2h8a1 1 0 100-2h-1V4h1a1 1 0 100-2H6z"/>
                </svg>
            </button>

            <!-- Italic -->
            <button type="button" wire:click="insertText('*', '*')" @disabled($activeTab === 'preview') @class([
                'group/btn relative p-2.5 bg-white/50 dark:bg-slate-700/50 rounded-xl shadow-sm hover:shadow-md border border-slate-200/50 dark:border-slate-600/50 transition-all duration-300',
                'opacity-50 cursor-not-allowed pointer-events-none' => $activeTab === 'preview',
                'hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 dark:hover:from-blue-900/20 dark:hover:to-indigo-900/20 hover:border-blue-300/50 dark:hover:border-blue-600/50 hover:scale-105 active:scale-95' => $activeTab === 'write'
            ]) title="Italic">
                <svg @class([
                    'w-4 h-4 transition-colors',
                    'text-slate-300 dark:text-slate-600' => $activeTab === 'preview',
                    'text-slate-600 dark:text-slate-400 group-hover/btn:text-blue-600 dark:group-hover/btn:text-blue-400' => $activeTab === 'write'
                ]) fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8 2a1 1 0 000 2h1.5l-3 12H6a1 1 0 000 2h4a1 1 0 100-2h-1.5l3-12H12a1 1 0 100-2H8z"/>
                </svg>
            </button>

            <!-- Heading -->
            <button type="button" wire:click="insertText('## ', '')" @disabled($activeTab === 'preview') @class([
                'group/btn relative p-2.5 bg-white/50 dark:bg-slate-700/50 rounded-xl shadow-sm hover:shadow-md border border-slate-200/50 dark:border-slate-600/50 transition-all duration-300',
                'opacity-50 cursor-not-allowed pointer-events-none' => $activeTab === 'preview',
                'hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 dark:hover:from-purple-900/20 dark:hover:to-pink-900/20 hover:border-purple-300/50 dark:hover:border-purple-600/50 hover:scale-105 active:scale-95' => $activeTab === 'write'
            ]) title="Heading">
                <svg @class([
                    'w-4 h-4 transition-colors',
                    'text-slate-300 dark:text-slate-600' => $activeTab === 'preview',
                    'text-slate-600 dark:text-slate-400 group-hover/btn:text-purple-600 dark:group-hover/btn:text-purple-400' => $activeTab === 'write'
                ]) fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h2a1 1 0 011 1v4h6V4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 11-2 0v-4H7v4a1 1 0 11-2 0V4z"/>
                </svg>
            </button>

            <!-- Code -->
            <button type="button" wire:click="insertText('`', '`')" @disabled($activeTab === 'preview') @class([
                'group/btn relative p-2.5 bg-white/50 dark:bg-slate-700/50 rounded-xl shadow-sm hover:shadow-md border border-slate-200/50 dark:border-slate-600/50 transition-all duration-300',
                'opacity-50 cursor-not-allowed pointer-events-none' => $activeTab === 'preview',
                'hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 dark:hover:from-green-900/20 dark:hover:to-emerald-900/20 hover:border-green-300/50 dark:hover:border-green-600/50 hover:scale-105 active:scale-95' => $activeTab === 'write'
            ]) title="Inline Code">
                <svg @class([
                    'w-4 h-4 transition-colors',
                    'text-slate-300 dark:text-slate-600' => $activeTab === 'preview',
                    'text-slate-600 dark:text-slate-400 group-hover/btn:text-green-600 dark:group-hover/btn:text-green-400' => $activeTab === 'write'
                ]) fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>

            <!-- Code Block -->
            <button type="button" wire:click="insertCodeBlock()" @disabled($activeTab === 'preview') @class([
                'group/btn relative p-2.5 bg-white/50 dark:bg-slate-700/50 rounded-xl shadow-sm hover:shadow-md border border-slate-200/50 dark:border-slate-600/50 transition-all duration-300',
                'opacity-50 cursor-not-allowed pointer-events-none' => $activeTab === 'preview',
                'hover:bg-gradient-to-r hover:from-yellow-50 hover:to-amber-50 dark:hover:from-yellow-900/20 dark:hover:to-amber-900/20 hover:border-yellow-300/50 dark:hover:border-yellow-600/50 hover:scale-105 active:scale-95' => $activeTab === 'write'
            ]) title="Code Block">
                <svg @class([
                    'w-4 h-4 transition-colors',
                    'text-slate-300 dark:text-slate-600' => $activeTab === 'preview',
                    'text-slate-600 dark:text-slate-400 group-hover/btn:text-yellow-600 dark:group-hover/btn:text-yellow-500' => $activeTab === 'write'
                ]) fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                </svg>
            </button>

            <!-- Link -->
            <button type="button" wire:click="insertLink()" @disabled($activeTab === 'preview') @class([
                'group/btn relative p-2.5 bg-white/50 dark:bg-slate-700/50 rounded-xl shadow-sm hover:shadow-md border border-slate-200/50 dark:border-slate-600/50 transition-all duration-300',
                'opacity-50 cursor-not-allowed pointer-events-none' => $activeTab === 'preview',
                'hover:bg-gradient-to-r hover:from-cyan-50 hover:to-blue-50 dark:hover:from-cyan-900/20 dark:hover:to-blue-900/20 hover:border-cyan-300/50 dark:hover:border-cyan-600/50 hover:scale-105 active:scale-95' => $activeTab === 'write'
            ]) title="Link">
                <svg @class([
                    'w-4 h-4 transition-colors',
                    'text-slate-300 dark:text-slate-600' => $activeTab === 'preview',
                    'text-slate-600 dark:text-slate-400 group-hover/btn:text-cyan-600 dark:group-hover/btn:text-cyan-400' => $activeTab === 'write'
                ]) fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                </svg>
            </button>

            <div class="w-px h-8 bg-gradient-to-b from-transparent via-slate-300 dark:via-slate-600 to-transparent mx-3"></div>
            </div>

            <!-- Right side - Tab controls -->
            <!-- Tabs -->
            <div class="flex bg-gradient-to-r from-slate-100/80 to-slate-200/80 dark:from-slate-800/80 dark:to-slate-900/80 rounded-xl p-1.5 shadow-inner">
                <button type="button" wire:click="setActiveTab('write')" @class([
                    'relative px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-300 flex items-center gap-2',
                    'bg-gradient-to-r from-white to-slate-50 dark:from-slate-600 dark:to-slate-700 text-slate-900 dark:text-white shadow-lg shadow-slate-200/50 dark:shadow-slate-900/50 scale-105' => $activeTab === 'write',
                    'text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200' => $activeTab !== 'write'
                ])>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Write
                </button>
                <button type="button" wire:click="setActiveTab('preview')" @class([
                    'relative px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-300 flex items-center gap-2',
                    'bg-gradient-to-r from-white to-slate-50 dark:from-slate-600 dark:to-slate-700 text-slate-900 dark:text-white shadow-lg shadow-slate-200/50 dark:shadow-slate-900/50 scale-105' => $activeTab === 'preview',
                    'text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200' => $activeTab !== 'preview'
                ])>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Preview
                </button>
            </div>
        </div>

        <!-- Editor Content -->
        <div class="editor-content relative">
            <!-- Textarea -->
            @if($activeTab === 'write')
            <div class="relative bg-gradient-to-br from-slate-50/30 via-white/20 to-slate-100/30 dark:from-slate-900/80 dark:via-slate-800/90 dark:to-slate-950/80 backdrop-blur-sm">
                <textarea
                    id="markdown-textarea-{{ $name }}"
                    wire:model.live="content"
                    name="{{ $name }}"
                    rows="{{ $rows }}"
                    placeholder="{{ $placeholder }}"
                    @if($required) required @endif
                    class="w-full p-6 text-base text-slate-900 dark:text-slate-50 placeholder-slate-400/80 dark:placeholder-slate-400/60 bg-gradient-to-br from-transparent via-white/5 to-transparent dark:from-slate-900/60 dark:via-slate-950/80 dark:to-slate-900/60 border-0 resize-y focus:outline-none font-mono leading-7 selection:bg-red-100 dark:selection:bg-red-900/60 selection:text-red-900 dark:selection:text-red-100 transition-all duration-300 caret-red-500 dark:caret-red-400"
                    style="{{ request()->cookie('theme') === 'dark' || (!request()->cookie('theme') && request()->header('Sec-CH-Prefers-Color-Scheme') === 'dark') ? 'text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);' : 'text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);' }}"
                ></textarea>

                <!-- Mention Dropdown -->
                @if($mentionDropdown['show'])
                <div 
                    class="absolute bg-gradient-to-br from-white/95 via-white/98 to-slate-50/95 dark:from-slate-800/95 dark:via-slate-800/98 dark:to-slate-900/95 backdrop-blur-xl border border-slate-200/30 dark:border-slate-600/30 rounded-2xl shadow-2xl shadow-slate-900/10 dark:shadow-slate-900/40 max-h-80 overflow-y-auto min-w-[280px] ring-1 ring-slate-200/20 dark:ring-slate-700/20"
                    style="z-index: 9999; top: {{ $mentionDropdown['top'] }}px; left: {{ $mentionDropdown['left'] }}px;"
                    wire:transition.opacity
                >

                    <!-- Header -->
                    <div class="px-5 py-3 border-b border-slate-200/20 dark:border-slate-700/20 bg-gradient-to-r from-slate-50/60 via-white/60 to-slate-50/60 dark:from-slate-800/60 dark:via-slate-700/60 dark:to-slate-800/60">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <div class="text-xs font-semibold text-slate-600 dark:text-slate-400">Mention a user</div>
                        </div>
                    </div>

                    <!-- User List -->
                    <div class="py-2">
                        @forelse($mentionDropdown['users'] as $index => $user)
                            <div wire:click="selectMentionByIndex({{ $index }})" @class([
                                'group flex items-center gap-4 px-5 py-3.5 mx-2 rounded-xl cursor-pointer transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]',
                                'bg-gradient-to-r from-red-50 via-red-50/80 to-orange-50 dark:from-red-900/20 dark:via-red-900/15 dark:to-orange-900/20 border-l-3 border-red-500 shadow-sm' => $index === $mentionDropdown['selectedIndex'],
                                'hover:bg-gradient-to-r hover:from-slate-50/50 hover:to-slate-100/50 dark:hover:from-slate-700/30 dark:hover:to-slate-600/30' => $index !== $mentionDropdown['selectedIndex']
                            ])>
                                <div class="relative w-10 h-10 rounded-2xl bg-gradient-to-br from-red-500 via-red-600 to-orange-500 flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-red-500/25 ring-2 ring-white/20 dark:ring-slate-800/20 group-hover:shadow-xl group-hover:shadow-red-500/30 transition-all duration-200">
                                    {{ strtoupper(substr($user['name'], 0, 2)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-semibold text-slate-900 dark:text-white truncate group-hover:text-slate-950 dark:group-hover:text-slate-50 transition-colors">{{ $user['name'] }}</div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-1">
                                        <span>@</span><span>{{ $user['username'] }}</span>
                                    </div>
                                </div>
                                @if($index === $mentionDropdown['selectedIndex'])
                                <div class="text-red-500">
                                    <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                                @endif
                            </div>
                        @empty
                            <!-- No users found -->
                            <div class="px-4 py-8 text-center">
                                <svg class="w-8 h-8 text-slate-400 dark:text-slate-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <div class="text-sm text-slate-500 dark:text-slate-400">No users found</div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Footer -->
                    <div class="px-4 py-2 border-t border-slate-200 dark:border-slate-700 bg-slate-50/80 dark:bg-slate-900/80">
                        <div class="text-xs text-slate-400 dark:text-slate-500">Use ↑↓ to navigate, Enter to select</div>
                    </div>
                </div>
                @endif
            </div>
            @endif

            <!-- Preview -->
            @if($activeTab === 'preview')
            <div class="p-6">
                <div id="preview-content-{{ $name }}" 
                     class="prose prose-slate dark:prose-invert max-w-none prose-headings:text-slate-900 dark:prose-headings:text-slate-100 prose-p:text-slate-700 dark:prose-p:text-slate-300 prose-strong:text-slate-900 dark:prose-strong:text-slate-100 prose-code:text-red-600 dark:prose-code:text-red-400 prose-code:bg-red-50 dark:prose-code:bg-red-900/20 prose-code:px-2 prose-code:py-1 prose-code:rounded-md prose-pre:bg-slate-900 dark:prose-pre:bg-slate-950 prose-pre:border prose-pre:border-slate-200 dark:prose-pre:border-slate-800 prose-pre:my-0 prose-pre:p-0"
                     wire:transition.opacity>
                    @if($content)
                        <!-- Preview content will be updated via JavaScript -->
                    @else
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-800 rounded-2xl flex items-center justify-center mb-4 shadow-inner">
                                <svg class="w-8 h-8 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-600 dark:text-slate-400 mb-2">Nothing to preview yet</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-500 max-w-sm">Start writing in the editor to see your markdown come to life with real-time preview!</p>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- JavaScript Integration with Livewire -->
    @script
    <script>
        // Markdown editor JavaScript functionality for component: {{ $name }}
        const componentId = '{{ $name }}';
        let previewTimeout;
        
        // Load markdown libraries if not already loaded
        function loadMarkdownLibraries() {
            if (typeof marked === 'undefined') {
                const markedScript = document.createElement('script');
                markedScript.src = 'https://cdn.jsdelivr.net/npm/marked@9.1.6/marked.min.js';
                markedScript.onload = () => updatePreview();
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
        }

        // Update preview content
        function updatePreview() {
            const textarea = document.getElementById('markdown-textarea-' + componentId);
            const previewElement = document.getElementById('preview-content-' + componentId);
            
            if (!textarea || !previewElement || typeof marked === 'undefined') {
                return;
            }

            try {
                const renderer = new marked.Renderer();

                // Custom code block renderer
                renderer.code = function(code, language) {
                    const validLang = language && hljs?.getLanguage(language) ? language : 'plaintext';
                    const highlightedCode = hljs?.highlight(code, { language: validLang })?.value || code;

                    return `<div class="code-block-wrapper relative group mb-4"><div class="code-header flex items-center justify-between bg-slate-800 dark:bg-slate-900 text-slate-300 px-4 py-2 text-sm font-mono rounded-t-lg"><span class="text-slate-400">${language || 'text'}</span><button type="button" class="copy-btn opacity-0 group-hover:opacity-100 transition-opacity hover:bg-slate-700 p-1 rounded" onclick="copyCodeToClipboard(event)"><svg class="copy-icon w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg><svg class="check-icon w-4 h-4 hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg></button></div><pre class="bg-slate-900 dark:bg-slate-950 text-slate-100 p-4 rounded-b-lg overflow-x-auto"><code class="hljs language-${validLang}">${highlightedCode}</code></pre></div>`;
                };

                marked.setOptions({
                    renderer: renderer,
                    breaks: true,
                    gfm: true,
                });

                const content = textarea.value;
                let htmlContent = marked.parse(content);
                
                // Process mentions 
                htmlContent = htmlContent.replace(/@([a-zA-Z0-9._-]+)/g, '<span class="mention inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold cursor-pointer hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors" title="User: $1">@$1</span>');
                
                previewElement.innerHTML = htmlContent;

                // Highlight code blocks
                if (typeof hljs !== 'undefined') {
                    previewElement.querySelectorAll('pre code:not(.hljs)').forEach((block) => {
                        hljs.highlightElement(block);
                    });
                }
            } catch (error) {
                console.error('Error updating preview:', error);
                previewElement.innerHTML = '<div class="text-red-500 p-4">Error processing markdown: ' + error.message + '</div>';
            }
        }

        // Debounced preview update
        function debouncePreview() {
            clearTimeout(previewTimeout);
            previewTimeout = setTimeout(updatePreview, 300);
        }

        // Text insertion functions
        function insertTextAtCursor(before, after = '') {
            const textarea = document.getElementById('markdown-textarea-' + componentId);
            if (!textarea) return;

            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            const replacement = before + selectedText + after;

            textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
            
            // Update Livewire component
            $wire.set('content', textarea.value);
            
            // Set cursor position
            const newPos = start + before.length + selectedText.length + after.length;
            setTimeout(() => {
                textarea.focus();
                textarea.setSelectionRange(newPos, newPos);
            }, 0);

            debouncePreview();
        }

        function insertCodeBlockAtCursor() {
            const textarea = document.getElementById('markdown-textarea-' + componentId);
            if (!textarea) return;

            const start = textarea.selectionStart;
            const selectedText = textarea.value.substring(start, textarea.selectionEnd);
            const codeBlock = '\n```\n' + (selectedText || 'Your code here') + '\n```\n';

            textarea.value = textarea.value.substring(0, start) + codeBlock + textarea.value.substring(textarea.selectionEnd);
            $wire.set('content', textarea.value);

            setTimeout(() => {
                textarea.focus();
                textarea.setSelectionRange(start + 5, start + 5 + (selectedText || 'Your code here').length);
            }, 0);

            debouncePreview();
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
            $wire.set('content', textarea.value);

            setTimeout(() => {
                textarea.focus();
                const urlStart = start + linkText.length + 3;
                textarea.setSelectionRange(urlStart, urlStart + 19);
            }, 0);

            debouncePreview();
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

        $wire.on('update-preview', () => {
            updatePreview();
        });

        $wire.on('select-mention', (event) => {
            const textarea = document.getElementById('markdown-textarea-' + componentId);
            if (!textarea) return;

            const user = event.user;
            const mention = `@${user.username} `;
            
            // Insert mention at current cursor position (simplified)
            const start = textarea.selectionStart;
            textarea.value = textarea.value.substring(0, start) + mention + textarea.value.substring(start);
            $wire.set('content', textarea.value);

            debouncePreview();
        });

        // Initialize on load
        loadMarkdownLibraries();

        // Listen for content changes to update preview
        document.addEventListener('livewire:updated', () => {
            if ($wire.get('activeTab') === 'preview') {
                debouncePreview();
            }
        });
    </script>
    @endscript
</div>