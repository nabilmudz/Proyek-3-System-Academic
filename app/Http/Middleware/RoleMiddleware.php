<?php
namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        $authorizationHeader = $request->header('Authorization');

        if ($authorizationHeader && str_starts_with($authorizationHeader, 'Bearer ')) {
            try {
                $payload = JWTAuth::parseToken()->getPayload();
                if ($payload->get('role') !== $role) {
                    return response()->json(['error' => 'Unauthorized'], 403);
                }
                return $next($request);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Token not valid'], 401);
            }
        }

        if (!Auth::check()) {
            return redirect()->guest(route('login'));
        }

        if (Auth::user()->role !== $role) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
