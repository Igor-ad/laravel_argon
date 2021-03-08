<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\ApiTrackingStat;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function tracking(Request $request)
    {
        ApiTrackingStat::dispatch($request);
    }
}
