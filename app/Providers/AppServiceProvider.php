<?php

namespace App\Providers;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Models\Media;
use Awcodes\Typist\Facades\Typist;
use Awcodes\Typist\Support\ToolbarGroup;
use Awcodes\Typist\TypistEditor;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
                ->uploader(
                    CuratorPicker::make('src')
                        ->required()
                        ->afterStateHydrated(function ($component, $state) {
                            if (is_string($state)) {
                                $media = Media::query()->where('path', $state)->first();

                                $component->state([(string) Str::uuid() => $media]);
                            }
                        })
                        ->afterStateUpdated(function ($state, Set $set) {
                            $media = Arr::first($state);

                            $set('alt', $media['alt']);
                            $set('title', $media['title']);

                            if (Str::contains($media['type'], 'image')) {
                                $set('type', 'image');
                                if (! Str::contains($media['type'], 'svg')) {
                                    $set('width', $media['width']);
                                    $set('height', $media['height']);
                                } else {
                                    $set('width', 50);
                                    $set('height', 50);
                                }
                            } else {
                                $set('type', 'document');
                            }
                        })
                        ->dehydrateStateUsing(function ($state) {
                            return Arr::first($state)['url'];
                        }),
                )
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
