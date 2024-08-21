<?php

namespace App\Filament\Resources\AudienceResource\Pages;

use App\Filament\Resources\AudienceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAudience extends EditRecord
{
    protected static string $resource = AudienceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
