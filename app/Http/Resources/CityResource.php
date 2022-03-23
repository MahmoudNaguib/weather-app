<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        $output = [
            'type' => 'city',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'country' => $this->country,
                'lat' => $this->lat,
                'lon' => $this->lon,
            ],
        ];
        return $output;
    }

}
