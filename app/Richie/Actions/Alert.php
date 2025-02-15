<?php

namespace App\Richie\Actions;

use Awcodes\Richie\RichieAction;
use Awcodes\Richie\RichieEditor;
use Exception;
use Filament\Forms\Components;
use Illuminate\Support\Js;

class Alert extends RichieAction
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
            ->action(function (RichieEditor $component, array $arguments, array $data): void {
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
            ->after(function (RichieEditor $component): void {
                $component->getLivewire()->dispatch('focus-editor', statePath: $component->getStatePath());
            })
            ->active(name: 'richieBlock', attributes: ['identifier' => $this->getName()])
            ->editorView(view: 'richie.actions.alert')
            ->renderView(view: 'richie.actions.alert');
    }
}
