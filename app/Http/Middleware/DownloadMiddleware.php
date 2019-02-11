<?php

namespace App\Http\Middleware;

use Closure;

use App\File;

class DownloadMiddleware
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
        $file = new File;
        $file->where('path', 'like', '%'.$request->path)->increment('download');
        return $next($request);
    }
}
