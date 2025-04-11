<?php

namespace App\Richie\Actions;

use Awcodes\Richie\RichieAction;
use Awcodes\Richie\RichieEditor;
use Awcodes\Richie\Support\EditorCommand;
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
            ->active(name: 'richieBlock', attributes: ['identifier' => $this->getName()])
            ->editorView(view: 'richie.actions.alert')
            ->renderView(view: 'richie.actions.alert')
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
                $component->runCommands(
                    [
                        new EditorCommand(
                            name: 'insertBlock',
                            arguments: [[
                                'identifier' => 'Alert',
                                'values' => $data,
                                'view' => $this->getEditorView($data),
                            ]],
                        ),
                    ],
                    editorSelection: $arguments['editorSelection'],
                );
            });
    }
}
