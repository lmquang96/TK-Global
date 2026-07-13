<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientCredential extends Model
{
    /** @use HasFactory<\Database\Factories\ClientCredentialFactory> */
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function oauthToken()
    {
        return $this->hasOne(OauthToken::class, 'client_id', 'client_id');
    }
}
