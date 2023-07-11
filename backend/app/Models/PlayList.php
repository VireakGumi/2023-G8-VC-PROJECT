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
        'user_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function videoPlayLists():HasMany{
        return $this->hasMany(VideoPlayList::class);
    }
}
 