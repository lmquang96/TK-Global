<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    /** @use HasFactory<\Database\Factories\CampaignFactory> */
    use HasFactory;

    const STATUS_ACTIVE = 1;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function linkHistories()
    {
        return $this->hasMany(LinkHistory::class);
    }

    public function conversions()
    {
        return $this->hasMany(Conversion::class);
    }

    public function scopeStatusActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }
}
