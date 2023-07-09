<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'date_time',
        'viewer',
        'path',
        'privacy',
        'categories_id',
        'user_id',
    ];
    protected $hidden = [
        'created_at',
        'remember_token',
        'updated_at'
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function comments():HasMany{
        return $this->hasMany(Comment::class);
    }public function likes():HasMany{
        return $this->hasMany(Like::class);
    }
    public function history():HasMany{
        return $this->hasMany(history::class);
    }
    public function categories(): belongsTo
    {
        return $this->belongsTo(Categories::class);
    }
    public function videoPlayLists():HasMany{
        return $this->hasMany(VideoPlayList::class);
    }

}
