<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    /** @use HasFactory<\Database\Factories\ConversionFactory> */
    use HasFactory;

    public function click()
    {
        return $this->belongsTo(Click::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
