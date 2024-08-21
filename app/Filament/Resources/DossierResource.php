<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\DossierCluster;
use App\Filament\Resources\DossierResource\Pages;
use App\Filament\Resources\DossierResource\RelationManagers;
use App\Models\Dossier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DossierResource extends Resource
{
    protected static ?string $cluster = DossierCluster::class;
    protected static ?string $model = Dossier::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date_ouverture')
                    ->required(),
                Forms\Components\TextInput::make('suite_reservee')
                    ->required(),
                Forms\Components\DatePicker::make('date_fixation')
                    ->required(),
                Forms\Components\DatePicker::make('data_classement')
                    ->required(),
                Forms\Components\Select::make('partie_id')
                    ->relationship('partie', 'id')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date_ouverture')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('suite_reservee')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_fixation')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_classement')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('partie.id')
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
            'index' => Pages\ListDossiers::route('/'),
            'create' => Pages\CreateDossier::route('/create'),
            'edit' => Pages\EditDossier::route('/{record}/edit'),
        ];
    }
}
