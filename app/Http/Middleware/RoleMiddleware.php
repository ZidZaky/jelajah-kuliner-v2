<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$status)
    {
        // Ubah string menjadi array
    $roles = explode(',', $status);

    if (session()->has('account') && in_array(session('account')['status'], $roles)) {
        return $next($request);
    }

        return redirect('/PageNotFound');
    }
}
