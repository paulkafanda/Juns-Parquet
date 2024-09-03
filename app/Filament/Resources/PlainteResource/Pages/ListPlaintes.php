<?php

namespace App\Filament\Resources\PlainteResource\Pages;

use App\Enums\UserRole;
use App\Filament\Resources\PlainteResource;
use App\Models\Plainte;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

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

    public function getTabs(): array
    {
        return match (auth()->user()->role) {
            UserRole::CHEF_OFFICE => [
                'Toutes les plaintes' => Tab::make(),
                'Non Attribuees' => Tab::make()
                    ->modifyQueryUsing(fn(Builder $query) => $query->whereDoesntHave('magistrat'))
                    ->badge(Plainte::whereDoesntHave('magistrat')->count())
                    ->badgeColor('danger'),
            ],
            default => []

        };
    }
}
