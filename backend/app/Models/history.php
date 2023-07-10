<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class history extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_id',
        'user_id',
        'date_time',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function videos():BelongsTo{
        return $this->belongsTo(Video::class);
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
