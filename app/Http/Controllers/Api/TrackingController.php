<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogSearchRequest;
use App\Models\Tracking;
use App\Models\User;

class TrackingController extends Controller
{


    public function tracking()
    {
        return view('api.track');
    }

    public function logs()
    {
        $trackings = Tracking::with(['user'])->get();
        return view('tracking', compact('trackings'));
    }

    public function search(LogSearchRequest $request)
    {
        $trackings = Tracking::with(['user'])
            ->select()->whereDate('created_at', '=', date($request->search))->get();
        return view('tracking', compact('trackings'));
    }
}
