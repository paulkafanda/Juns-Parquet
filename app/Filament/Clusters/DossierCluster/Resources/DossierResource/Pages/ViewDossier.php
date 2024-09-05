<?php

namespace App\Filament\Clusters\DossierCluster\Resources\DossierResource\Pages;

use App\Enums\FolderState;
use App\Filament\Clusters\DossierCluster;
use App\Filament\Clusters\DossierCluster\Resources\DossierResource;
use App\Filament\Clusters\DossierCluster\Resources\DossierResource\RelationManagers\PiecesRelationManager;
use App\Models\Dossier;
use App\Models\Piece;
use Filament\Actions;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewDossier extends ViewRecord
{
    protected static string $resource = DossierResource::class;
    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Dossier [' . $this->record->nom . ']')
                ->schema([
                    Group::make([
                        TextEntry::make('nom'),
                        TextEntry::make('plainte.motif'),
                    ])->columns(),
                    Group::make([
                        TextEntry::make('date_fixation'),
                        TextEntry::make('date_classement'),
                    ])->columns(),
                    TextEntry::make('suite_reservee')
                    ->badge()
                    ->color(fn($record) => match ($record->suite_reservee) {
                        FolderState::EN_COURS => 'warning',
                        FolderState::FIXE => 'success',
                        FolderState::CLASSE => 'primary',
                    })
                ])->columns(3)
            ])->columns(3);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make('Editez le dossier')
            ->form(Dossier::getForm())
            ->modal()
            ->visible(auth()->user()->isMagistrat()),
        ];
    }

    public function getRelationManagers(): array
    {
        return [
            PiecesRelationManager::make(),
        ];
    }
}
