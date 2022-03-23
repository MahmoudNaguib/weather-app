<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use File;



class CallWeather extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:call';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call weather api 4 times a day';
    protected $process;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $cities = \App\Models\City::get();
        $weather = new \App\Models\Weather();
        if ($cities) {
            foreach ($cities as $city) {
                $date=date('Y-m-d');
                $weatherData = $weather->callWeatherForSingleCity($city, $date);
                if($weatherData and is_array($weatherData)){
                    \App\Models\Weather::create($weatherData);
                }
            }
        }
    }
}
