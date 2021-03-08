<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencySearchRequest;
use App\Models\Currency;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    public function rate(CurrencySearchRequest $request)
    {
        $currencies = (!empty($request->input('search')))
            ? DB::table('currencies')
                ->where('name', 'like', '%' . $request->input('search') . '%')
                ->orWhere('code', 'like', '%' . $request->input('search') . '%')
                ->get()
            : Currency::all();

        return view('currency', compact('currencies'));
    }
}
