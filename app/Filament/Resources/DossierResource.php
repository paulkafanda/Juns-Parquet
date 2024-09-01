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

class DossierResource extends Resource
{
    protected static ?string $cluster = DossierCluster::class;
    protected static ?string $model = Dossier::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date_ouverture')
                    ->default(now())
                    ->hidden()
                    ->required(),
                Forms\Components\Textarea::make('suite_reservee')
                    ->nullable(),
                Forms\Components\DatePicker::make('date_fixation')
                    ->nullable(),
                Forms\Components\DatePicker::make('date_classement')
                    ->nullable(),
                Forms\Components\Select::make('plainte_id')
                    ->relationship('plainte', 'motif')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('plainte.motif'),
                Tables\Columns\TextColumn::make('suite_reservee')
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
                Tables\Actions\Action::make('Fixer dossier')
                ->action(function(Dossier $dossier) {
                    $dossier->date_fixation = now();
                    $dossier->save();
                })
                ->color('success')
                ->tooltip("Fixer le dosser(Definit la date de fixation)"),
                Tables\Actions\Action::make('Classer dossier')
                ->action(function(Dossier $dossier) {
                    $dossier->date_classement = now();
                    $dossier->save();
                })
                ->color('info')
                ->tooltip("Classer le dosser(Definit la date de classement)"),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ])
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

    public static function getEloquentQuery(): Builder
    {
        $query =  parent::getEloquentQuery();
        return match (auth()->user()->isMagistrat()) {
            true => $query->whereRelation('plainte', 'magistrat_id', '=' ,auth()->id()),
            default => $query
        };
    }
}
