<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class RevenueMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $user )
    {
        $phanquyen = Auth::user()->phanquyen;
        if (stripos($user, $phanquyen) === false) {
            return redirect()->route('admin.admin.index')->with('msg', 'Bạn không có quyền thực hiện chức năng này.');
        }
        return $next($request);
    }
}
