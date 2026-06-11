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
     * @param  Closure(Request): (Response)  $next
     */
    /**
     * membuat sistem role agar user tidak bisa membuka yg khusus admin
     * dan admin tidak bisa membuka yg khusus user
     * dengan default role nya user di database yg sudah ada
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($request->user()->role !== $role) {
            return response()->json(['message' => 'Akses ditolak, role tidak sesuai'], 403);
        }
        return $next($request);
    }
}
