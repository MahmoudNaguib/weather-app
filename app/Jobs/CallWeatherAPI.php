<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CallWeatherAPI implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $date, $cityId;

    public function __construct($date, $cityId) {
        $this->date = $date;
        $this->cityId = $cityId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $city = \App\Models\City::find($this->cityId);
        if ($city) {
            $weather = new \App\Models\Weather();
            $weatherData = $weather->callWeatherForSingleCity($city, $this->date);
            if ($weatherData) {
                \App\Models\Weather::create($weatherData);
            }
        }
    }
}
