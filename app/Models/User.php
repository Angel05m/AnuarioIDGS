<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\BolsaTrabajos;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'apellido_paterno', // <-- AÑADIR
        'apellido_materno', // <-- AÑADIR
        'matricula',        // <-- AÑADIR
        'email',
        'password',
        'foto_perfil',      // <-- AÑADIR
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
        ];
    }
    public function bolsaTrabajos()
    {
        return $this->hasMany(BolsaTrabajos::class, 'fk_usuario', 'id');
    }

    public function publications()
{
    return $this->hasMany(\App\Models\Publication::class);
}

}
