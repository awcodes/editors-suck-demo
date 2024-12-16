<?php

namespace App\Providers;

use Awcodes\Typist\Facades\Typist;
use Awcodes\Typist\Support\ToolbarGroup;
use Awcodes\Typist\TypistEditor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Typist::registerActionPath(
            in: app_path('Typist/Actions'),
            for: 'App\\Typist\\Actions',
        );

        TypistEditor::configureUsing(function (TypistEditor $component) {
            $component
                ->mergeTags([
                    'name', 'email', 'phone'
                ])
                ->toolbar([
                    ToolbarGroup::make([
                        \App\Typist\Actions\Alert::make('Alert'),
                        \App\Typist\Actions\Batman::make('Batman'),
                        \App\Typist\Actions\Section::make('Section'),
                    ])->label('Blocks'),
                ])
                ->suggestions([
                    \App\Typist\Actions\Batman::make('Batman'),
                ])
                ->sidebar([
                    \App\Typist\Actions\Alert::make('Alert'),
                    \App\Typist\Actions\Batman::make('Batman'),
                    \App\Typist\Actions\Section::make('Section'),
                ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
    }
}
