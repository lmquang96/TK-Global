<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OauthToken extends Model
{
    /** @use HasFactory<\Database\Factories\OauthTokenFactory> */
    use HasFactory;

    protected $guarded = [];

    public function clientCredential()
    {
        return $this->belongsTo(ClientCredential::class, 'client_id', 'client_id');
    }
}
