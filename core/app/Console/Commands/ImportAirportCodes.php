<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AirportCode;
use Illuminate\Support\Str;

class ImportAirportCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-airport-codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fileStream = fopen('../airport-codes.csv', 'r');
 
        fgetcsv($fileStream);

        // Reading the file line by line into an array
        while (($line = fgetcsv($fileStream)) !== false) {
            if(!empty($line) && count($line) === 13 && !empty($line[9]) && Str::contains($line[2], 'Airport', true)) {
                AirportCode::updateOrCreate([
                    'airport'     => $line[2],
                    'iata_code'   => $line[9],
                    'city'        => $line[7],
                    'iso_country' => $line[5],
                    'iso_region'  => $line[6],
                    'icao_code'   => $line[8],
                    'coordinates' => $line[12]
                ],
                ['iata_code' => $line[9]]);
            }
        }
    
        // Closing the file stream
        fclose($fileStream);
    }
}