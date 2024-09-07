<?php

namespace App\Filament\Resources\PartieResource\Pages;

use App\Filament\Resources\PartieResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

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
    public  function  getTabs(): array
    {
        return [
            'Tous' => Tab::make('Tous'),
            'Plaignant' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('partieAsPlaignants')),
            'Accuse' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('partieAsAccuse')),
        ];
    }
}

