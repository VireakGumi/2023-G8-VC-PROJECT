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
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function videos(): HasMany
    {
        return $this->HasMany(Video::class);
    }

}
