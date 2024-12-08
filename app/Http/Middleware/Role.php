<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // if ($request->user()->role !== $role){
        //     // return redirect('dashboard');
        //     dd('incoming role: '. $role, 'i am: '.$request->user()->role);
        // }
        if ($request->user()->role == $role) {
            // dd('incoming role: '. $role, 'i am: '.$request->user()->role);

            return $next($request);
        } else {
            if ($request->user()->role == 'user'){
                return response(view('hr.emp.dashboard'));
            } else {
                // return response(view('hr.admin.dashboard'));
            return redirect('dashboard');

            }
            // return response(view('errors.403'),403);
        }
    }
}
