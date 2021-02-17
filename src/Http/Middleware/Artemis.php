<?php

namespace Bitsika\Artemis\Http\Middleware;

use Bitsika\Artemis\Models\User;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
            ])->withToken($request->bearerToken())->get(config('bitsika.server_url.transaction') . '/api/v1/artemis/verify/user');

        if ($response->status() === JsonResponse::HTTP_UNAUTHORIZED) {
            return Response::json([
                'message' => 'unauthorized'
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }

        // Use this later
        // $user = $response->object();

        // Remove this line later. 
        // The plan is to return the object returned
        $user = (new User())->find($response->object()->id);

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}