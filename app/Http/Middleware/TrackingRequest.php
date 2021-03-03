<?php

namespace App\Http\Middleware;

use App\Models\Tracking;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackingRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        $requestArray = [
            'user_agent' => $request->userAgent(),
            'ip' => $request->getClientIp(),
            'country' => $request->get('country'),
            'product' => $request->get('product')
        ];

        $trackings = Tracking::select()->where('user_id', $user->id)->get();

        foreach ($trackings as $tracking) {
            $trackingArray = [
                'user_agent' => $tracking->user_agent,
                'ip' => $tracking->ip,
                'country' => $tracking->country,
                'product' => $tracking->product
            ];

            if ($trackingArray == $requestArray) {
                $tracking->increment('counter');
                return $next($request);
            }
        }

        $requestArray['user_id'] = $user->id;
        $requestArray['counter'] = 1;
        Tracking::create($requestArray);

        return $next($request);
    }
}
