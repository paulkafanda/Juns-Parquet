<?php

namespace App\Filament\Resources\PlainteResource\Pages;

use App\Filament\Resources\PlainteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlaintes extends ListRecords
{
    protected static string $resource = PlainteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label("Enregistrer une nouvelle plainte"),
        ];
    }
}
