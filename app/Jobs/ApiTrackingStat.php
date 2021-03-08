<?php

namespace App\Jobs;

use App\Models\Tracking;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'user_id' => $user->id,
            'user_agent' => $request->userAgent(),
            'ip' => $request->getClientIp(),
            'country' => $request->get('country'),
            'product' => $request->get('product'),
        ];

        $tracking = DB::table('trackings')->where($requestArray)->increment('counter');

        if ($tracking) {
            exit('OK! + 1');
        }

        Tracking::create($requestArray);
        exit('OK! New sting');
    }
}
