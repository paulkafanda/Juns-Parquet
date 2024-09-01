<?php

namespace App\Filament\Resources\DossierResource\Pages;

use App\Filament\Resources\DossierResource;
use App\Models\Dossier;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListDossiers extends ListRecords
{
    protected static string $resource = DossierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Creer un  nouveau dossier'),
        ];
    }

    public function getTabs(): array
    {
        $unfixed_folder = Dossier::whereNull('date_fixation')->count();
        $unclassed_folder = Dossier::whereNull('date_classement')->count();

        return [
            'Tout les dossiers' => Tab::make()
            ->badge(Dossier::count()),
            'Fixes' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->whereNotNull('date_fixation'))
            ->badge($unfixed_folder)
            ->badgeColor('warning'),
            'Classes' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->whereNotNull('date_classement'))
            ->badge($unclassed_folder)
            ->badgeColor('warning'),
        ];
    }
}
