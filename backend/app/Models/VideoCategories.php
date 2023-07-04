<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoCategories extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',                 
        'video_id',
    ];
    public function video():BelongsTo{
        return $this->belongsTo(Video::class);
    }
    public function category():BelongsTo{
        return $this->belongsTo(Categories::class);
    }
}
