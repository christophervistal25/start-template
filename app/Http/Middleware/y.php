<?php

namespace App\Http\Middleware;

use App\Item;
use Closure;

class ItemExists
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
        if (Item::exists($request->item_name)) {
            return response()->json(['success' => false , 'exists' => true]);
        }
        return $next($request);
    }
}
