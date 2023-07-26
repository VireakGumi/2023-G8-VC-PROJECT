<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Channel extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'date_time',
        'user_id',
        'profile'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function followers():HasMany{
        return $this->hasMany(Follower::class);
    }
    public function userBlocked():HasMany{
        return $this->hasMany(UserBlocked::class);
    }
    public function videos():HasMany{
        return $this->hasMany(Video::class);
    }
}
