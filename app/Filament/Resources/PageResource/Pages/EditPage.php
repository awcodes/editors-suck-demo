<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('preview')
                ->color('gray')
                ->url(static fn ($record) => route('page.show', $record), shouldOpenInNewTab: true),
            Actions\DeleteAction::make(),
        ];
    }
}
