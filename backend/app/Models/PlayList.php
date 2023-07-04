<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlayList extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',                 
        'description',
        'number_of_videos',
        'total_duration',
        'date_time',
        'user_id',
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function videoPlayLists():HasMany{
        return $this->hasMany(VideoPlayList::class);
    }
}
 