<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class OpenExchangeList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currencies list from the OpenExchange';

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
        $currency = new Currency;
        $allCode = iterator_to_array($currency->all()->map->code);

        $responseName = Http::get(config('services.openexchangecur.uri')
            . config('services.openexchangecur.token'));

        $currenciesName = $responseName->json();

        foreach ($currenciesName as $key => $name) {
            if (!in_array($key, $allCode)) {
                $currencyName['code'] = $key;
                $currencyName['name'] = $name;
                Currency::create($currencyName);
            }
        }
    }
}
