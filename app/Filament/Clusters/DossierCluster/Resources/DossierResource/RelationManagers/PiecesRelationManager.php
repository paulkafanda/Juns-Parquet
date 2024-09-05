<?php

namespace App\Filament\Clusters\DossierCluster\Resources\DossierResource\RelationManagers;

use App\Models\Dossier;
use App\Models\Piece;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PiecesRelationManager extends RelationManager
{
    protected static string $relationship = 'pieces';

    public function form(Form $form): Form
    {
        return $form
            ->schema(Piece::getForm());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                Tables\Columns\TextColumn::make('type')
                ->wrap(),
                Tables\Columns\TextColumn::make('description')
                ->wrap(),
                Tables\Columns\TextColumn::make('date')
                ->wrap(),
                Tables\Columns\TextColumn::make('path')
                ->wrap(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make('Ajouter Piece')
                    ->icon('heroicon-o-paper-clip')
                    ->mutateFormDataUsing(fn(Dossier $record) => ['dossier_id' => $record->id ])
                    ->using(function (array $data, Dossier $record) {
                        $piece = Piece::create($data);
                        $piece->dossier()->associate($record->id);
                        $piece->save();
                    })
                    ->form(
                        [
                            Forms\Components\Group::make([
                                Forms\Components\Select::make('dossier_id')
                                    ->relationship('dossiers', 'nom')
                                    ->options([])
                                    ->required()
                                ,
                                TextInput::make('type')
                                    ->required(),
                            ])->columns(2),
                            DatePicker::make('date')
                                ->default(now())
                                ->required(),
                            TextInput::make('description')
                                ->required(),
                            FileUpload::make('path')
                                ->acceptedFileTypes(['application/pdf'])
                                ->required(),
                        ]
                    )
                    ->model(Piece::class)
                    ->color('info')
                    ->tooltip("Ajouter une piece")
//                    ->visible(auth()->user()->isMagistrat())
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(fn(Piece $piece) => '/storage/' . $piece->path)
            ->openRecordUrlInNewTab();
    }

    protected function getTableHeaderActions(): array
    {
        return [
            Tables\Actions\CreateAction::make()
        ];
    }
}
