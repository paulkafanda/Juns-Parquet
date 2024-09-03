<?php

namespace App\Models;

use App\Enums\FolderState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function plainte(): BelongsTo
    {
        return $this->belongsTo(Plainte::class);
    }
}
