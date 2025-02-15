<?php

namespace App\Richie\Actions;

use App\Richie\Editors\MinimalEditor;
use App\Richie\Forms\Schema;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Richie\RichieAction;
use Awcodes\Richie\RichieEditor;
use Exception;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section as FilamentSection;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Support\Js;

class Section extends RichieAction
{
    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Section')
            ->icon(icon: 'heroicon-o-cube')
            ->iconButton()
            ->fillForm(function (array $arguments) {
                $defaults = [
                    'is_full_width' => false,
                ];

                return [...$defaults, ...$arguments];
            })
            ->slideOver()
            ->form(fn () => [
                ...Schema::getCommonBlockSettings(),
                MinimalEditor::make('text'),
                Grid::make()->schema([
                    CuratorPicker::make('image'),
                    CuratorPicker::make('background_image'),
                ]),
                FilamentSection::make('Variants')
                    ->schema([
                        Grid::make(3)->schema([
                            ToggleButtons::make('image_position')
                                ->options([
                                    'start' => 'Start',
                                    'end' => 'End',
                                ])
                                ->grouped(),
                            ToggleButtons::make('image_alignment')
                                ->options([
                                    'top' => 'Top',
                                    'middle' => 'Middle',
                                    'bottom' => 'Bottom',
                                ])
                                ->grouped(),
                            ToggleButtons::make('image_flush')
                                ->options([
                                    false => 'No',
                                    true => 'Yes',
                                ])
                                ->grouped(),
                            ToggleButtons::make('image_rounded')
                                ->options([
                                    false => 'No',
                                    true => 'Yes',
                                ])
                                ->grouped(),
                            ToggleButtons::make('image_shadow')
                                ->options([
                                    false => 'No',
                                    true => 'Yes',
                                ])
                                ->grouped(),
                        ]),
                    ])
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
            ->editorView(view: 'richie.actions.section')
            ->renderView(view: 'richie.actions.section');
    }
}
