<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserBlocked extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'blocked_user_id',
        'blocking_channel_id',
        'date_time',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function channels():BelongsTo{
        return $this->belongsTo(Channel::class);
    }
}
