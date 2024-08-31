<?php

namespace App\Models;

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

    public function plaignant(): HasOne
    {
        return $this->hasOne(Partie::class, 'id');
    }

    public function accusee(): HasOne
    {
        return $this->hasOne(Partie::class, 'id');
    }

    public function magistrat(): ?BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return array
     */
    public static function getForm(): array
    {
        return [
            TextInput::make('motif')
                ->required(),
            Select::make('plaignant_id')
                ->relationship('plaignant', 'nom')
                ->createOptionForm(Partie::getForm())
                ->required(),
            Select::make('accusee_id')
                ->relationship('accusee', 'nom')
                ->createOptionForm(Partie::getForm())
                ->required(),
            Select::make('magistrat_id')
                ->relationship('magistrat', 'name')
                ->visible(auth()->user()->isChefOffice())
            ->nullable(),
        ];
    }
}
