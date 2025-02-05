<?php

namespace App\Typist\Actions;

use Awcodes\Palette\Forms\Components\ColorPicker;
use Awcodes\PresetColorPicker\PresetColorPicker;
use Awcodes\Typist\TypistAction;
use Awcodes\Typist\TypistEditor;
use Exception;
use Filament\Forms\Components;
use Filament\Support\Colors\Color;
use Illuminate\Support\Js;

class Batman extends TypistAction
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
            ->action(function (TypistEditor $component, array $arguments, array $data): void {
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
            ->after(function (TypistEditor $component): void {
                $component->getLivewire()->dispatch('focus-editor', statePath: $component->getStatePath());
            })
            ->active(name: 'typistBlock', attributes: ['identifier' => $this->getName()])
            ->editorView(view: 'typist.actions.batman')
            ->renderView(view: 'typist.actions.batman');
    }
}
