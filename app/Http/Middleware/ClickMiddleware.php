<?php

namespace App\Http\Middleware;

use Closure;

use App\Post;
// use Illuminate\Http\Request;

class ClickMiddleware
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
        // dd($id);
        $post = new Post;
        $post->where('id',$request->id)->increment('look');
        return $next($request);
    }
}
