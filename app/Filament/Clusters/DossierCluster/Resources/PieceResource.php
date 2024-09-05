<?php

namespace App\Filament\Clusters\DossierCluster\Resources;

use App\Filament\Clusters\DossierCluster;
use App\Filament\Resources\PieceResource\Pages;
use App\Filament\Resources\PieceResource\RelationManagers;
use App\Models\Piece;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PieceResource extends Resource
{
    protected static ?string $cluster = DossierCluster::class;
    protected static ?string $model = Piece::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Piece::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
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
                    Tables\Actions\DeleteBulkAction::make()
                    ->visible(auth()->check()),
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
            'index' => PieceResource\Pages\ListPieces::route('/'),
            'create' => PieceResource\Pages\CreatePiece::route('/create'),
            'edit' => PieceResource\Pages\EditPiece::route('/{record}/edit'),
        ];
    }
}
