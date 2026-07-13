<?php

namespace App\Http\Controllers\api\publisher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\TokenService;

class AuthController extends Controller
{
    /**
     * Get Access Token
     *
     * This API exchanges an API Key and API Secret for a short-lived Access Token.
     * ⚠️ Note: This API is publicly accessible and does NOT require a Bearer Token in the header.
     *
     * @unauthenticated
     * @bodyParam api_key string required Your API key. Example: rET8aqQRN5dThpXU4APiXz2U
     * @bodyParam api_secret string required Your API secret. Example: eHldNmoEngCOIxmc8oE4s3D8CXkGQI2Bqo8AzccGwnTd8d0u
     * @response 200 {
     * "success": true,
     * "message": "Success",
     * "data": {
     * "accesss_token": "dPllco1OWOUdc5oNl3OcpZ9OkahCPrQfLqjD7r8TRzFMCkXdG4nqIWrtibGd",
     * "expires_in": "2026-07-10T15:40:54.838314Z"
     * }
     * }
     */
    public function getAccessToken(Request $request, TokenService $tokenService)
    {
        $request->validate([
            'api_key'    => 'required|string',
            'api_secret' => 'required|string',
        ]);

        $token = $tokenService->getClientByUser($request);

        return response()->success($token);
    }
}
