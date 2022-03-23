<?php

namespace App\Models;

class Weather extends BaseModel {

    protected $table = "weather";
    protected $guarded = [
    ];
    protected $hidden = [
    ];
    public $rules = [
        'date' => 'required|date',
        'city_id' => 'required|integer|exists:cities,id',
    ];

    public function city() {
        return $this->belongsTo(\App\Models\City::class, 'city_id')->withDefault();
    }

    public function callWeatherForAllCities($date) {
        $cities = \App\Models\City::get();
        if ($cities) {
            foreach ($cities as $city) {
                $weatherData = $this->callWeatherForSingleCity($city, $date);
                \App\Models\Weather::create($weatherData);
            }
        }
    }

    public function callWeatherForSingleCity($city, $date) {
        $lat = $city->lat;
        $lng = $city->lon;
        $dt = strtotime($date);
        $appId = env('WEATHER_APP_KEY', 'c99a39c5e7865592c34ff97b2210cd87');
        $fullURL = 'https://api.openweathermap.org/data/2.5/onecall/timemachine?units=metric&exclude=hourly,daily&lat=' . $lat . '&lon=' . $lng . '&dt=' . $dt . '&appid=' . $appId;
        try {
            $json = json_decode(@file_get_contents($fullURL));
            $weatherData = [
                'city_id' => $city->id,
                'date' => date('Y-m-d', $json->current->dt),
                'time' => date('h:i:s a', $json->current->dt),
                'sunrise' => date('Y-m-d h:i:s a', $json->current->sunrise),
                'sunset' => date('Y-m-d h:i:s a', $json->current->sunset),
                'temp' => $json->current->temp,
                'pressure' => $json->current->pressure,
                'humidity' => $json->current->humidity,
                'visibility' => $json->current->visibility,
                'wind_speed' => $json->current->wind_speed,
                'weather' => @$json->current->weather[0]->main . ', ' . @$json->current->weather[0]->description,
            ];
            return $weatherData;
        } catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage() . ', File: ' . $e->getFile() . ', Line:' . $e->getLine() . PHP_EOL);
        }
    }
}
