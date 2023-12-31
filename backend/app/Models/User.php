<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function role():BelongsTo{
        return $this->belongsTo(Role::class);
    }
    public function history():HasOne{
        return $this->hasOne(history::class);
    }
    public function likes():HasMany{
        return $this->hasMany(Like::class);
    }
    public function followers():HasMany{
        return $this->hasMany(Follower::class);
    }
    public function userblocked():HasMany{
        return $this->hasMany(UserBlocked::class);
    }
    public function playlists():HasMany{
        return $this->hasMany(PlayList::class);
    }
    public function reports():HasMany{
        return $this->hasMany(Report::class);
    }
    public function notifications():HasMany{
        return $this->hasMany(Notification::class);
    }
    public function channel():HasOne{
        return $this->hasOne(Channel::class);
    }
}
