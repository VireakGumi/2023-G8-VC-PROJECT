<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id',
        'user_id',
        'date_time',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function users():BelongsToMany{
        return $this->belongsToMany(User::class);
    }
    public function channels():BelongsToMany{
        return $this->belongsToMany(Channel::class);
    }

}
