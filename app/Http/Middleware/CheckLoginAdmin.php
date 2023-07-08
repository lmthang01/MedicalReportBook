<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Log::info("------- inint ----------");
        if (Auth::check()) {
            $userLogin = Auth::user();

            // dump($userLogin);

            $checkRole = User::where('id', $userLogin->id)
                ->whereHas('userType', function ($query) {
                    $query->whereIn('name', [User::ROLE_ADMIN]); // Muốn User vào thì |  [User::ROLE_ADMIN, User::ROLE_USER]
                })->first();

            if (empty($checkRole)) return redirect()->route('get_admin.login');

            return $next($request);
        }
        return redirect()->route('get_admin.login');
    }
}
