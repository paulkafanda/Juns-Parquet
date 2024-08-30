<?php

namespace App\Models;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role',
        'nom',
        'post_nom',
        'prenom',
        'adresse',
        'sexe',
        'tel',
        'origine',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * @return array
     */
    public static function getForm(): array
    {
        return [
            TextInput::make('nom')
                ->required(),
            TextInput::make('post_nom')
                ->required(),
            TextInput::make('prenom')
                ->required(),
            TextInput::make('adresse')
                ->required(),
            TextInput::make('sexe')
                ->required(),
            TextInput::make('tel')
                ->tel()
                ->required(),
            TextInput::make('origine')
                ->required(),
        ];
    }
}
