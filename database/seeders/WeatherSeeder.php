<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder {
    /*     * ,
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {
        if (\Schema::hasTable('weather')) {
            \DB::table('weather')->delete();
            \DB::statement("ALTER TABLE `weather` AUTO_INCREMENT = 1");
            $cities = \App\Models\City::get();
            $weather = new \App\Models\Weather();
            if ($cities) {
                foreach ($cities as $city) {
                    $dates = [
                        date('Y-m-d', strtotime(date('Y-m-d') . ' -4 days')),
                        date('Y-m-d', strtotime(date('Y-m-d') . ' -3 days')),
                        date('Y-m-d', strtotime(date('Y-m-d') . ' -2 days')),
                        date('Y-m-d', strtotime(date('Y-m-d') . ' -1 days')),
                        date('Y-m-d')
                    ];
                    foreach ($dates as $date) {
                        $weatherData = $weather->callWeatherForSingleCity($city, $date);
                        if($weatherData and is_array($weatherData)){
                            \App\Models\Weather::create($weatherData);
                        }
                    }
                }
            }
        }
    }
}
