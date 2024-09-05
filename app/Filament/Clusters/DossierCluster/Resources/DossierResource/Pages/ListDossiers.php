<?php

namespace App\Filament\Clusters\DossierCluster\Resources\DossierResource\Pages;

use App\Enums\FolderState;
use App\Enums\UserRole;
use App\Filament\Clusters\DossierCluster\Resources\DossierResource;
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
        $user = auth()->user();

        $unfixed_folder = match ($user->role) {
            UserRole::MAGISTRAT => Dossier::where('suite_reservee', '=', FolderState::EN_COURS)
                ->whereRelation('plainte', 'magistrat_id', $user->id)
                ->count(),
            default => Dossier::whereSuiteReservee(FolderState::FIXE)->count(),
        };
        $unclassed_folder = match ($user->role) {
            UserRole::MAGISTRAT => Dossier::whereNot('suite_reservee', '=', FolderState::CLASSE)
                ->whereRelation('plainte', 'magistrat_id', $user->id)
                ->count(),
            default => Dossier::whereSuiteReservee(FolderState::CLASSE)->count()
        };

        return match ($user->role) {
            UserRole::MAGISTRAT =>
            [
                'Tout les dossiers' => Tab::make()
                    ->badge(Dossier::whereRelation('plainte', 'magistrat_id', $user->id)->count()),
                'Non Fixes' => Tab::make()
                    ->modifyQueryUsing(fn(Builder $query) => $query
                        ->where('suite_reservee', '=', FolderState::EN_COURS)
                        ->whereRelation('plainte', 'magistrat_id', $user->id)
                    )
                    ->badge($unfixed_folder)
                    ->badgeColor('success'),
                'Non Classes' => Tab::make()
                    ->modifyQueryUsing(fn(Builder $query) => $query
                        ->whereNot('suite_reservee', '=', FolderState::CLASSE))
                    ->badge($unclassed_folder)
                    ->badgeColor('warning'),
            ],
            default => []
        };
    }
}
