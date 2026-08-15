<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        // Guests are allowed to continue normally.
        if (!$request->user()) {
            return $next($request);
        }

        $user = $request->user();

        // Allow the user to log out even when suspended or banned.
        if ($request->routeIs('logout')) {
            return $next($request);
        }

        // Allow access to the account status page.
        if ($request->routeIs('account.status')) {
            return $next($request);
        }

        // If a suspension has expired, reactivate the account.
        if ($user->account_status === 'suspended') {

            if (
                $user->suspended_until &&
                now()->greaterThanOrEqualTo($user->suspended_until)
            ) {
                $user->update([
                    'account_status' => 'active',
                    'suspended_until' => null,
                ]);
            } else {
                return redirect()->route('account.status');
            }
        }

        // Banned users are also sent to the status page.
        if ($user->account_status === 'banned') {
            return redirect()->route('account.status');
        }

        return $next($request);
    }
}