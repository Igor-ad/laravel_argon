<?php

namespace App\Jobs;

use App\Models\Tracking;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ApiTrackingStat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
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
                exit('OK! + 1');
            }
        }

        $requestArray['user_id'] = $user->id;
        $requestArray['counter'] = 1;
        Tracking::create($requestArray);
            exit('OK! New sting');
    }
}
