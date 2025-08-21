<laravel-boost-guidelines>

# Laravel Boost Guidelines

These rules provide clear, actionable standards tailored to this application’s Laravel ecosystem. The goal is **production-grade**, **consistent**, and **test-verified** work.

---

## Foundational Context

Target these versions and validate examples against them:

- PHP — **8.4.11**
- Laravel (framework) — **v12**
- Livewire — **v3** (Volt where suitable)
- Filament — **v4**
- Pest — **v3**
- Laravel Pint — **v1**
- Laravel Prompts — **v0**
- Tailwind CSS — **v4**

> **Global Rule (Important):** The frontend is **Livewire-only**. **Do not author Alpine.js or other custom JS.** (Filament/Livewire may load Alpine internally; you must **not** write custom Alpine code.)

---

## Conventions

- Follow existing project **conventions**. When adding files/components, mirror sibling naming, structure, and approach.
- Use **meaningful names**: `isRegisteredForDiscounts` ✅, `discount()` ❌.
- Prefer **reusing existing components/helpers** before writing new ones.
- Adhere to **Laravel 12** structure and conventions.
- The app runs via **Laravel Herd** and is **always live** at **https://blog.test**. You don’t need to start a server for local dev.
- **Tests are required**: Dusk (browser), Feature, and Unit tests.
- **No fabricated results**: rely only on **verifiable truths**.

---

## Verification Scripts

- If functionality is covered by tests, do **not** add separate verification or tinker scripts. **Tests take precedence.**

---

## Application Structure & Architecture

- Keep the **existing directory structure**; do not add new top-level folders without approval.
- Do not change dependencies without approval.

---

## Frontend Bundling

- If changes are not visible, remind the user to run `npm run build`, `npm run dev`, or `composer run dev`.

---

## Replies

- Keep explanations **short and focused** on what matters.

---

## Documentation Files

- Create documentation files **only when explicitly requested**.

---

# Boost Rules

Laravel Boost is an **MCP server** with project-specific tools. **Use them.**

## Artisan

- Use `list-artisan-commands` to confirm parameters before running Artisan commands.

## URLs

- When sharing project URLs, **always** use `get-absolute-url` (ensures correct scheme, domain/IP, and port).

## Tinker / Debugging

- Use **`tinker`** to execute PHP or inspect Eloquent directly.
- Use **`database-query`** when you only need to read from the DB.

## Browser Logs

- Use `browser-logs` to read recent browser logs/errors. Ignore **stale** logs.

## Docs Search (Critical)

- **Always start** with `search-docs`. It sends installed package versions and returns **version-specific** docs.
- Search docs **before** code changes to confirm the approach.
- Begin with broad, topic-based queries: `['rate limiting', 'routing', 'pagination']`.
- **Do not** include package names in queries (package versions are already sent).
- You can pass **multiple** queries at once.

**Query examples**
1. Simple: `authentication` (matches stems)
2. AND terms: `rate limit`
3. Exact phrase: `"infinite scroll"`
4. Mixed: `middleware "rate limit"`
5. Multiple queries: `["authentication", "middleware"]`

---

# PHP Rules

- Always use **curly braces** for control structures.

## Constructors

- Use PHP 8 **constructor property promotion**; don’t leave an empty `__construct()`.

```php
public function __construct(public GitHub $github) {}
```

## Type Declarations

- All functions/methods must declare **explicit return types** and proper parameter types.

```php
protected function isAccessible(User $user, ?string $path = null): bool
{
    // ...
}
```

## Comments & PHPDoc

- Prefer **PHPDoc** over inline comments; reserve inline remarks for truly complex logic.
- Add **array shape** type info where helpful.

## Enums

- Enum keys typically use **TitleCase** (e.g., `FavoritePerson`, `Monthly`).

---

# Laravel Herd

- The app is served by Laravel Herd at `https?://[kebab-case-project-dir].test`.
- Do **not** run commands to expose HTTP(s); it’s already available.
- When presenting URLs, use **`get-absolute-url`**.

---

# Filament (Core)

- This project uses Filament; follow existing **project conventions**.
- Filament is **Livewire-based** SDUI for Laravel.
- Use **`search-docs`** for official Filament docs when needed.
- Prefer static **`::make()`** for consistent component construction.
- **Do not** manually add Alpine; **do not** write custom Alpine code. Interactivity must be via **Livewire/Filament**.

## Filament Artisan

- Generate pages/resources/widgets with Filament Artisan commands. Inspect options and pass **`--no-interaction`**.

## Core Features (Brief)

- **Panels, Resources, Forms, Tables, Actions, Infolists, Widgets, Notifications**.
- Use `relationship()` where appropriate:

```php
Forms\Components\Select::make('user_id')
    ->label('Author')
    ->relationship('author')
    ->required();
```

## Testing Filament

- Authenticate where needed.
- Use Livewire testing helpers:

```php
livewire(ListUsers::class)
    ->assertCanSeeTableRecords($users)
    ->searchTable($users->first()->name)
    ->assertCanSeeTableRecords($users->take(1));
```

```php
livewire(CreateUser::class)
    ->fillForm(['name' => 'Howdy', 'email' => 'howdy@example.com'])
    ->call('create')
    ->assertNotified()
    ->assertRedirect();

assertDatabaseHas(User::class, [
    'name' => 'Howdy',
    'email' => 'howdy@example.com',
]);
```

```php
use Filament\Facades\Filament;
Filament::setCurrentPanel('app');
```

```php
livewire(EditInvoice::class, ['invoice' => $invoice])
    ->callAction('send');

expect($invoice->refresh())->isSent()->toBeTrue();
```

---

# Filament v4 Notes

- Default file visibility is **`private`**.
- v3’s `deferFilters` is **default** in v4; to disable: `deferFilters(false)`.
- `Grid`, `Section`, `Fieldset` no longer span all columns by default.
- Table pagination method `all` is not available by default.
- All action classes extend `Filament\Actions\Action`.
- **Form & Infolist** layout components live under `Filament\Schemas\Components\*`.
- New **`Repeater`** form component.
- Icons default to **`Filament\Support\Icons\Heroicon`**.
- Suggested organization:
    - `Schemas/Components/`, `Tables/Columns/`, `Tables/Filters/`, `Actions/`.

---

# Laravel Core (General)

- Use `php artisan make:*` to create files. Include **`--no-interaction`** and proper options.
- Prefer **Eloquent relationships** over raw queries; use the query builder only for complex cases.
- Avoid `DB::` where Eloquent suffices; prevent N+1 via **eager loading**.
- Use **named routes** and `route()` for URL generation.
- Use `env()` **only in config** files; in code use `config('app.name')`.
- Use **queued jobs** (`ShouldQueue`) for long-running work.
- For APIs, prefer **Eloquent API Resources** and versioning (unless the app’s convention differs).
- Vite error “Unable to locate file in Vite manifest”: run `npm run build`, or ask to run `npm run dev` / `composer run dev`.

---

# Laravel v12 Notes

- Use **`search-docs`** for version-specific docs.
- **Streamlined structure**:
    - No custom middleware files under `app/Http/Middleware/` (register in `bootstrap/app.php`).
    - `bootstrap/app.php`: register middleware, exceptions, and route files.
    - `bootstrap/providers.php`: application-specific service providers.
    - **No `app\Console\Kernel.php`** — use `bootstrap/app.php` or `routes/console.php`.
    - **Commands auto-register** from `app/Console/Commands/`.
- **Migrations**: when altering a column, re-specify **all prior attributes** or they’ll be dropped.
- Laravel 11+ supports limited eager loads natively, e.g. `$query->latest()->limit(10);`.
- Prefer model `casts()` method over `$casts` property if that’s the project convention.

---

# Livewire (Core)

- Generate components via `php artisan make:livewire Posts/CreatePost`.
- State lives **on the server**; the UI reflects it.
- Livewire requests are **HTTP-like**: validate input and run authorization in actions.
- Components require a **single root element**.
- Use `wire:loading` and `wire:dirty` for UX.
- Add `wire:key` inside loops.
- Lifecycle hooks:

```php
public function mount(User $user) { $this->user = $user; }
public function updatedSearch() { $this->resetPage(); }
```

## Livewire v3 Changes

- Real-time binding uses `wire:model.live` (plain `wire:model` is **deferred**).
- Namespace: `App\Livewire\*`.
- Events: use `$this->dispatch()` (instead of `emit` / `dispatchBrowserEvent`).
- Typical layout path: `components.layouts.app`.
- New directives: `wire:show`, `wire:transition`, `wire:cloak`, `wire:offline`, `wire:target`.
- Alpine plugins ship with Livewire; **do not** manually include Alpine or write custom Alpine code.

### Test Example

```php
Livewire::test(Counter::class)
    ->assertSet('count', 0)
    ->call('increment')
    ->assertSet('count', 1)
    ->assertSee(1)
    ->assertStatus(200);

$this->get('/posts/create')->assertSeeLivewire(CreatePost::class);
```

---

# Laravel Pint

- Before finalizing changes, run **`vendor/bin/pint --dirty`**.
- Prefer running **`vendor/bin/pint`** to apply fixes (don’t rely on `--test`).

---

# Pest

- If you need to verify behavior, write/update **Unit/Feature** tests.
- All tests use **Pest**: `php artisan make:test --pest <Name>`.
- Do **not** remove tests; they are core assets.
- Test **happy**, **failure**, and **edge** paths.
- Test locations: `tests/Feature`, `tests/Unit`.

### Running

- Start with minimal scopes, then broaden as needed.
- All: `php artisan test`
- Single file: `php artisan test tests/Feature/ExampleTest.php`
- By name: `php artisan test --filter=TestName`

### Assertions

```php
it('returns all', function () {
    $response = $this->postJson('/api/docs', []);
    $response->assertSuccessful();
});
```

### Mocking & Datasets

- Use `use function Pest\Laravel\mock;` or `$this->mock()` as per project style.
- Prefer **datasets** for repetitive validation cases:

```php
it('has emails', function (string $email) {
    expect($email)->not->toBeEmpty();
})->with([
    'james' => 'james@laravel.com',
    'taylor' => 'taylor@laravel.com',
]);
```

---

# Tailwind CSS (Core)

- Style with Tailwind per project conventions; extract repeated patterns into components.
- Use **gap** utilities (not margins) for list/grid spacing.
- Preserve dark mode using `dark:` where applicable.

## Tailwind v4

- Use **v4** only; do not use removed utilities.
- `corePlugins` is not supported.
- Import difference:

```diff
- @tailwind base;
- @tailwind components;
- @tailwind utilities;
+ @import "tailwindcss";
```

### Deprecated → Replacement

| Deprecated              | Replacement            |
|------------------------|------------------------|
| bg-opacity-*           | bg-black/*             |
| text-opacity-*         | text-black/*           |
| border-opacity-*       | border-black/*         |
| divide-opacity-*       | divide-black/*         |
| ring-opacity-*         | ring-black/*           |
| placeholder-opacity-*  | placeholder-black/*    |
| flex-shrink-*          | shrink-*               |
| flex-grow-*            | grow-*                 |
| overflow-ellipsis      | text-ellipsis          |
| decoration-slice       | box-decoration-slice   |
| decoration-clone       | box-decoration-clone   |

---

# Livewire-Only Frontend (Re-stated)

- **Do not** write custom Alpine.js and **do not** include it manually.
- All interactivity/reactivity must be via **Livewire** (and Filament as applicable).

</laravel-boost-guidelines>

<n8n-guidelines>

# n8n Guidelines

Use n8n-MCP tools to design **accurate** and **efficient** workflows. Principles: **validate early**, **minimize custom code**, **validate often**.

## Core Workflow Process

1. **At the start of every new conversation**: call `tools_documentation()` to learn available tools and best practices.
2. **Discovery**:
    - Clarify the need; ask brief follow-ups if something is unclear.
    - Use `search_nodes({query})`, `list_nodes({category:'trigger'})`, `list_ai_tools()`.
3. **Configuration**:
    - Start with `get_node_essentials(nodeType)` (10–20 key props).
    - Use `search_node_properties(nodeType, 'auth')`, `get_node_for_task('send_email')`, `get_node_documentation(nodeType)`.
    - It’s good practice to show a **visual architecture** of the workflow and get user feedback before building.
4. **Pre-Validation**:
    - `validate_node_minimal(nodeType, config)`
    - `validate_node_operation(nodeType, config, profile)`
    - Fix errors **before** proceeding.
5. **Building**:
    - Assemble nodes with validated configs.
    - Add error handling.
    - Use expressions like `$json`, `$node["NodeName"].json`.
    - Produce the workflow as an **artifact** unless the user asked to create it in a live n8n instance.
6. **Workflow Validation**:
    - `validate_workflow(workflow)`
    - `validate_workflow_connections(workflow)`
    - `validate_workflow_expressions(workflow)`
    - Fix all issues.
7. **Deployment** (when n8n API is configured):
    - `n8n_create_workflow(workflow)`
    - `n8n_validate_workflow({id})`
    - `n8n_update_partial_workflow()` (diff-based)
    - `n8n_trigger_webhook_workflow()`

## Key Insights

- **Use the Code node only when necessary**; prefer standard nodes first.
- **Validate early and often**.
- **Use diff updates** for 80–90% token savings.
- **Any node can be an AI tool** (not only those flagged as usableAsTool).
- Always pre-validate configurations and post-validate the full workflow.

## Validation Strategy

**Before building**
1. `validate_node_minimal`
2. `validate_node_operation`

**After building**
1. `validate_workflow`
2. `validate_workflow_connections`
3. `validate_workflow_expressions`

**After deployment**
1. `n8n_validate_workflow({id})`
2. `n8n_list_executions()`
3. `n8n_update_partial_workflow()` (diffs)

## Response Structure

1. Discovery
2. Pre-Validation
3. Configuration (show only **validated**, working configs)
4. Building
5. Workflow Validation
6. Deployment
7. Post-Validation

## Example (Summary)

- `search_nodes({query:'slack'})`
- `get_node_essentials('n8n-nodes-base.slack')`
- `validate_node_minimal('n8n-nodes-base.slack', {resource:'message', operation:'send'})`
- `validate_node_operation('n8n-nodes-base.slack', fullConfig, 'runtime')`
- Build workflow JSON → run `validate_*` → (if configured) `n8n_create_workflow` + `n8n_validate_workflow`.

## Important Rules

- **Validate before and after** building.
- **Never** deploy an unvalidated workflow.
- Use **diff** operations for updates.
- Report validation results clearly and **fix** errors.

</n8n-guidelines>

- You can use gh tool. Commit often