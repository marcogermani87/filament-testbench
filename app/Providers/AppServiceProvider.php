<?php

namespace App\Providers;

use App\Filament\Pages\RemoteApiPage;
use App\Filament\Resources\Blogs\Pages\ListBlogs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentView;
use Filament\Tables\View\TablesRenderHook;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $isProduction = app()->isProduction();

        Model::unguard();

        Model::preventLazyLoading(!$isProduction);

        FilamentView::registerRenderHook(
            TablesRenderHook::TOOLBAR_START,
            fn(): string => Blade::render(
                '<x-filament::loading-indicator wire:loading wire:target="previousPage,gotoPage,nextPage" class="h-5 w-5" />'
            ),
            scopes: [
                ListBlogs::class,
                RemoteApiPage::class,
            ]
        );
    }
}
