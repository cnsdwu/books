<?php

namespace App\Http\Middleware;

use Closure;

class ConfigMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin = \Illuminate\Support\Facades\DB::table('admins')->where('id', 1)->first();
        if($admin == null){
            \Illuminate\Support\Facades\DB::table('admins')->insert([
                'id' => 1,
                'title' => 'kindle',
                'theme' => 'default',
                'logo' => '/images/logo.png',
                'icon' => '/images/favicon.ico',
                'email' => 'admin@wwzc.cc',
            ]);
        }
        return $next($request);
    }
}
