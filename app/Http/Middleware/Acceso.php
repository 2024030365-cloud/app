<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Acceso
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        $tenantId = tenant('id');

        if (!$user || !$user->tenants()->where('tenant_id', $tenantId)->exists()) {
         return ErrorResponse(false, 'No tienes Permisos en esta empresa', 403);

        } 

      return $next($request);   
        
        }

    }

