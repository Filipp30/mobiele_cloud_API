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
        if (!$user){
            return response('Error: User not exists');
        }

        $hash_is_valid = hash_equals($request->hash,sha1($user->getEmailForVerification()));
        if (!$hash_is_valid){
            return response('Error: Hash is not equals sha1(Email for Verification).');
        }

        $hash_verified_email = $user->hasVerifiedEmail();
        if ($hash_verified_email){
            return response('Error: twice verify not possible!');
        }

        return $next($request);
    }
}
