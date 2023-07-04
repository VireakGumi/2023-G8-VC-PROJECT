<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'description',
    ];
    public function videos():HasMany
    {
        return $this->hasMany(Video::class);
    } 

}
