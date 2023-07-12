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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
<<<<<<< HEAD
    public function histories(): HasMany
    {
        return $this->hasMany(history::class);
    }
    public function category(): belongsTo
=======
    public function histories():HasMany{
        return $this->hasMany(history::class);
    }
    public function categories(): BelongsTo
>>>>>>> 1ee7bd2a612998ab807eab98b7169bfad5ba98d9
    {
        return $this->belongsTo(Categories::class);
    }
    public function videoPlayLists(): HasMany
    {
        return $this->hasMany(VideoPlayList::class);
    }
}
