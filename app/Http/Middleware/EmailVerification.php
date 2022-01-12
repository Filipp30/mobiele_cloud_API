<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailVerification
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Application|ResponseFactory|Response|mixed
     */
    public function handle(Request $request, Closure $next){
        $user = User::findOrFail($request->id);
        $hash_verified_email = $user->hasVerifiedEmail();
        if ($hash_verified_email){
            return response(['conflict'=>'twice verify not possible!'],409);
        }

        return $next($request);
    }
}
