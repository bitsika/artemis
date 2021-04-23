<?php

namespace Bitsika\Artemis\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Bitsika\Artemis\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class Artemis
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json'
            ])->withToken($request->bearerToken())->get(env('AUTHENTICATION_SERVER') . '/artemis/verify/user');

        if ($response->status() === JsonResponse::HTTP_UNAUTHORIZED) {
            return Response::json([
                'message' => 'unauthorized'
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }

        Log::info(print_r(env('TRANSACTION_SERVER'), true));
        Log::info(print_r($request->bearerToken(), true));
        Log::info(print_r($response->status(), true));
        Log::info(print_r($response->object(), true));

        // Use this later
        $user = $response->object();

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}