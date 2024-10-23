<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckOtpSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Log::info('CheckOtpSession:: handle: ' . session()->has('OTPSESSIONKEY'));
        // Log::info('CheckOtpSession:: logged in: ' . auth()->check());
        // dd(session()->has('OTPSESSIONKEY'));
        // if (true) {
            if (!session()->get('OTPSESSIONKEY')&&auth()->check()) {
            // Log::info('inside if');

            return redirect()->route('tracki.auth.signin');
        }
        return $next($request);
    }
}
