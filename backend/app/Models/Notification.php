<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'video_id',
        'channel_id',
        'date_time'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function video(): BelongsTo{
        return $this->belongsTo(Video::class);
    }
    public function channel(): BelongsTo{
        return $this->belongsTo(Channel::class);
    }
}
