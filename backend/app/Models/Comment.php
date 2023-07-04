<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment_text',
        'video_id',
        'user_id',
        'date_time',
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function video():BelongsTo{
        return $this->belongsTo(Video::class);
    }
}
 