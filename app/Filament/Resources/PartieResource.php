<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartieResource\Pages;
use App\Filament\Resources\PartieResource\RelationManagers;
use App\Models\Partie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PartieResource extends Resource
{
    protected static ?string $model = Partie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('role')
                    ->required(),
                Forms\Components\TextInput::make('nom')
                    ->required(),
                Forms\Components\TextInput::make('post_nom')
                    ->required(),
                Forms\Components\TextInput::make('prenom')
                    ->required(),
                Forms\Components\TextInput::make('adresse')
                    ->required(),
                Forms\Components\TextInput::make('sexe')
                    ->required(),
                Forms\Components\TextInput::make('tel')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('origine')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('role')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('post_nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prenom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('adresse')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sexe')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('origine')
                    ->searchable(),
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
            'index' => Pages\ListParties::route('/'),
            'create' => Pages\CreatePartie::route('/create'),
            'edit' => Pages\EditPartie::route('/{record}/edit'),
        ];
    }
}
