<?php

namespace App\Filament\Resources\JugementResource\Pages;

use App\Filament\Resources\JugementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJugements extends ListRecords
{
    protected static string $resource = JugementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
