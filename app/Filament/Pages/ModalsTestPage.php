<?php

namespace App\Filament\Pages;

use App\Richie\Editors\MinimalEditor;
use Awcodes\Richie\Support\Faker;
use Awcodes\Richie\RichieEditor;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Pages\Page;
use JetBrains\PhpStorm\NoReturn;

class ModalsTestPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.modals-test-page';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'non_modal_content' => Faker::make()
                ->heading()
                ->paragraphs(2, true)
                ->image(
                    source: 'https://editors-suck.test/storage/media/fc01fa7e-f6c3-4561-9593-56de188194ca.jpg',
                    width: 975,
                    height: 560
                )
                ->details()
                ->paragraphs()
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
                            RichieEditor::make('modal_content')
                        ])
                ]),
                RichieEditor::make('non_modal_content')
                    ->mergeTags([
                        'name',
                        'email',
                        'phone',
                    ]),
//                RichieEditor::make('non_modal_content_two'),
            ]);
    }

    #[NoReturn] public function save(): void
    {
        dd($this->form->getState());
    }
}
