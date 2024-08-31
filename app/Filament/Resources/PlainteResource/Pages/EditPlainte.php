<?php

namespace App\Filament\Resources\PlainteResource\Pages;

use App\Filament\Resources\PlainteResource;
use App\Models\Partie;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

class EditPlainte extends EditRecord
{
    protected static string $resource = PlainteResource::class;

    public function getHeading(): string|Htmlable
    {
        return match (auth()->user()->isChefOffice()) {
            true => 'Attribuer la plainte a un magistrat',
            default => parent::getHeading(),
        };
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
