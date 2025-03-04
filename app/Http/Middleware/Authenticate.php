<?php
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        // Prevent infinite redirect loops
        if ($request->expectsJson()) {
            return null;
        }

        if (!$request->user() && !in_array($request->path(), ['login', 'register', 'forgot-password'])) {
            return route('login');
        }

        return null;
    }
}
