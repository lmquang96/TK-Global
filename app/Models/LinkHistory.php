<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkHistory extends Model
{
    /** @use HasFactory<\Database\Factories\LinkHistoryFactory> */
    use HasFactory;

    protected $fillable = [
        'sub1',
        // thêm các cột khác được phép update/create tại đây
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function click() {
        return $this->hasMany(Click::class);
    }
}
