<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogSearchRequest;
use App\Models\Tracking;

class TrackingController extends Controller
{
    public function logs(LogSearchRequest $request)
    {
        $trackings = (!empty($request->input('search')))
            ? Tracking::with(['user'])->select()
                ->whereDate('created_at', '=', date($request->search))->get()
            : Tracking::with(['user'])->get();

        return view('tracking', compact('trackings'));
    }
}
