<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Awcodes\Typist\TypistEntry;
use Filament\Actions;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewPage extends ViewRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Edit')
                ->url($this->getResource()::getUrl('edit', ['record' => $this->record])),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('title'),
                TypistEntry::make('content')
                    ->label('Content')
                    ->mergeTagsMap(['name' => 'Adam', 'email' => 'test@example.com', 'phone' => '(912) 867-5309'])
                    ->columnSpanFull(),
            ]);
    }
}
