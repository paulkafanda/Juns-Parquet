<?php

namespace App\Models;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Piece extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'date',
        'description',
        'dossier_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'date',
        'dossier_id' => 'integer',
    ];

    public static function getForm(): array
    {
        return [
            Select::make('dossier_id')
                ->relationship('dossier', 'nom')
                ->required(),
            TextInput::make('type')
                ->required(),
            DatePicker::make('date')
                ->default(now())
                ->required(),
            TextInput::make('description')
                ->required(),
            FileUpload::make('path')
                ->acceptedFileTypes(['application/pdf'])
                ->required(),
        ];
    }

    public function dossier(): BelongsTo
    {
        return $this->belongsTo(Dossier::class);
    }
}
