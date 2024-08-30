<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }

    public function isMagistrat(): bool
    {
        return $this->role === UserRole::MAGISTRAT;
    }

    public function isSecretaire(): bool
    {
        return $this->role === UserRole::SECRETAIRE;
    }

    public function isChefOffice(): bool
    {
        return $this->role === UserRole::CHEF_OFFICE;
    }

    public function isJuge(): bool
    {
        return $this->role === UserRole::JUGE;
    }

    /**
     * @return array
     */
    public static function getForm(): array
    {
        return [
            TextInput::make('name')
                ->required(),
            TextInput::make('email')
                ->email()
                ->required(),
            TextInput::make('post_nom'),
            TextInput::make('prenom'),
            TextInput::make('tel')
                ->tel(),
            TextInput::make('sexe'),
            TextInput::make('adresse'),
            Select::make('role')
                ->enum(UserRole::class)
                ->options(UserRole::class),
            DateTimePicker::make('email_verified_at'),
            TextInput::make('password')
                ->password()
                ->required(),
        ];
    }
}
