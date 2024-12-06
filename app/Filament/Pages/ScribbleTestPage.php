<?php

namespace App\Filament\Pages;

use Awcodes\Scribble\ScribbleEditor;
use Awcodes\Typist\Support\Faker;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use JetBrains\PhpStorm\NoReturn;

class ScribbleTestPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.modals-test-page';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'non_modal_content' => Faker::make()
                ->heading()
                ->paragraphs(2, false)
                ->asJson(),
//            'non_modal_content_two' => Faker::make()
//                ->heading()
//                ->paragraphs(2, true)
//                ->details()
//                ->paragraphs()
//                ->asJson()
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->statePath('data')
            ->schema([
                Actions::make([
                    Actions\Action::make('launchModal')
                        ->slideOver()
                        ->form([
                            TextInput::make('modal_text'),
                            ScribbleEditor::make('modal_content')
                        ])
                ]),
                ScribbleEditor::make('non_modal_content'),
            ]);
    }

    #[NoReturn] public function save(): void
    {
        dd($this->form->getState());
    }
}
