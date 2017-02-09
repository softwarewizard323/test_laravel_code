<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Data\WebsiteSetting;

class RedirectIfMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = Auth::guard($guard);
        if ($user->check() && $user->user()->isAdmin) {
            return redirect('/admin');
        }

        if (WebsiteSetting::get('maintenance') == 1) {
            return redirect('/dashboard/maintenance');
        }

        return $next($request);
    }
}
