<?php

namespace App\Models;

use App\Enums\UserRole;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Plainte extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'magique' => 'integer',
        'plaignant' => 'integer',
        'accusee' => 'integer',
    ];

    public function plaignant(): BelongsTo
    {
        return $this->belongsTo(Partie::class);
    }

    public function accusee(): BelongsTo
    {
        return $this->belongsTo(Partie::class);
    }

    public function magistrat(): ?BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dossier(): HasOne
    {
        return $this->hasOne(Dossier::class);
    }
    /**
     * @param $isEditing bool
     * @return array
     */
    public static function getForm(bool $isEditing = false): array
    {
        return [
            TextInput::make('motif')
                ->required()
            ->disabled($isEditing),
            Select::make('plaignant_id')
                ->relationship('plaignant', 'nom')
                ->createOptionForm(Partie::getForm())
                ->required()
            ->disabled($isEditing),
            Select::make('accusee_id')
                ->relationship('accusee', 'nom')
                ->createOptionForm(Partie::getForm())
                ->required()
            ->disabled($isEditing),
            Select::make('magistrat_id')
                ->relationship('magistrat', 'name', function($query) {
                    $query->where('role', UserRole::MAGISTRAT);
                })
                ->visible(auth()->user()->isChefOffice())
            ->nullable(),
        ];
    }
}
