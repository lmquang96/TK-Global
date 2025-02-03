<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkHistory extends Model
{
    /** @use HasFactory<\Database\Factories\LinkHistoryFactory> */
    use HasFactory;

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function click() {
        return $this->hasMany(Click::class);
    }
}
