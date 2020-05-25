<?php

namespace App\Http\Middleware;

use App\Models\Member;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->role == Member::ROLE_MEMBER) {
            return $next($request);
        } else {
            return redirect()->route('admin');
        }
    }
}
