<?php

namespace App\Typist\Actions;

use Awcodes\Typist\TypistAction;
use Awcodes\Typist\TypistEditor;
use Exception;
use Filament\Forms\Components;
use Illuminate\Support\Js;

class Alert extends TypistAction
{
    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Alert')
            ->icon(icon: 'heroicon-o-megaphone')
            ->iconButton()
            ->fillForm(function (array $arguments) {
                $defaults = [
                    'color' => 'info',
                    'dismissible' => false,
                ];

                return [...$defaults, ...$arguments];
            })
            ->form([
                Components\Radio::make('color')
                    ->inline()
                    ->inlineLabel(false)
                    ->afterStateHydrated(function (Components\Radio $component, $state) {
                        if (! $state) {
                            $component->state('info');
                        }
                    })
                    ->options([
                        'info' => 'Info',
                        'success' => 'Success',
                        'warning' => 'Warning',
                        'danger' => 'Danger',
                    ]),
                Components\Checkbox::make('dismissible'),
                Components\Textarea::make('message'),
            ])
            ->action(function (TypistEditor $component, array $arguments, array $data): void {
                $statePath = $component->getStatePath();

                $data = Js::from([
                    'identifier' => $this->getName(),
                    'values' => $data,
                    'view' => $this->getEditorView($data),
                    'coordinates' => $arguments['coordinates'] ?? null,
                ]);

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
            ->editorView(view: 'typist.actions.alert')
            ->renderView(view: 'typist.actions.alert');
    }
}
