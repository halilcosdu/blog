<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markdown Editor Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 min-h-screen" 
      x-data="{ 
          darkMode: window.matchMedia('(prefers-color-scheme: dark)').matches,
          init() {
              this.$watch('darkMode', (val) => {
                  localStorage.setItem('darkMode', val);
              });
              
              const savedMode = localStorage.getItem('darkMode');
              if (savedMode !== null) {
                  this.darkMode = savedMode === 'true';
              }
          }
      }" 
      :class="{ 'dark': darkMode }">
    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Markdown Editor Test</h1>

            <!-- Dark Mode Toggle -->
            <button @click="darkMode = !darkMode" class="p-2 rounded-lg bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 transition-all">
                <svg x-show="!darkMode" class="w-6 h-6 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
                <svg x-show="darkMode" class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" style="display: none;">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>

        @php
            $initialMarkdown = <<<'MD'
# 🚀 Welcome to Advanced Markdown Editor!

This editor supports **bold text**, *italic text*, and even ***bold italic***!

## ✨ Features:
- [x] Real-time preview with syntax highlighting
- [x] @username mentions (try typing @johndoe)
- [x] Interactive code blocks with copy buttons
- [ ] Advanced table support
- [ ] Task lists like this one

## 📝 Code Examples:

### JavaScript
```javascript
// This is a JavaScript example
function greetUser(name) {
    console.log("Hello, " + name + "!");
    return "Welcome to our markdown editor, " + name + "!";
}

greetUser("Developer");
```

### PHP
```php
<?php
// Laravel example
class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }
}
```

### Python
```python
# Python example with syntax highlighting
def fibonacci(n):
    if n <= 1:
        return n
    return fibonacci(n-1) + fibonacci(n-2)

# Generate first 10 fibonacci numbers
for i in range(10):
    print(f"F({i}) = {fibonacci(i)}")
```

## 📊 Tables:

| Feature | Status | Description |
|---------|--------|-------------|
| Preview | ✅ | Real-time markdown preview |
| Mentions | ✅ | @username autocomplete |
| Code Blocks | ✅ | Syntax highlighted with copy |
| Dark Mode | ✅ | Full dark mode support |

## 💬 Blockquotes:

> This is a blockquote example.
> It supports multiple lines and looks great!
>
> — Anonymous Developer

## 🔗 Links and More:

Check out [Laravel](https://laravel.com) for more information.

**Try the features:**
1. Switch between Write/Preview tabs
2. Use toolbar buttons for formatting
3. Type @ to mention users
4. Copy code from the blocks above
5. Test the dark mode toggle!
MD;
        @endphp

        <div class="space-y-6">
            <!-- Test Component -->
            <x-markdown-editor
                name="test_content"
                placeholder="Type your markdown here... Try @ to mention users, ** for bold, or &#96;&#96;&#96; for code blocks!"
                rows="10"
                :value="$initialMarkdown"
            />

            <div class="flex gap-4">
                <button class="flex-1 px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all">
                    Test Submit Button
                </button>
                
                <!-- Manual Mention Test -->
                <button onclick="testMention()" class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-xl transition-all">
                    Test @ Mention
                </button>
            </div>

            <script>
                function testMention() {
                    // Find the textarea and manually trigger mention
                    const textarea = document.querySelector('textarea[name="test_content"]');
                    if (textarea) {
                        // Add @ at current cursor position
                        const start = textarea.selectionStart;
                        const end = textarea.selectionEnd;
                        textarea.value = textarea.value.substring(0, start) + '@' + textarea.value.substring(end);
                        
                        // Move cursor after @
                        textarea.selectionStart = textarea.selectionEnd = start + 1;
                        
                        // Manually trigger the input event
                        const inputEvent = new Event('input', { bubbles: true });
                        textarea.dispatchEvent(inputEvent);
                        
                        textarea.focus();
                    }
                }
            </script>
        </div>
    </div>
</body>
</html>
