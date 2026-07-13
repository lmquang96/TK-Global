<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\OauthToken;
use App\Models\ClientCredential;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TokenService
{
  const MSG_EMPTY_CLIENT = 'API Key hoặc API Secret không chính xác';

  public function getClientByUser(Request $request)
  {
    $client = ClientCredential::where('client_id', $request->api_key)
      ->where('client_secret', $request->api_secret)
      ->first();

    if (!$client) {
      return [
        'status' => false,
        'data' => self::MSG_EMPTY_CLIENT
      ];
    }

    $accessToken = Str::random(60);
    $expiresIn = Carbon::now()->addHours(6);

    $token = OauthToken::updateOrCreate([
      'client_id' => $client->client_id
    ], [
      'client_id' => $client->client_id,
      'token_hash' => $accessToken,
      'expires_at' => $expiresIn
    ]);

    return [
      'accesss_token' => $token->token_hash,
      'expires_in' => $expiresIn
    ];
  }
}
