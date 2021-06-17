<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class VerifyAccountBalance
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
        if (session::get('session_id')) {

            return $next($request);
        }
        return view('admin.login.admin_login')->with('message', __('Some error message'));
    }
}
