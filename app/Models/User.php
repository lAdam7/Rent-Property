<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Applylandlord;
use App\Models\Property;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'forename',
        'surname',
        'email',
        'password',
        'token',
        'email_verified_at',
        'landlord'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password) // mutator
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function applylandlord()
    {
        return $this->hasOne(Applylandlord::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
