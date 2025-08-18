@props([
    'wireModel' => null,
    'id' => 'quill-editor',
    'placeholder' => 'Start typing...',
    'height' => '200px'
])

@php
    $studlyId = str_replace(['-', '_'], '', ucwords($id, '-_'));
@endphp

<div>
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    
    <!-- Editor Container -->
    <div 
        id="{{ $id }}"
        style="height: {{ $height }}"
        class="bg-white dark:bg-slate-800"
        data-placeholder="{{ $placeholder }}"
        wire:ignore
    ></div>
    
    <script>
        document.addEventListener('livewire:navigated', function() {
            setTimeout(() => initQuillEditor{{ $studlyId }}(), 100);
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => initQuillEditor{{ $studlyId }}(), 100);
        });
        
        function initQuillEditor{{ $studlyId }}() {
            const editorId = '{{ $id }}';
            const editorElement = document.getElementById(editorId);
            
            if (!editorElement || editorElement.classList.contains('ql-container')) {
                return; // Already initialized
            }
            
            // Initialize Quill
            const quill = new Quill('#' + editorId, {
                theme: 'snow',
                placeholder: '{{ $placeholder }}',
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

            @if($wireModel)
            // Get Livewire component
            let component;
            try {
                const wireElement = document.querySelector('[wire\\:id]');
                if (wireElement) {
                    component = Livewire.find(wireElement.getAttribute('wire:id'));
                }
            } catch(e) {
                console.log('Livewire component not found');
            }
            
            if (component) {
                // Set initial content
                const initialContent = component.get('{{ $wireModel }}');
                if (initialContent && initialContent.trim() !== '') {
                    quill.root.innerHTML = initialContent;
                }

                // Update Livewire when editor content changes
                quill.on('text-change', function(delta, oldDelta, source) {
                    if (source === 'user') {
                        const content = quill.root.innerHTML.trim();
                        // Check if content is empty or just empty paragraph
                        if (content === '<p><br></p>' || content === '' || content === '<p></p>') {
                            component.set('{{ $wireModel }}', '');
                        } else {
                            component.set('{{ $wireModel }}', content);
                        }
                    }
                });

                // Also trigger on blur to ensure content is saved
                quill.on('selection-change', function(range, oldRange, source) {
                    if (range === null && oldRange !== null) { // Lost focus
                        const content = quill.root.innerHTML.trim();
                        if (content === '<p><br></p>' || content === '' || content === '<p></p>') {
                            component.set('{{ $wireModel }}', '');
                        } else {
                            component.set('{{ $wireModel }}', content);
                        }
                    }
                });
            }
            @endif
        }
    </script>
</div>