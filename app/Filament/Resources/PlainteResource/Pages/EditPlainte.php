<?php

namespace App\Filament\Resources\PlainteResource\Pages;

use App\Filament\Resources\PlainteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlainte extends EditRecord
{
    protected static string $resource = PlainteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
