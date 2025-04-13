<?php

// app/Http/Middleware/CheckRole.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
        
        if (!$user || !in_array($user->jabatan, $roles)) {
            abort(403, 'Akses ditolak: Role tidak sesuai');
        }

        return $next($request);
    }
}
