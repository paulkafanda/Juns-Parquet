<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\DossierCluster;
use App\Filament\Resources\PlainteResource\Pages;
use App\Filament\Resources\PlainteResource\RelationManagers;
use App\Models\Plainte;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlainteResource extends Resource
{
    protected static ?string $cluster = DossierCluster::class;
    protected static ?string $model = Plainte::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('motif')
                    ->required(),
                Forms\Components\Select::make('dossier_id')
                    ->relationship('dossier', 'id')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('motif')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dossier.id')
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
            'index' => Pages\ListPlaintes::route('/'),
            'create' => Pages\CreatePlainte::route('/create'),
            'edit' => Pages\EditPlainte::route('/{record}/edit'),
        ];
    }
}
