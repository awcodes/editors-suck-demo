<?php

namespace App\Richie\Forms;

use Awcodes\Palette\Forms\Components\ColorPickerSelect;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\ToggleButtons;

class Schema
{
    public static function make(
        array $common = [],
        array $content = [],
        array $media = [],
        array $actions = [],
        array $variants = [],
    ) {
        $tabs = collect([
            'Common' => $common,
            'Content' => $content,
            'Media' => $media,
            'Actions' => $actions,
            'Variants' => $variants,
        ])
            ->filter(fn ($item) => filled($item))
            ->map(function ($item, $name) {
                return Tab::make($name)->schema($item);
            });

        return Tabs::make()
            ->tabs($tabs->toArray());
    }

    public static function getCommonBlockSettings(): array
    {
        return [
            Grid::make()->schema([
                ColorPickerSelect::make('background_color')
                    ->label('Background Color')
                    ->withWhite()
                    ->storeAsKey()
                    ->extraInputAttributes(['class' => 'branded']),
                ToggleButtons::make('is_full_width')
                    ->grouped()
                    ->default(false)
                    ->options([
                        true => 'Full Width',
                        false => 'Contained',
                    ]),
            ]),
        ];
    }
}

