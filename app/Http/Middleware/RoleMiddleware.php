<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role )
    {
        $phanquyen = Auth::user()->phanquyen;
        if (stripos($role, $phanquyen) === false) {
            return redirect()->route('shopping.index.index')->with('msg', 'Bạn không thể vào trang này.');
        }
        return $next($request);
    }
}
