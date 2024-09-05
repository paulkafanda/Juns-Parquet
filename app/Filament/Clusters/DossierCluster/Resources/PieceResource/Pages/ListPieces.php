<?php

namespace App\Filament\Clusters\DossierCluster\Resources\PieceResource\Pages;

use App\Filament\Clusters\DossierCluster\Resources\PieceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPieces extends ListRecords
{
    protected static string $resource = PieceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
