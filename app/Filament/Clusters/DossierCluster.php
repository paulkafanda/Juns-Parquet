<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class DossierCluster extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function canAccess(): bool
    {
        return ! (auth()->user()->isSecretaire() || auth()->user()->isChefOffice());
    }
}
