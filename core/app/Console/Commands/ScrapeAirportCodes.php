<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ScrapeAirportCode;

class ScrapeAirportCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-airport-codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape airport codes for autocomplete suggetions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        for ($i=1; $i <= 440; $i++) {
            ScrapeAirportCode::dispatch("https://www.world-airport-codes.com/alphabetical/world-area-code/0-999.html?page={$i}");
        }
    }
}