<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if(in_array($request->user()->role->libelle, $roles)){
            return $next($request);
        }
        return back()->with([
            'str' => 'danger', 
            'msg' => 'Acces interdit pour vous !'
        ]);
    }
}
