<?php

namespace App\Filament\Resources;

use App\Enums\AudienceState;
use App\Filament\Clusters\DossierCluster;
use App\Filament\Resources\AudienceResource\Pages;
use App\Filament\Resources\AudienceResource\RelationManagers;
use App\Models\Audience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AudienceResource extends Resource
{
    protected static ?string $cluster = DossierCluster::class;
    protected static ?string $model = Audience::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('dossier_id')
                    ->relationship('dossier', 'nom')
                    ->required(),
                Forms\Components\DateTimePicker::make('date')
                    ->required(),
                Forms\Components\TextInput::make('lieu')
                    ->required(),
                Forms\Components\Select::make('statut')
                    ->enum(AudienceState::class)
                    ->options(AudienceState::class)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lieu')
                    ->searchable(),
                Tables\Columns\TextColumn::make('statut')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dossier.nom')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAudiences::route('/'),
            'create' => Pages\CreateAudience::route('/create'),
            'edit' => Pages\EditAudience::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Audience::where('date', '>=', now())->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'info';
    }
}
