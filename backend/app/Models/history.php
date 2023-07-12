<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
<<<<<<< HEAD
    public function videos():BelongsToMany{
        return $this->belongsToMany(Video::class);
=======
    public function video():BelongsTo{
        return $this->belongsTo(Video::class);
>>>>>>> 1ee7bd2a612998ab807eab98b7169bfad5ba98d9
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
