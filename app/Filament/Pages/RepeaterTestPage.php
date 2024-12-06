<?php

namespace App\Filament\Pages;

use Awcodes\Typist\TypistEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Pages\Page;
use JetBrains\PhpStorm\NoReturn;

class RepeaterTestPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.repeater-test-page';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'repeater_test' => [
                [
                    'content' => null,
                ],
                [
                    'content' => null,
                ]
            ]
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->statePath('data')
            ->schema([
                Repeater::make('repeater_test')
                    ->reorderableWithButtons()
                    ->schema([
                        TypistEditor::make('content')
                            ->label(fn ($component) => $component->getStatePath()),
//                        RichEditor::make('rich_editor'),
//                        MarkdownEditor::make('markdown_editor'),
                    ])
            ]);
    }

    #[NoReturn] public function save(): void
    {
        dd($this->form->getState());
    }
}
