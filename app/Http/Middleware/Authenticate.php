<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;


class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $this->guards = $guards;

        return parent::handle($request, $next, ...$guards);
    }

    // protected function redirectTo($request)
    // {
    //     if (!$request->expectsJson()) {
    //         if (Arr::first($this->guards) === 'client-web') {
    //             return route('client.create.login');
    //         }
    //         return route('login');
    //     }
    // }
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Request::is(app()->getLocale() . '/student/dashboard')) {
                return route('selection');
            }
            elseif(Request::is(app()->getLocale() . '/teacher/dashboard')) {
                return route('selection');
            }
            elseif(Request::is(app()->getLocale() . '/myparent/dashboard')) {
                return route('selection');
            }
            elseif(Request::is(app()->getLocale() . '/admin/dashboard')) {
                return route('selection');
            }
        }
        return route('selection');
    }
}
