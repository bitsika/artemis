<?php

namespace Bitsika\Artemis\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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

        $request->setUserResolver(function () use ($response) {
            return $response->object();
        });

        return $next($request);
    }
}