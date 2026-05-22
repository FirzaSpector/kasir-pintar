<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed ...$roles  Allowed roles (e.g. admin, kasir)
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }
        // Cast role enum to string for comparison
        $role = $user->role instanceof \BackedEnum ? $user->role->value : $user->role;
        if (!in_array($role, $roles)) {
            abort(Response::HTTP_FORBIDDEN, 'Forbidden');
        }
        return $next($request);
    }
}
