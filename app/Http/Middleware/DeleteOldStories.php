<?php

namespace App\Http\Middleware;

use App\Models\Story;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteOldStories
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $stories = Story::all();

        foreach($stories as $story){
            if($story->created_at->diffInHours(Carbon::now())>1){
                $story->delete();
            }
        }
        return $next($request);
    }
}
