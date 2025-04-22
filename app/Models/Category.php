<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    const STATUS_ACTIVE = 1;

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function scopeStatusActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }
}
