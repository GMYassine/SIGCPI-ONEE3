<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
Session::start();

// models
use App\Models\agent;

class EnsureAdminPrivileges
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $agent = agent::where('matricule',Session::get('matricule'))->first();

        if($agent->est_admin == 'true'){
            return $next($request);

        }else{
            abort(403);
        }
    }
}
