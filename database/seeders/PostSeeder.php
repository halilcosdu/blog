<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()->where('type', 1)->get();
        $categories = Category::query()->get();

        $realPosts = [
            [
                'title' => 'Modern Laravel ile API Development',
                'slug' => 'modern-laravel-ile-api-development',
                'excerpt' => 'Laravel 12 ile modern RESTful API nasıl geliştirilir? JSON:API, versioning ve best practices.',
                'content' => $this->getPostContent('api'),
                'category' => 'Laravel',
                'author' => 'Halil Coşdu',
                'is_featured' => true,
                'views_count' => 2847,
                'read_time' => 12,
            ],
            [
                'title' => 'Laravel Livewire ile Reactive Components',
                'slug' => 'laravel-livewire-ile-reactive-components',
                'excerpt' => 'Server-side reactive bileşenler oluşturmak için Livewire 3 kullanımı ve best practices.',
                'content' => $this->getPostContent('livewire'),
                'category' => 'Livewire',
                'author' => 'Caleb Porzio',
                'is_featured' => true,
                'views_count' => 1923,
                'read_time' => 8,
            ],
            [
                'title' => 'Tailwind CSS ile Design System Oluşturma',
                'slug' => 'tailwind-css-ile-design-system-olusturma',
                'excerpt' => 'Scalable ve maintainable design system nasıl oluşturulur? Tailwind CSS 4 ile modern yaklaşımlar.',
                'content' => $this->getPostContent('tailwind'),
                'category' => 'Tailwind CSS',
                'author' => 'Adam Wathan',
                'is_featured' => true,
                'views_count' => 3156,
                'read_time' => 15,
            ],
            [
                'title' => 'PHP 8.4 ile Type System ve Performance',
                'slug' => 'php-84-ile-type-system-ve-performance',
                'excerpt' => 'PHP 8.4 yenilikleri: property hooks, asymmetric visibility ve performance iyileştirmeleri.',
                'content' => $this->getPostContent('php'),
                'category' => 'PHP',
                'author' => 'Nuno Maduro',
                'views_count' => 1567,
                'read_time' => 10,
            ],
            [
                'title' => 'Laravel Security Best Practices 2025',
                'slug' => 'laravel-security-best-practices-2025',
                'excerpt' => 'Modern Laravel uygulamalarında güvenlik: OWASP Top 10, CSRF protection ve auth patterns.',
                'content' => $this->getPostContent('security'),
                'category' => 'Security',
                'author' => 'Taylor Otwell',
                'views_count' => 2234,
                'read_time' => 18,
            ],
            [
                'title' => 'Database Optimization ve N+1 Problem Çözümleri',
                'slug' => 'database-optimization-ve-n1-problem-cozumleri',
                'excerpt' => 'Eloquent ORM ile database performance optimization: eager loading, indexing ve query analysis.',
                'content' => $this->getPostContent('database'),
                'category' => 'Databases',
                'author' => 'Jeffrey Way',
                'views_count' => 1889,
                'read_time' => 14,
            ],
            [
                'title' => 'Vue 3 Composition API ile Modern Frontend',
                'slug' => 'vue-3-composition-api-ile-modern-frontend',
                'excerpt' => 'Vue 3 Composition API, Pinia state management ve TypeScript integration best practices.',
                'content' => $this->getPostContent('vue'),
                'category' => 'Vue',
                'author' => 'Christoph Rumpel',
                'views_count' => 1345,
                'read_time' => 11,
            ],
            [
                'title' => 'Docker ile Laravel Development Environment',
                'slug' => 'docker-ile-laravel-development-environment',
                'excerpt' => 'Production-ready Docker setup: multi-stage builds, volume optimization ve CI/CD integration.',
                'content' => $this->getPostContent('docker'),
                'category' => 'DevOps',
                'author' => 'Dan Harrin',
                'views_count' => 2012,
                'read_time' => 16,
            ],
            [
                'title' => 'Laravel Testing ile TDD Approach',
                'slug' => 'laravel-testing-ile-tdd-approach',
                'excerpt' => 'Pest PHP ile test-driven development: Feature tests, Unit tests ve browser testing strategies.',
                'content' => $this->getPostContent('testing'),
                'category' => 'Testing',
                'author' => 'Nuno Maduro',
                'views_count' => 1676,
                'read_time' => 13,
            ],
            [
                'title' => 'Real-time Applications ile Laravel Broadcasting',
                'slug' => 'real-time-applications-ile-laravel-broadcasting',
                'excerpt' => 'WebSockets, Pusher integration ve real-time notifications ile interactive user experiences.',
                'content' => $this->getPostContent('realtime'),
                'category' => 'Laravel',
                'author' => 'Taylor Otwell',
                'views_count' => 1434,
                'read_time' => 9,
            ],
        ];

        foreach ($realPosts as $postData) {
            $category = $categories->firstWhere('name', $postData['category']);
            $user = $users->firstWhere('name', $postData['author']) ?? $users->first();
            
            Post::query()->firstOrCreate(
                ['slug' => $postData['slug']],
                [
                    'title' => $postData['title'],
                    'excerpt' => $postData['excerpt'],
                    'content' => $postData['content'],
                    'user_id' => $user->id,
                    'category_id' => $category?->id ?? $categories->first()->id,
                    'is_published' => true,
                    'is_featured' => $postData['is_featured'] ?? false,
                    'published_at' => now()->subDays(rand(1, 30)),
                    'views_count' => $postData['views_count'],
                    'read_time' => $postData['read_time'],
                    'meta_title' => $postData['title'],
                    'meta_description' => $postData['excerpt'],
                ]
            );
        }

        // Create additional random posts
        Post::factory()->count(30)->create();
    }

    private function getPostContent(string $type): string
    {
        $contents = [
            'api' => '
# Modern Laravel ile API Development

Modern web uygulamalarında API development, uygulamanızın kalbi durumundadır. Laravel 12 ile birlikte gelen yeniliklerle beraber, RESTful API geliştirmek hiç bu kadar kolay olmamıştı.

## JSON:API Standardı

API tasarımında consistency önemlidir. JSON:API standardını kullanarak:

```php
class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "type" => "posts",
            "id" => (string) $this->id,
            "attributes" => [
                "title" => $this->title,
                "content" => $this->content,
                "created-at" => $this->created_at->toISOString(),
            ],
            "relationships" => [
                "author" => [
                    "data" => [
                        "type" => "users",
                        "id" => (string) $this->user_id
                    ]
                ]
            ]
        ];
    }
}
```

## API Versioning

API versioning için Laravel\'ın route group özelliklerini kullanabiliriz:

```php
Route::prefix("api/v1")->group(function () {
    Route::apiResource("posts", PostController::class);
});

Route::prefix("api/v2")->group(function () {
    Route::apiResource("posts", V2\PostController::class);
});
```

## Rate Limiting

API\'nizi korumak için rate limiting eklemeyi unutmayın:

```php
Route::middleware("throttle:api")->group(function () {
    // API routes
});
```

Bu yaklaşımlarla modern, scalable ve maintainable API\'ler geliştirebilirsiniz.',
            'livewire' => '
# Laravel Livewire ile Reactive Components

Livewire 3, server-side reactive programming paradigmasını PHP dünyasına getiriyor. SPA complexity\'si olmadan interactive user interface\'ler oluşturabiliriz.

## Component Architecture

```php
class PostList extends Component
{
    public string $search = "";
    public string $category = "all";
    
    public function render()
    {
        $posts = Post::query()
            ->when($this->search, fn($q) => $q->where("title", "like", "%{$this->search}%"))
            ->when($this->category !== "all", fn($q) => $q->whereHas("category", fn($q) => $q->where("slug", $this->category)))
            ->latest()
            ->paginate(10);
            
        return view("livewire.post-list", compact("posts"));
    }
}
```

## Real-time Updates

```html
<div>
    <input wire:model.live="search" placeholder="Search posts..." />
    
    <select wire:model.live="category">
        <option value="all">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->slug }}">{{ $category->name }}</option>
        @endforeach
    </select>
    
    <div wire:loading class="spinner">Loading...</div>
    
    @foreach($posts as $post)
        <article wire:key="post-{{ $post->id }}">
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->excerpt }}</p>
        </article>
    @endforeach
    
    {{ $posts->links() }}
</div>
```

## Form Handling

```php
class CreatePost extends Component
{
    #[Validate("required|min:3")]
    public string $title = "";
    
    #[Validate("required|min:10")]
    public string $content = "";
    
    public function save()
    {
        $this->validate();
        
        Post::create([
            "title" => $this->title,
            "content" => $this->content,
            "user_id" => auth()->id(),
        ]);
        
        session()->flash("message", "Post created successfully!");
        
        return redirect()->route("posts.index");
    }
}
```

Livewire ile modern, reactive ve performant uygulamalar geliştirebilirsiniz.',
            'tailwind' => '
# Tailwind CSS ile Design System Oluşturma

Design system, consistent ve scalable user interface\'ler oluşturmanın anahtarıdır. Tailwind CSS 4 ile bu süreç çok daha streamlined hale geldi.

## Design Tokens

```css
@theme {
  --color-brand-50: #f0f9ff;
  --color-brand-500: #3b82f6;
  --color-brand-900: #1e3a8a;
  
  --spacing-xs: 0.5rem;
  --spacing-sm: 1rem;
  --spacing-md: 1.5rem;
  --spacing-lg: 2rem;
  
  --font-size-sm: 0.875rem;
  --font-size-base: 1rem;
  --font-size-lg: 1.125rem;
}
```

## Component Patterns

```html
<!-- Button Component -->
<button class="btn btn-primary">
  Click me
</button>

<!-- Card Component -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Title</h3>
  </div>
  <div class="card-content">
    <p>Content goes here</p>
  </div>
</div>
```

```css
@layer components {
  .btn {
    @apply px-4 py-2 rounded-md font-medium transition-colors focus:outline-none focus:ring-2;
  }
  
  .btn-primary {
    @apply bg-brand-500 text-white hover:bg-brand-600 focus:ring-brand-500;
  }
  
  .card {
    @apply bg-white rounded-lg border shadow-sm overflow-hidden;
  }
  
  .card-header {
    @apply px-6 py-4 border-b border-gray-200;
  }
  
  .card-title {
    @apply text-lg font-semibold text-gray-900;
  }
  
  .card-content {
    @apply px-6 py-4;
  }
}
```

## Responsive Design

```html
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  <div class="aspect-video bg-gray-200 rounded-lg"></div>
  <div class="aspect-video bg-gray-200 rounded-lg"></div>
  <div class="aspect-video bg-gray-200 rounded-lg"></div>
</div>
```

## Dark Mode Support

```html
<div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
  <h1 class="text-2xl font-bold">Hello World</h1>
</div>
```

Bu yaklaşımlarla maintainable ve consistent design system\'ler oluşturabilirsiniz.',
            'php' => '
# PHP 8.4 ile Type System ve Performance

PHP 8.4, dilin evolution\'ında önemli bir milestone. Property hooks, asymmetric visibility ve performance improvements ile modern PHP development deneyimi iyileştiriliyor.

## Property Hooks

```php
class User
{
    public string $firstName {
        set(string $value) {
            $this->firstName = trim(ucfirst($value));
        }
    }
    
    public string $email {
        set(string $value) {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                throw new InvalidArgumentException("Invalid email");
            }
            $this->email = strtolower($value);
        }
    }
    
    public string $fullName {
        get => $this->firstName . " " . $this->lastName;
    }
}
```

## Asymmetric Visibility

```php
class BankAccount
{
    public private(set) float $balance = 0;
    
    public function deposit(float $amount): void
    {
        $this->balance += $amount;
    }
    
    public function getBalance(): float
    {
        return $this->balance; // Read-only outside the class
    }
}
```

## Performance Improvements

```php
// Optimized array operations
$result = array_map(
    fn($item) => $item->process(),
    $items
);

// Better memory usage with generators
function processLargeDataset(): Generator
{
    foreach ($this->fetchBatch() as $batch) {
        yield from $this->processBatch($batch);
    }
}
```

## Type System Enhancements

```php
interface Repository
{
    /** @return Collection<int, User> */
    public function findAll(): Collection;
    
    /** @return User|null */
    public function findById(int $id): ?User;
}

class UserRepository implements Repository
{
    public function findAll(): Collection
    {
        return User::all();
    }
    
    public function findById(int $id): ?User
    {
        return User::find($id);
    }
}
```

PHP 8.4 ile modern, type-safe ve performant applications geliştirin.',
            'security' => '
# Laravel Security Best Practices 2025

Güvenlik, modern web application development\'in en kritik aspectlerinden biri. Laravel\'ın built-in security features\'ları ile OWASP Top 10 tehditlerine karşı nasıl korunacağınızı öğrenelim.

## Authentication & Authorization

```php
// Secure password hashing
class User extends Authenticatable
{
    protected $fillable = ["name", "email"];
    
    protected function casts(): array
    {
        return [
            "password" => "hashed",
            "email_verified_at" => "datetime",
        ];
    }
}

// Multi-factor authentication
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required|min:8",
        ]);
        
        if (Auth::attempt($request->only("email", "password"))) {
            $request->session()->regenerate();
            
            // Trigger 2FA if enabled
            if ($user->two_factor_enabled) {
                return $this->requireTwoFactor($user);
            }
            
            return redirect()->intended("/dashboard");
        }
        
        return back()->withErrors([
            "email" => "The provided credentials do not match our records.",
        ]);
    }
}
```

## CSRF Protection

```html
<!-- Forms -->
<form method="POST" action="/posts">
    @csrf
    <input type="text" name="title" required>
    <button type="submit">Create Post</button>
</form>

<!-- AJAX Requests -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")
    }
});
</script>
```

## Input Validation & Sanitization

```php
class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title" => "required|string|max:255|regex:/^[\w\s\-\.]+$/",
            "content" => "required|string|max:10000",
            "category_id" => "required|exists:categories,id",
            "tags" => "array|max:10",
            "tags.*" => "string|max:50",
        ];
    }
    
    protected function prepareForValidation(): void
    {
        $this->merge([
            "title" => strip_tags($this->title),
            "content" => $this->sanitizeContent($this->content),
        ]);
    }
    
    private function sanitizeContent(string $content): string
    {
        return HTMLPurifier::create([
            "HTML.Allowed" => "p,br,strong,em,ul,ol,li,a[href],h2,h3,h4,code,pre",
        ])->purify($content);
    }
}
```

## SQL Injection Prevention

```php
// ✅ Safe - Using Eloquent ORM
$posts = Post::where("category_id", $categoryId)
    ->whereIn("status", ["published", "featured"])
    ->get();

// ✅ Safe - Using Query Builder with bindings
$posts = DB::select(
    "SELECT * FROM posts WHERE category_id = ? AND created_at > ?",
    [$categoryId, $date]
);

// ❌ Dangerous - Raw concatenation
$posts = DB::select("SELECT * FROM posts WHERE category_id = " . $categoryId);
```

## Rate Limiting

```php
// API Rate Limiting
Route::middleware(["throttle:60,1"])->group(function () {
    Route::apiResource("posts", PostController::class);
});

// Login Rate Limiting
Route::middleware(["throttle:5,1"])->group(function () {
    Route::post("/login", [LoginController::class, "login"]);
});
```

Bu security measures ile uygulamanızı modern tehditlere karşı koruyun.',
            'database' => '
# Database Optimization ve N+1 Problem Çözümleri

Database performance, uygulamanızın success\'inin critical factor\'larından biri. Eloquent ORM ile efficient queries yazmayı ve N+1 problemini çözmeyi öğrenelim.

## N+1 Problem Analizi

```php
// ❌ N+1 Problem - Her post için ayrı query
$posts = Post::all();
foreach ($posts as $post) {
    echo $post->user->name; // N+1 query!
    echo $post->category->name; // Another N+1!
}

// ✅ Eager Loading ile çözüm
$posts = Post::with(["user", "category"])->get();
foreach ($posts as $post) {
    echo $post->user->name; // No additional query
    echo $post->category->name; // No additional query
}
```

## Advanced Eager Loading

```php
// Conditional eager loading
$posts = Post::with([
    "user" => function ($query) {
        $query->select(["id", "name", "avatar"]);
    },
    "category:id,name,color",
    "comments" => function ($query) {
        $query->latest()->limit(5);
    },
])->get();

// Nested relationships
$posts = Post::with([
    "comments.user:id,name",
    "comments.replies.user:id,name",
])->get();
```

## Query Optimization

```php
class PostRepository
{
    public function getFeaturedPosts(): Collection
    {
        return Post::select([
            "id", "title", "slug", "excerpt", 
            "featured_image", "published_at", "views_count"
        ])
        ->with([
            "user:id,name,username",
            "category:id,name,color"
        ])
        ->where("is_published", true)
        ->where("is_featured", true)
        ->latest("published_at")
        ->limit(6)
        ->get();
    }
    
    public function searchPosts(string $query): Collection
    {
        return Post::select([
            "id", "title", "slug", "excerpt", "published_at"
        ])
        ->whereRaw("to_tsvector(\'english\', title || \' \' || content) @@ plainto_tsquery(\'english\', ?)", [$query])
        ->orWhere("title", "ILIKE", "%{$query}%")
        ->with("user:id,name")
        ->latest("published_at")
        ->paginate(20);
    }
}
```

## Database Indexing

```php
// Migration ile index ekleme
Schema::table("posts", function (Blueprint $table) {
    $table->index(["is_published", "published_at"]);
    $table->index(["category_id", "is_published"]);
    $table->index("views_count");
    
    // Full-text search index
    DB::statement(
        "CREATE INDEX posts_search_idx ON posts USING gin(to_tsvector(\'english\', title || \' \' || content))"
    );
});
```

## Caching Strategies

```php
class PostService
{
    public function getPopularPosts(): Collection
    {
        return Cache::remember(
            "posts.popular",
            now()->addHours(6),
            fn() => Post::select(["id", "title", "slug", "views_count"])
                ->where("is_published", true)
                ->orderBy("views_count", "desc")
                ->limit(10)
                ->get()
        );
    }
    
    public function incrementViews(Post $post): void
    {
        // Queue için async update
        dispatch(new IncrementPostViewsJob($post->id));
        
        // Cache invalidation
        Cache::forget("posts.popular");
        Cache::forget("post.{$post->slug}");
    }
}
```

## Query Monitoring

```php
// AppServiceProvider.php
public function boot(): void
{
    if (app()->environment("local")) {
        DB::listen(function ($query) {
            if ($query->time > 100) { // 100ms üzeri queries
                logger()->warning("Slow query detected", [
                    "sql" => $query->sql,
                    "bindings" => $query->bindings,
                    "time" => $query->time . "ms",
                ]);
            }
        });
    }
}
```

Bu optimization techniques ile database performance\'ınızı maximize edin.',
            'vue' => '
# Vue 3 Composition API ile Modern Frontend

Vue 3 Composition API, reactive programming ve component composition için powerful bir paradigm sunuyor. TypeScript integration ile birlikte modern, scalable frontend applications geliştirebiliriz.

## Composition API Basics

```javascript
import { ref, computed, onMounted, watch } from "vue";
import { usePosts } from "@/composables/usePosts";

export default {
  name: "PostList",
  setup() {
    const searchQuery = ref("");
    const selectedCategory = ref("all");
    const { posts, loading, error, fetchPosts } = usePosts();
    
    const filteredPosts = computed(() => {
      if (!searchQuery.value) return posts.value;
      
      return posts.value.filter(post => 
        post.title.toLowerCase().includes(searchQuery.value.toLowerCase())
      );
    });
    
    watch([searchQuery, selectedCategory], () => {
      fetchPosts({
        search: searchQuery.value,
        category: selectedCategory.value
      });
    }, { debounce: 300 });
    
    onMounted(() => {
      fetchPosts();
    });
    
    return {
      searchQuery,
      selectedCategory,
      filteredPosts,
      loading,
      error
    };
  }
};
```

## Custom Composables

```javascript
// composables/usePosts.js
import { ref, reactive } from "vue";
import axios from "axios";

export function usePosts() {
  const posts = ref([]);
  const loading = ref(false);
  const error = ref(null);
  
  const pagination = reactive({
    currentPage: 1,
    totalPages: 1,
    totalItems: 0
  });
  
  async function fetchPosts(filters = {}) {
    loading.value = true;
    error.value = null;
    
    try {
      const response = await axios.get("/api/posts", {
        params: {
          page: pagination.currentPage,
          ...filters
        }
      });
      
      posts.value = response.data.data;
      pagination.totalPages = response.data.meta.last_page;
      pagination.totalItems = response.data.meta.total;
    } catch (err) {
      error.value = err.response?.data?.message || "An error occurred";
    } finally {
      loading.value = false;
    }
  }
  
  async function createPost(postData) {
    try {
      const response = await axios.post("/api/posts", postData);
      posts.value.unshift(response.data.data);
      return { success: true, data: response.data.data };
    } catch (err) {
      return { 
        success: false, 
        error: err.response?.data?.errors || "Create failed" 
      };
    }
  }
  
  return {
    posts,
    loading,
    error,
    pagination,
    fetchPosts,
    createPost
  };
}
```

## TypeScript Integration

```typescript
// types/Post.ts
export interface Post {
  id: number;
  title: string;
  slug: string;
  excerpt: string;
  content: string;
  published_at: string;
  user: User;
  category: Category;
  tags: Tag[];
}

export interface User {
  id: number;
  name: string;
  username: string;
  email: string;
}

export interface Category {
  id: number;
  name: string;
  slug: string;
  color: string;
}
```

```typescript
// composables/usePosts.ts
import { ref, reactive, Ref } from "vue";
import type { Post } from "@/types/Post";

interface UsePosts {
  posts: Ref<Post[]>;
  loading: Ref<boolean>;
  error: Ref<string | null>;
  fetchPosts: (filters?: Record<string, any>) => Promise<void>;
  createPost: (postData: Partial<Post>) => Promise<{success: boolean, data?: Post, error?: string}>;
}

export function usePosts(): UsePosts {
  const posts = ref<Post[]>([]);
  const loading = ref<boolean>(false);
  const error = ref<string | null>(null);
  
  // Implementation...
  
  return {
    posts,
    loading,
    error,
    fetchPosts,
    createPost
  };
}
```

## Pinia State Management

```javascript
// stores/posts.js
import { defineStore } from "pinia";
import { usePosts } from "@/composables/usePosts";

export const usePostsStore = defineStore("posts", () => {
  const { posts, loading, error, fetchPosts, createPost } = usePosts();
  
  const favoritePostIds = ref(new Set());
  
  const favoritePosts = computed(() => 
    posts.value.filter(post => favoritePostIds.value.has(post.id))
  );
  
  function toggleFavorite(postId) {
    if (favoritePostIds.value.has(postId)) {
      favoritePostIds.value.delete(postId);
    } else {
      favoritePostIds.value.add(postId);
    }
  }
  
  return {
    posts,
    loading,
    error,
    favoritePosts,
    fetchPosts,
    createPost,
    toggleFavorite
  };
});
```

Vue 3 Composition API ile maintainable ve scalable applications geliştirin.',
            'docker' => '
# Docker ile Laravel Development Environment

Modern Laravel development için production-ready Docker setup oluşturmak, consistent development environment ve smooth deployment process sağlar.

## Multi-stage Dockerfile

```dockerfile
# Base PHP image
FROM php:8.4-fpm-alpine AS base

RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    libzip-dev \
    postgresql-dev

RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Composer installation
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Development stage
FROM base AS development

RUN apk add --no-cache nodejs npm

# Install Xdebug for development
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY ./docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Production stage
FROM base AS production

# Copy application files
COPY . /var/www
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

EXPOSE 9000

CMD ["php-fpm"]
```

## Docker Compose Setup

```yaml
# docker-compose.yml
version: "3.8"

services:
  app:
    build:
      context: .
      target: development
      dockerfile: Dockerfile
    container_name: laravel-app
    volumes:
      - .:/var/www
      - /var/www/vendor
      - /var/www/node_modules
    environment:
      - PHP_IDE_CONFIG=serverName=laravel
    depends_on:
      - database
      - redis
    networks:
      - laravel-network

  nginx:
    image: nginx:alpine
    container_name: laravel-nginx
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - .:/var/www
      - ./docker/nginx/nginx.conf:/etc/nginx/nginx.conf
      - ./docker/nginx/sites/:/etc/nginx/sites-available/
      - ./docker/nginx/ssl/:/etc/ssl/certs/
    depends_on:
      - app
    networks:
      - laravel-network

  database:
    image: postgres:16-alpine
    container_name: laravel-db
    environment:
      POSTGRES_DB: laravel
      POSTGRES_USER: laravel
      POSTGRES_PASSWORD: secret
    volumes:
      - db-data:/var/lib/postgresql/data
      - ./docker/postgres/init.sql:/docker-entrypoint-initdb.d/init.sql
    ports:
      - "5432:5432"
    networks:
      - laravel-network

  redis:
    image: redis:7-alpine
    container_name: laravel-redis
    command: redis-server --requirepass secret
    volumes:
      - redis-data:/data
    ports:
      - "6379:6379"
    networks:
      - laravel-network

  queue:
    build:
      context: .
      target: development
      dockerfile: Dockerfile
    container_name: laravel-queue
    command: php artisan queue:work --tries=3 --backoff=3
    volumes:
      - .:/var/www
    environment:
      - CONTAINER_ROLE=queue
    depends_on:
      - database
      - redis
    networks:
      - laravel-network

  scheduler:
    build:
      context: .
      target: development
      dockerfile: Dockerfile
    container_name: laravel-scheduler
    command: crond -f
    volumes:
      - .:/var/www
      - ./docker/scheduler/crontab:/etc/crontabs/root
    depends_on:
      - database
    networks:
      - laravel-network

volumes:
  db-data:
  redis-data:

networks:
  laravel-network:
    driver: bridge
```

## Nginx Configuration

```nginx
# docker/nginx/sites/default.conf
server {
    listen 80;
    server_name blog.test;
    root /var/www/public;
    index index.php;

    client_max_body_size 100M;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass app:9000;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
        
        # Security headers
        add_header X-Frame-Options "SAMEORIGIN" always;
        add_header X-Content-Type-Options "nosniff" always;
        add_header X-XSS-Protection "1; mode=block" always;
    }

    location ~ /\.ht {
        deny all;
    }

    # Asset caching
    location ~* \.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        access_log off;
    }
}
```

## Development Scripts

```bash
#!/bin/bash
# scripts/dev-setup.sh

set -e

echo "🚀 Setting up Laravel development environment..."

# Copy environment file
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✅ Environment file created"
fi

# Start containers
docker-compose up -d --build

# Wait for database
echo "⏳ Waiting for database..."
sleep 10

# Install dependencies
docker-compose exec app composer install

# Generate key
docker-compose exec app php artisan key:generate

# Run migrations and seeds
docker-compose exec app php artisan migrate:fresh --seed

# Install npm dependencies
docker-compose exec app npm install

# Build assets
docker-compose exec app npm run build

echo "🎉 Development environment ready!"
echo "🌐 Visit: http://blog.test"
echo "📊 Database: localhost:5432"
echo "🔴 Redis: localhost:6379"
```

## Production Deployment

```yaml
# docker-compose.prod.yml
version: "3.8"

services:
  app:
    build:
      context: .
      target: production
    environment:
      - APP_ENV=production
      - APP_DEBUG=false
    volumes:
      - storage-data:/var/www/storage
    deploy:
      replicas: 3
      resources:
        limits:
          memory: 512M
        reservations:
          memory: 256M

  nginx:
    image: nginx:alpine
    volumes:
      - ./docker/nginx/prod.conf:/etc/nginx/nginx.conf
      - storage-data:/var/www/storage
    deploy:
      replicas: 2

volumes:
  storage-data:
```

Bu Docker setup ile consistent, scalable development environment oluşturun.',
            'testing' => '
# Laravel Testing ile TDD Approach

Test-driven development (TDD), maintainable ve reliable code yazmanın en effective yöntemlerinden biri. Pest PHP ile modern testing practices öğrenelim.

## Feature Tests

```php
<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;

test("users can view published posts", function () {
    $category = Category::factory()->create();
    $posts = Post::factory(3)->published()->create([
        "category_id" => $category->id
    ]);
    
    $response = $this->get("/posts");
    
    $response->assertOk();
    $response->assertViewHas("posts");
    
    $posts->each(function ($post) use ($response) {
        $response->assertSee($post->title);
        $response->assertSee($post->excerpt);
    });
});

test("users cannot view unpublished posts", function () {
    $unpublishedPost = Post::factory()->create([
        "is_published" => false
    ]);
    
    $response = $this->get("/posts/{$unpublishedPost->slug}");
    
    $response->assertNotFound();
});

test("authenticated users can create posts", function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    
    $postData = [
        "title" => "Test Post Title",
        "content" => "This is test content for the post.",
        "category_id" => $category->id,
    ];
    
    $response = $this->actingAs($user)
        ->post("/posts", $postData);
    
    $response->assertRedirect();
    $response->assertSessionHas("success");
    
    $this->assertDatabaseHas("posts", [
        "title" => "Test Post Title",
        "user_id" => $user->id,
    ]);
});
```

## Unit Tests

```php
<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;

describe("Post model", function () {
    it("generates correct slug from title", function () {
        $post = Post::factory()->make([
            "title" => "This is a Test Post Title!"
        ]);
        
        expect($post->slug)->toBe("this-is-a-test-post-title");
    });
    
    it("calculates read time correctly", function () {
        $content = str_repeat("word ", 250); // ~250 words
        $post = Post::factory()->make(["content" => $content]);
        
        expect($post->read_time)->toBe(1); // 1 minute for 250 words
    });
    
    it("belongs to a user", function () {
        $user = User::factory()->create();
        $post = Post::factory()->create(["user_id" => $user->id]);
        
        expect($post->user)->toBeInstanceOf(User::class);
        expect($post->user->id)->toBe($user->id);
    });
    
    it("belongs to a category", function () {
        $category = Category::factory()->create();
        $post = Post::factory()->create(["category_id" => $category->id]);
        
        expect($post->category)->toBeInstanceOf(Category::class);
        expect($post->category->id)->toBe($category->id);
    });
});

describe("Post scopes", function () {
    it("filters published posts correctly", function () {
        Post::factory(5)->published()->create();
        Post::factory(3)->create(["is_published" => false]);
        
        $publishedCount = Post::published()->count();
        
        expect($publishedCount)->toBe(5);
    });
    
    it("filters featured posts correctly", function () {
        Post::factory(2)->featured()->create();
        Post::factory(5)->create(["is_featured" => false]);
        
        $featuredCount = Post::featured()->count();
        
        expect($featuredCount)->toBe(2);
    });
});
```

## API Testing

```php
<?php

use App\Models\Post;
use App\Models\User;

describe("Posts API", function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
    });
    
    it("returns paginated posts", function () {
        Post::factory(25)->published()->create();
        
        $response = $this->getJson("/api/posts");
        
        $response->assertOk()
            ->assertJsonStructure([
                "data" => [
                    "*" => ["id", "title", "slug", "excerpt", "published_at"]
                ],
                "meta" => ["current_page", "total", "per_page"]
            ]);
            
        expect($response->json("data"))->toHaveCount(20); // Default pagination
        expect($response->json("meta.total"))->toBe(25);
    });
    
    it("creates post with valid data", function () {
        $postData = [
            "title" => "API Test Post",
            "content" => "This is content for API test.",
            "category_id" => Category::factory()->create()->id,
        ];
        
        $response = $this->actingAs($this->user, "sanctum")
            ->postJson("/api/posts", $postData);
        
        $response->assertCreated()
            ->assertJsonFragment([
                "title" => "API Test Post",
                "slug" => "api-test-post",
            ]);
    });
    
    it("validates required fields", function () {
        $response = $this->actingAs($this->user, "sanctum")
            ->postJson("/api/posts", []);
        
        $response->assertUnprocessable()
            ->assertJsonValidationErrors(["title", "content"]);
    });
});
```

## Database Testing

```php
<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe("Database operations", function () {
    it("can seed test data", function () {
        $this->seed([
            CategorySeeder::class,
            UserSeeder::class,
        ]);
        
        expect(Category::count())->toBeGreaterThan(0);
        expect(User::count())->toBeGreaterThan(0);
    });
    
    it("maintains referential integrity", function () {
        $user = User::factory()->create();
        $posts = Post::factory(5)->create(["user_id" => $user->id]);
        
        // When user is deleted, posts should also be deleted (cascade)
        $user->delete();
        
        expect(Post::count())->toBe(0);
    });
});
```

## Test Utilities

```php
<?php

// tests/Pest.php
uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in("Feature");

uses(Tests\TestCase::class)->in("Unit");

function actingAsAdmin(): TestCase
{
    return test()->actingAs(
        User::factory()->create(["type" => 1])
    );
}

function createPostWithCategory(): array
{
    $category = Category::factory()->create();
    $post = Post::factory()->create(["category_id" => $category->id]);
    
    return compact("post", "category");
}
```

TDD ile reliable, maintainable applications geliştirin.',
            'realtime' => '
# Real-time Applications ile Laravel Broadcasting

Modern web applications, real-time interactions için WebSocket connections ve broadcasting systems kullanır. Laravel Broadcasting ile interactive user experiences oluşturalım.

## Broadcasting Setup

```php
// config/broadcasting.php
"pusher" => [
    "driver" => "pusher",
    "key" => env("PUSHER_APP_KEY"),
    "secret" => env("PUSHER_APP_SECRET"),
    "app_id" => env("PUSHER_APP_ID"),
    "options" => [
        "cluster" => env("PUSHER_APP_CLUSTER"),
        "useTLS" => true,
        "host" => env("PUSHER_HOST") ?: "api-".env("PUSHER_APP_CLUSTER", "mt1").".pusherapp.com",
        "port" => env("PUSHER_PORT", 443),
        "scheme" => env("PUSHER_SCHEME", "https"),
    ],
],

// .env
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-app-key
PUSHER_APP_SECRET=your-app-secret
PUSHER_APP_CLUSTER=your-cluster
```

## Real-time Notifications

```php
<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewPostPublished extends Notification implements ShouldBroadcast
{
    use Queueable;
    
    public function __construct(public Post $post) {}
    
    public function via($notifiable): array
    {
        return ["broadcast", "database"];
    }
    
    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            "id" => $this->id,
            "type" => "new_post",
            "title" => "New post published!",
            "message" => "{$this->post->user->name} published: {$this->post->title}",
            "post" => [
                "id" => $this->post->id,
                "title" => $this->post->title,
                "slug" => $this->post->slug,
                "author" => $this->post->user->name,
            ],
            "created_at" => now()->toISOString(),
        ]);
    }
    
    public function broadcastOn(): array
    {
        return [
            "users.{$this->notifiable->id}",
            "posts.new",
        ];
    }
}
```

## Broadcasting Events

```php
<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostViewsUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public function __construct(
        public Post $post,
        public int $previousViews,
        public int $currentViews
    ) {}
    
    public function broadcastOn(): array
    {
        return [
            new Channel("posts.{$this->post->id}"),
            new Channel("posts.popular"),
        ];
    }
    
    public function broadcastWith(): array
    {
        return [
            "post_id" => $this->post->id,
            "views_count" => $this->currentViews,
            "views_increment" => $this->currentViews - $this->previousViews,
        ];
    }
    
    public function broadcastAs(): string
    {
        return "post.views.updated";
    }
}

class CommentAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public function __construct(
        public Post $post,
        public Comment $comment
    ) {}
    
    public function broadcastOn(): array
    {
        return [
            new Channel("posts.{$this->post->id}.comments"),
        ];
    }
    
    public function broadcastWith(): array
    {
        return [
            "comment" => [
                "id" => $this->comment->id,
                "content" => $this->comment->content,
                "user" => [
                    "name" => $this->comment->user->name,
                    "username" => $this->comment->user->username,
                ],
                "created_at" => $this->comment->created_at->toISOString(),
            ],
        ];
    }
}
```

## Frontend Integration

```javascript
// resources/js/echo.js
import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
    enabledTransports: ["ws", "wss"],
});

// Real-time post views
window.Echo.channel(`posts.${postId}`)
    .listen(".post.views.updated", (e) => {
        document.querySelector(".views-count").textContent = e.views_count;
        
        // Animate view count update
        const viewsElement = document.querySelector(".views-count");
        viewsElement.classList.add("animate-pulse");
        setTimeout(() => viewsElement.classList.remove("animate-pulse"), 1000);
    });

// Real-time comments
window.Echo.channel(`posts.${postId}.comments`)
    .listen("CommentAdded", (e) => {
        const commentsContainer = document.querySelector(".comments-list");
        const commentHtml = `
            <div class="comment animate-fade-in">
                <div class="comment-header">
                    <strong>${e.comment.user.name}</strong>
                    <span class="text-gray-500 text-sm">
                        @${e.comment.user.username} · just now
                    </span>
                </div>
                <div class="comment-content">
                    ${e.comment.content}
                </div>
            </div>
        `;
        
        commentsContainer.insertAdjacentHTML("afterbegin", commentHtml);
        
        // Show notification
        showNotification("New comment added!", "success");
    });
```

## Presence Channels

```php
// routes/channels.php
Broadcast::channel("post.{postId}", function ($user, $postId) {
    return [
        "id" => $user->id,
        "name" => $user->name,
        "username" => $user->username,
    ];
});

Broadcast::channel("chat.{roomId}", function ($user, $roomId) {
    if ($user->canAccessChatRoom($roomId)) {
        return [
            "id" => $user->id,
            "name" => $user->name,
            "avatar" => $user->avatar_url,
            "status" => "online",
        ];
    }
});
```

```javascript
// Presence channel example
window.Echo.join(`post.${postId}`)
    .here((users) => {
        console.log("Users currently viewing this post:", users);
        updateActiveUsersCount(users.length);
        displayActiveUsers(users);
    })
    .joining((user) => {
        console.log(`${user.name} is now viewing this post`);
        addUserToActiveList(user);
        showNotification(`${user.name} joined`, "info");
    })
    .leaving((user) => {
        console.log(`${user.name} stopped viewing this post`);
        removeUserFromActiveList(user);
    });

function updateActiveUsersCount(count) {
    document.querySelector(".active-users-count").textContent = count;
}

function displayActiveUsers(users) {
    const container = document.querySelector(".active-users");
    container.innerHTML = users.map(user => `
        <div class="flex items-center space-x-2 p-2 bg-green-50 rounded">
            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
            <span class="text-sm">${user.name}</span>
        </div>
    `).join("");
}
```

## Queue Integration

```php
// Job for async broadcasting
class UpdatePostViewsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public function __construct(
        public int $postId,
        public string $userAgent,
        public string $ipAddress
    ) {}
    
    public function handle(): void
    {
        $post = Post::find($this->postId);
        $previousViews = $post->views_count;
        
        // Increment views (with duplicate detection)
        $post->increment("views_count");
        
        // Broadcast the update
        event(new PostViewsUpdated($post, $previousViews, $post->views_count));
        
        // Update popular posts cache
        Cache::forget("posts.popular");
    }
}
```

Real-time features ile engaging user experiences oluşturun.',
        ];
        
        return $contents[$type] ?? "# {$type}\n\nThis is sample content for {$type} category.";
    }
}
