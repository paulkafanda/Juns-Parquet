<?php /** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */

/** @noinspection ALL */

namespace App\Models;

use App\Enums\FolderState;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dossier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_ouverture',
        'suite_reservee',
        'date_fixation',
        'data_classement',
        'partie_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date_ouverture' => 'date',
        'date_fixation' => 'date',
        'data_classement' => 'date',
        'partie_id' => 'integer',
        'suite_reservee' => FolderState::class,
    ];

    public static function getForm(): array
    {
        return [
            DatePicker::make('date_ouverture')
                ->default(now())
                ->hidden()
                ->required(),
            TextInput::make('nom')
                ->required(),
            Select::make('suite_reservee')
                ->enum(FolderState::class)
                ->options(FolderState::class)
                ->default(FolderState::EN_COURS),
            DatePicker::make('date_fixation')
                ->nullable(),
            DatePicker::make('date_classement')
                ->nullable(),
            Select::make('plainte_id')
                ->relationship('plainte', 'motif', fn($query) => $query->where('magistrat_id', auth()->id()))
                ->required(),
        ];
    }

    public function plainte(): BelongsTo
    {
        return $this->belongsTo(Plainte::class);
    }

    public function pieces(): HasMany
    {
        return $this->hasMany(Piece::class);
    }
}
