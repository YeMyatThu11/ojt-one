<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostOwner
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
        $authorId = $request->route('post')->author_id;
        $currentUserid = Auth::id();
        $currentUserRole = Auth::user()->role;
        if (Auth::check() && ($authorId == $currentUserid || $currentUserRole == 1)) {
            return $next($request);
        } else {
            return redirect()->route('posts.index');
        }
    }
}