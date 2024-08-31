<?php

namespace App\Filament\Resources\PartieResource\Pages;

use App\Filament\Resources\PartieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListParties extends ListRecords
{
    protected static string $resource = PartieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Enregistrer une nouvelle partie'),
        ];
    }
}

