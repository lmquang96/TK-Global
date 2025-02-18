<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $lastRecord = static::latest('affiliate_id')->first();

            $number = $lastRecord ? ((int) substr($lastRecord->affiliate_id, 2)) + 1 : 1;

            $model->affiliate_id = 'TK' . str_pad($number, 4, '0', STR_PAD_LEFT);
        });
    }
}
