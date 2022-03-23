<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        $output = [
            'type' => 'weather',
            'id' => $this->id,
            'attributes' => [
                'city_id' => $this->city_id,
                'date' => $this->date,
                'time' => $this->time,
                'sunrise' => $this->sunrise,
                'sunset' => $this->sunset,
                'temp' => strval($this->temp).' Celsius',
                'pressure' => strval($this->pressure).' hPa',
                'humidity' => strval($this->humidity).' %',
                'visibility' => strval($this->visibility).' M',
                'wind_speed' => strval($this->wind_speed).' Metre/Sec',
                'weather' => $this->weather,
                'created_at'=>$this->created_at->toDateTimeString()
            ],
            'relationships' => [
                'city' => new CityResource($this->city),
            ]
        ];
        return $output;
    }

}
