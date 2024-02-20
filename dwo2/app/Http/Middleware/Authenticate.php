<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected $user_route  = 'login';
    protected $admin_route = 'admin.login';

    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectToByGuards($request ,$guards)
        );
    }


    protected function redirectToByGuards($request, $guards) {
        if (!$request->expectsJson()) {
            if ($guards[0] === 'admin') {
                return route($this->admin_route);
            } else {
                return route($this->user_route);
            }
        }
    }
    

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
            
//        return $request->expectsJson() ? null : route('login');

        // ルーティングに応じて未ログイン時のリダイレクト先を振り分ける
        if (!$request->expectsJson()) {
            if (Route::is('admin.*')) {
                return route($this->admin_route);
            } else {
                return route($this->user_route);
            }
        }

    }
}
