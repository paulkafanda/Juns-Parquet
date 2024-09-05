<?php

namespace App\Filament\Clusters\DossierCluster\Resources;

use App\Enums\FolderState;
use App\Enums\UserRole;
use App\Filament\Clusters\DossierCluster;
use App\Filament\Resources\DossierResource\Pages;
use App\Filament\Resources\DossierResource\RelationManagers;
use App\Models\Dossier;
use App\Models\Piece;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
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
            ->schema(Dossier::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('plainte.motif')
                ->wrap(),
                Tables\Columns\TextColumn::make('plainte.plaignant.prenom')
                ->wrap(),
                Tables\Columns\TextColumn::make('plainte.accusee.prenom')
                ->wrap(),
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
                Tables\Actions\Action::make('Ajouter Piece')
                    ->icon('heroicon-o-paper-clip')
                    ->fillForm(fn(Dossier $record) => ['dossier_id' => $record->id ])
                    ->action(function (array $data, Dossier $record) {

                        $data['dossier_id'] = $record->id;
                        $piece = Piece::create($data);
                        $piece->save();

                    })
                    ->label('')
                    ->modal()
                    ->modalHeading('Ajouter Piece')
                    ->form(
                        [
                            Forms\Components\Group::make([
                                TextInput::make('type')
                                    ->required(),
                                DatePicker::make('date')
                                    ->default(now())
                                    ->required(),
                            ])->columns(2),
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
                    ->sendSuccessNotification()
                ->visible(auth()->user()->isMagistrat()),
                Tables\Actions\Action::make('Fixer dossier')
                    ->icon('heroicon-o-bookmark')
                    ->action(function(Dossier $dossier) {
                        $dossier->date_fixation = now();
                        $dossier->suite_reservee = FolderState::FIXE;
                        $dossier->save();
                    })
                    ->label('')
                    ->color('success')
                    ->tooltip("Fixer le dosser")
                ->visible(auth()->user()->isMagistrat()),
                Tables\Actions\Action::make('Classer dossier')
                    ->icon('heroicon-o-folder')
                    ->action(function(Dossier $dossier) {
                        $dossier->date_classement = now();
                        $dossier->suite_reservee = FolderState::CLASSE;
                        $dossier->save();
                    })
                    ->label('')
                    ->color('warning')
                    ->tooltip("Classer le dosser")
                ->visible(auth()->user()->isMagistrat()),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                    ->slideOver(),
                    Tables\Actions\DeleteAction::make(),
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
            DossierCluster\Resources\DossierResource\RelationManagers\PiecesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => DossierResource\Pages\ListDossiers::route('/'),
//            'create' => Pages\CreateDossier::route('/create'),
//            'edit' => Pages\EditDossier::route('/{record}/edit'),
            'view' => DossierCluster\Resources\DossierResource\Pages\ViewDossier::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query =  parent::getEloquentQuery();
        return match (auth()->user()->role) {
            UserRole::MAGISTRAT => $query->whereRelation('plainte', 'magistrat_id', '=' ,auth()->id()),
            UserRole::JUGE => $query->where('suite_reservee', '=' ,FolderState::FIXE),
            default => $query
        };
    }
}
