<?php

namespace App\Livewire;

use App\Traits\CachesData;
use App\Traits\HandlesSEO;
use Livewire\Component;

abstract class BaseComponent extends Component
{
    use CachesData, HandlesSEO;

    /**
     * Default page title
     */
    protected string $defaultTitle = 'phpuzem - Modern PHP & Laravel Development';

    /**
     * Default page description
     */
    protected string $defaultDescription = 'Learn modern PHP & Laravel development with practical screencasts and tutorials.';

    /**
     * Boot method called when component is instantiated
     */
    public function boot(): void
    {
        // Override in child classes if needed
    }

    /**
     * Resolve dependency from container
     */
    protected function resolve(string $abstract): mixed
    {
        return app($abstract);
    }

    /**
     * Get repository instance
     */
    protected function repository(string $repositoryClass): mixed
    {
        return $this->resolve($repositoryClass);
    }

    /**
     * Get service instance
     */
    protected function service(string $serviceClass): mixed
    {
        return $this->resolve($serviceClass);
    }

    /**
     * Mount method called when component is mounted
     */
    public function mount(): void
    {
        // Override in child classes if needed
    }

    /**
     * Get the component's cache key prefix
     */
    protected function getComponentCachePrefix(): string
    {
        return strtolower(class_basename(static::class));
    }

    /**
     * Override getCacheKey to use component prefix
     */
    protected function getCacheKey(string $suffix): string
    {
        return $this->getComponentCachePrefix().'.'.$suffix;
    }

    /**
     * Clear component's cache
     */
    public function clearComponentCache(): void
    {
        $pattern = $this->getComponentCachePrefix().'.*';
        $this->forgetCacheByPattern($pattern);
    }

    /**
     * Set flash message
     */
    protected function flashMessage(string $message, string $type = 'success'): void
    {
        session()->flash('flash.message', $message);
        session()->flash('flash.type', $type);
    }

    /**
     * Set success message
     */
    protected function flashSuccess(string $message): void
    {
        $this->flashMessage($message, 'success');
    }

    /**
     * Set error message
     */
    protected function flashError(string $message): void
    {
        $this->flashMessage($message, 'error');
    }

    /**
     * Set warning message
     */
    protected function flashWarning(string $message): void
    {
        $this->flashMessage($message, 'warning');
    }

    /**
     * Set info message
     */
    protected function flashInfo(string $message): void
    {
        $this->flashMessage($message, 'info');
    }

    /**
     * Redirect with success message
     */
    protected function redirectWithSuccess(string $route, string $message): void
    {
        $this->flashSuccess($message);
        $this->redirect($route);
    }

    /**
     * Redirect with error message
     */
    protected function redirectWithError(string $route, string $message): void
    {
        $this->flashError($message);
        $this->redirect($route);
    }

    /**
     * Validate data with common rules
     */
    protected function validateData(array $data, array $rules, array $messages = []): array
    {
        return validator($data, $rules, $messages)->validate();
    }

    /**
     * Handle exceptions in component methods
     */
    protected function handleException(\Exception $e, string $fallbackMessage = 'An error occurred'): void
    {
        logger('Component exception', [
            'component' => static::class,
            'exception' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        $this->flashError($fallbackMessage);
    }

    /**
     * Dispatch browser event
     */
    protected function dispatchBrowserEvent(string $event, array $data = []): void
    {
        $this->dispatch($event, $data);
    }

    /**
     * Get authenticated user
     */
    protected function getAuthUser(): ?\App\Models\User
    {
        return auth()->user();
    }

    /**
     * Check if user is authenticated
     */
    protected function isAuthenticated(): bool
    {
        return auth()->check();
    }

    /**
     * Check if user is guest
     */
    protected function isGuest(): bool
    {
        return auth()->guest();
    }

    /**
     * Authorize action
     */
    protected function authorizeAction(string $ability, $arguments = []): void
    {
        if (! $this->isAuthenticated()) {
            $this->flashError('You must be logged in to perform this action.');
            $this->redirect('/login');

            return;
        }

        $this->authorize($ability, $arguments);
    }
}
