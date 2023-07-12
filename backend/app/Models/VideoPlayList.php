<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoPlayList extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_id',                 
        'play_list_id',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function video():BelongsTo{
        return $this->belongsTo(Video::class);
    }
    public function playList():BelongsTo{
        return $this->belongsTo(PlayList::class);
    }
}
