<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlainteResource\Pages;
use App\Filament\Resources\PlainteResource\RelationManagers;
use App\Models\Plainte;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use phpDocumentor\Reflection\Types\This;

class PlainteResource extends Resource
{
    protected static ?string $model = Plainte::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';

    public static function form(Form $form): Form
    {
        $isEditing = $form->getRecord()?->exists && auth()->user()->isChefOffice();
        return $form
            ->schema(Plainte::getForm($isEditing));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('motif')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plaignant.nom')
                ->searchable(),
                Tables\Columns\TextColumn::make('accusee.nom')
                ->searchable(),
                Tables\Columns\TextColumn::make('magistrat.name')
                    ->hidden(auth()->user()->isSecretaire())
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
            'index' => Pages\ListPlaintes::route('/'),
            'create' => Pages\CreatePlainte::route('/create'),
            'edit' => Pages\EditPlainte::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Plainte::where('magistrat_id', null)->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'danger';
    }
}
