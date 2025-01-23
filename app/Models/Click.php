<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    /** @use HasFactory<\Database\Factories\ClickFactory> */
    use HasFactory;

    public function conversion() {
        return $this->hasOne(Conversion::class);
    }

    public function linkHistory()
    {
        return $this->belongsTo(LinkHistory::class);
    }
}
