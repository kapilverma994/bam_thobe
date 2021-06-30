<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if($user->type == 'admin') {
            // auth()->logout();
            return $next($request);

        }
        elseif($user->type == 'sub_admin')
        {
            return $next($request);
        }
        // dd($user->toArray());
        return redirect(url('/'));

    }
}
