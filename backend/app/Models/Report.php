<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id',
       'video_id',
       'comment',
       'type_of_report',
       'content_video'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function video():BelongsTo{
        return $this->belongsTo(Video::class);
    }
}
