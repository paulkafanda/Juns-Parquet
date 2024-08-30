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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'motif',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function plaignant(): HasOne
    {
        return $this->hasOne(Partie::class, 'id');
    }

    public function accusee(): HasOne
    {
        return $this->hasOne(Partie::class, 'id');
    }

    public function magistrat(): HasOne
    {
        return $this->hasOne(User::class, 'id');
    }

    /**
     * @return array
     */
    public static function getForm(): array
    {
        return [
            TextInput::make('motif')
                ->required(),
            Select::make('plaignant')
                ->relationship('plaignant', 'nom')
                ->createOptionForm(Partie::getForm())
                ->required(),
            Select::make('accusee')
                ->relationship('accusee', 'nom')
                ->createOptionForm(Partie::getForm())
                ->required(),
            Select::make('magistrat')
                ->relationship('magistrat', 'name'),
        ];
    }
}
