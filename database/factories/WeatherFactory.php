<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeatherFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Weather::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $city=\App\Models\City::inRandomOrder()->first();
        return [
            'city_id'=>$city->id,
            'date' => date('Y-m-d'),
            'time'=>date('h:i:s a'),
            'sunrise'=>date('Y-m-d h:i:s a'),
            'sunset'=>date('Y-m-d h:i:s a'),
            'temp'=>rand(10,45),
            'pressure'=>rand(1000,2000),
            'humidity'=>rand(50,100),
            'visibility'=>rand(5000,10000),
            'wind_speed'=>rand(5,10),
            'weather'=>$this->faker->sentence(2)
        ];
    }
}
