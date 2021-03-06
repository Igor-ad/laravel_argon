<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class OpenExchangeRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currencies rate from the OpenExchange';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $responseRate = Http::get(config('services.openexchange.uri')
            . config('services.openexchange.token'));

        $currenciesRate = $responseRate->json();

        foreach ($currenciesRate['rates'] as $key => $rate) {
            $currencyRate['code'] = $key;
            $currencyRate['rate'] = $rate;
            Currency::upsert($currencyRate, ['code'], ['rate']);
        }
    }
}

