<?php

namespace App\Richie\Actions;

use Awcodes\Palette\Forms\Components\ColorPicker;
use Awcodes\PresetColorPicker\PresetColorPicker;
use Awcodes\Richie\RichieAction;
use Awcodes\Richie\RichieEditor;
use Exception;
use Filament\Forms\Components;
use Filament\Support\Colors\Color;
use Illuminate\Support\Js;

class Batman extends RichieAction
{
    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Batman')
            ->icon(icon: 'icon-batman')
            ->iconButton()
            ->fillForm(function (array $arguments) {
                $defaults = [
                    'name' => 'Batman',
                    'color' => 'black',
                    'side' => 'hero'
                ];
ray($arguments);
                return [...$defaults, ...$arguments];
            })
            ->form([
                Components\Radio::make('name')
                    ->options([
                        'Batman' => 'Batman',
                        'Robin' => 'Robin',
                        'Joker' => 'Joker',
                        'Poison Ivy' => 'Poison Ivy',
                        'Harley Quinn' => 'Harley Quinn',
                    ])
                    ->inline()
                    ->inlineLabel(false),
                ColorPicker::make('color')
                    ->storeAsKey()
                    ->columnSpanFull()
                    ->colors([
                        'black' => Color::hex('#000000'),
                        'yellow' => Color::Yellow,
                        'purple' => Color::Purple,
                        'green' => Color::Emerald,
                        'red' => Color::Red,
                    ]),
                Components\Radio::make('side')
                    ->options([
                        'hero' => 'Hero',
                        'villain' => 'Villain'
                    ])
                    ->inline()
                    ->inlineLabel(false),
            ])
            ->action(function (RichieEditor $component, array $arguments, array $data): void {
                $statePath = $component->getStatePath();

                $data = Js::from([
                    'identifier' => $this->getName(),
                    'values' => $data,
                    'view' => $this->getEditorView($data),
                    'coordinates' => $arguments['coordinates'] ?? null,
                ]);

                ray($arguments['coordinates']);

                $component->getLivewire()->js(<<<JS
                    setTimeout(() => {
                        window.editors['$statePath'].chain().focus().insertBlock($data).run()
                    }, 0)
                JS);
            })
            ->after(function (RichieEditor $component): void {
                $component->getLivewire()->dispatch('focus-editor', statePath: $component->getStatePath());
            })
            ->active(name: 'richieBlock', attributes: ['identifier' => $this->getName()])
            ->editorView(view: 'richie.actions.batman')
            ->renderView(view: 'richie.actions.batman');
    }
}
