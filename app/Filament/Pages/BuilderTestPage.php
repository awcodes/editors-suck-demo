<?php

namespace App\Filament\Pages;

use Awcodes\Typist\Support\Faker;
use Awcodes\Typist\TypistEditor;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Pages\Page;
use JetBrains\PhpStorm\NoReturn;

class BuilderTestPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.builder-test-page';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->statePath('data')
            ->schema([
                Builder::make('builder_test')
                    ->blocks([
                        Builder\Block::make('builder_test_block')
                            ->schema([
                                TypistEditor::make('content'),
                            ])
                    ])
            ]);
    }

    #[NoReturn] public function save(): void
    {
        dd($this->form->getState());
    }
}
