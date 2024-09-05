<?php

namespace App\Providers;

use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Tables\Actions\CreateAction as TableCreateAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        Model::unguard();

        EditAction::configureUsing(function ($action) {
            return $action->slideOver();
        });
        CreateAction::configureUsing(function ($action) {
            return $action->slideOver();
        });

        Table::configureUsing(function (Table $table) {
            $table->emptyStateActions([
                TableCreateAction::make()
                    ->slideOver()
            ]);
        });
    }
}
