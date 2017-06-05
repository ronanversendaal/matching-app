<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;

class AppAuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guest()) {
            $user = Voyager::model('User')->find(Auth::id());

            return $user->hasPermission('browse_app') ? $next($request) : redirect('/');
        }

        $urlLogin = route('voyager.login');
        $urlIntended = $request->url();
        if ($urlIntended == $urlLogin) {
            $urlIntended = null;
        }

        return redirect($urlLogin)->with('url.intended', $urlIntended);
    }
}
