<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routedUserId = $request->route('user')->id;
        $currentUserid = Auth::id();
        $currentUserRole = Auth::user()->role;
        if (Auth::check() && ($routedUserId == $currentUserid || $currentUserRole == 1)) {
            return $next($request);
        } else {
            return redirect()->route('posts.index');
        }
    }
}